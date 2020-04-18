<?php

use Illuminate\Database\Seeder;
use App\Models\CompanyStatus;

class CompanyStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CompanyStatus::create([
            'status'=>'Asistente de configuración'
        ]);
        CompanyStatus::create([
            'status'=>'Falta de verificación'
        ]);
        CompanyStatus::create([
            'status'=>'Activo'
        ]);
        CompanyStatus::create([
            'status'=>'Falta de pago'
        ]);
        CompanyStatus::create([
            'status'=>'Inactivo'
        ]);
    }
}
