<?php

namespace App\Http\Controllers\Datatable;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;
use DB;
use DataTables;
use Response;

class ReportApiController extends Controller
{
    public function fetch_medical_bill() {
        $grup_nota = DB::table('permissions')
        ->whereIsActive(1)
        ->whereIsGrupNota(1)
        ->orderBy('id', 'ASC')
        ->get();
        $slug = '';
        $col = '';
        foreach($grup_nota as $g => $nota) {
            if($g > 0) {
                $slug .= ', ';
                $col .= ', ';
            }
            $slug .= 'col' . $nota->id . ' INT';
            $col .= 'COALESCE(col' . $nota->id . ', 0) AS col' . $nota->id;
        }
        $payments = DB::raw('(SELECT * FROM crosstab(\'SELECT invoice_id, grup_nota_id, SUM(grandtotal) AS grandtotal FROM invoice_details JOIN items ON items.id = invoice_details.item_id JOIN prices ON prices.item_id = items.id WHERE invoice_details.is_item = 1 GROUP BY invoice_id, grup_nota_id ORDER BY invoice_details.invoice_id\', \'SELECT id FROM permissions WHERE is_grup_nota = 1 AND is_active = 1 ORDER BY id ASC\') AS ct(invoice_id INT, ' . $slug . ')) AS payments');
        $dt = DB::table('invoices')
        ->join('registrations', 'registrations.id', 'invoices.registration_id')
        ->join('contacts', 'contacts.id', 'registrations.patient_id')
        ->leftJoin($payments, 'payments.invoice_id', 'invoices.id')
        ->select('contacts.name AS patient_name', 'invoices.date', 'invoices.code', 'invoices.netto', 'invoices.paid', DB::raw("CASE WHEN invoices.balance = 0 AND invoices.netto > 0 THEN 'Lunas' ELSE 'Belum Lunas' END AS status"));
        if(count($grup_nota) > 0) {
            $dt->addSelect(DB::raw($col));
        }
        return $dt;
    }

    public function medical_bill(Request $request) {
        $x = $this->fetch_medical_bill();
        $x->whereBetween('invoices.date', [$request->date_start, $request->date_end]);

        return Datatables::query($x)->make(true);
    }
}
