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
            $slug .= 'col' . $nota->id . ' FLOAT';
            $col .= 'COALESCE(MAX(col' . $nota->id . '), 0) AS col' . $nota->id;
        }
        $payments = DB::raw('(SELECT * FROM crosstab(\'SELECT registration_id, grup_nota_id, SUM(grandtotal) AS grandtotal FROM invoice_details JOIN items ON items.id = invoice_details.item_id JOIN prices ON prices.item_id = items.id JOIN invoices ON invoices.id = invoice_details.invoice_id WHERE invoice_details.is_item = 1 GROUP BY registration_id, grup_nota_id ORDER BY invoices.registration_id\', \'SELECT id FROM permissions WHERE is_grup_nota = 1 AND is_active = 1 ORDER BY id ASC\') AS ct(registration_id INT, ' . $slug . ')) AS payments');


        $dt = DB::table('invoices')
        ->join('registrations', 'registrations.id', 'invoices.registration_id')
        ->join('contacts', 'contacts.id', 'registrations.patient_id')
        ->leftJoin($payments, 'payments.registration_id', 'invoices.registration_id')
        ->select('invoices.registration_id', DB::raw('MAX(contacts.name) AS patient_name'), DB::raw('MAX(invoices.date) AS date'), DB::raw('MAX(invoices.code) AS code'), DB::raw('MAX(invoices.netto) AS netto'), DB::raw('MAX(invoices.paid) AS paid'), DB::raw("CASE WHEN MAX(invoices.balance) = 0 AND MAX(invoices.netto) > 0 THEN 'Lunas' ELSE 'Belum Lunas' END AS status"))
        ->groupBy('invoices.registration_id');


        if(count($grup_nota) > 0) {
            $dt->addSelect(DB::raw($col));
        }
        return $dt;
    }

    public function medical_bill(Request $request) {
        $x = $this->fetch_medical_bill()->get();
        // $x->whereBetween('invoices.date', [$request->date_start, $request->date_end]);
        return Datatables::of($x)->make(true);
    }    

    public function fetch_medical_payment() {
        $grup_nota = DB::table('payment_types')
        ->orderBy('name', 'ASC')
        ->get();
        
        $payments = DB::raw('(SELECT * FROM crosstab(\'SELECT invoice_id, method, price FROM invoice_payments\', \'SELECT name FROM payment_types ORDER BY name ASC\') AS ct(invoice_id INT, debit INT, kredit INT, master INT, tt INT, tunai INT, visa INT)) AS payments');
        $dt = DB::table('invoices')
        ->join('registrations', 'registrations.id', 'invoices.registration_id')
        ->join('contacts', 'contacts.id', 'registrations.patient_id')
        ->leftJoin($payments, 'payments.invoice_id', 'invoices.id')
        ->select('contacts.name AS patient_name', 'invoices.date', 'invoices.code', 'invoices.netto', 'invoices.paid', DB::raw("CASE WHEN invoices.balance = 0 AND invoices.netto > 0 THEN 'Lunas' ELSE 'Belum Lunas' END AS status"))
        ->addSelect(DB::raw('COALESCE(debit, 0) AS debit'), DB::raw('COALESCE(kredit, 0) AS kredit'), DB::raw('COALESCE(tt, 0) AS tt'), DB::raw('COALESCE(visa, 0) AS visa'), DB::raw('COALESCE(master, 0) AS master'), DB::raw('COALESCE(tunai, 0) AS tunai'));
        return $dt;
    }

    public function medical_payment(Request $request) {
        $x = $this->fetch_medical_payment();
        $x->whereBetween('invoices.date', [$request->date_start, $request->date_end]);

        return Datatables::query($x)->make(true);
    }

    public function fetch_doctor_service() {
        $promo = DB::table('invoice_details')
        ->join('invoices', 'invoices.id', 'invoice_details.invoice_id')
        ->join('discounts', 'discounts.id', 'invoices.discount_id')
        ->whereIsPromo(1)
        ->select('invoice_details.invoice_id', DB::raw('invoice_details.grandtotal * -1 AS grandtotal'));

        $dt = DB::table('invoice_details')
        ->join('invoices', 'invoices.id', 'invoice_details.invoice_id')
        ->join('registrations', 'registrations.id', 'invoices.registration_id')
        ->join('contacts', 'registrations.patient_id', 'contacts.id')
        ->leftJoin('items', 'items.id', 'invoice_details.item_id')
        ->leftJoinSub($promo, 'promo', function($query){
            $query->on('promo.invoice_id', 'invoices.id');
        })
        ->where('invoice_details.is_item', 1)
        ->where('items.is_administration', 0)
        ->select(
            'contacts.name AS patient_name', 
            'invoices.date', 
            'items.name AS item_name', 
            'invoice_details.service_price', 
            DB::raw('(invoice_details.service_price * invoice_details.percentage_doctor / 100) AS doctor_fee'),
            DB::raw('(invoice_details.service_price * (100 - invoice_details.percentage_doctor) / 100) AS clinic_fee'),
            DB::raw('COALESCE(promo.grandtotal, 0) AS promo_price')
        );
        return $dt;
    }

    public function doctor_service(Request $request) {
        $x = $this->fetch_doctor_service();
        $x->whereBetween('invoices.date', [$request->date_start, $request->date_end]);

        return Datatables::query($x)->make(true);
    }

    public function fetch_outgoing_stock() {
        $dt = DB::table('stock_transactions')
        ->where('stock_transactions.out_qty' , '>', 0)
        ->join('items', 'items.id', 'stock_transactions.item_id')
        ->select('stock_transactions.id', 'items.name AS item_name', 'out_qty', 'stock_transactions.description', 'stock_transactions.date');

        return $dt;
    }

    public function outgoing_stock(Request $request) {
        $x = $this->fetch_outgoing_stock();
        $x->whereBetween('stock_transactions.date', [$request->date_start, $request->date_end]);

        return Datatables::query($x)->make(true);
    }
}
