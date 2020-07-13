<?php

use Illuminate\Database\Seeder;

class LaboratoryTypeSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $priceFile = file_get_contents(
            base_path('\database\seeds\tarif_lab.json')
        );
        $prices = json_decode($priceFile);

        foreach($prices as $i => $price) {
            $id = DB::table('laboratory_types')->insertGetId([
                'name' => $i
            ]);
            $details = [];
            foreach($price as $p) {
                array_push($details, [
                    'laboratory_type_id' => $id,
                    'name' => $p->name,
                    'price' => $p->price
                ]);
            }
            DB::table('laboratory_type_details')
            ->insert($details);
        }
    }
}
