<?php

use Illuminate\Database\Seeder;

class CompanyStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table([
            'status'=>'Falta de verificacion'
        ]);
        DB::table([
            'status'=>'Activo'
        ]);
        DB::table([
            'status'=>'Falta de pago'
        ]);
        DB::table([
            'status'=>'Inactivo'
        ]);
    }
}
