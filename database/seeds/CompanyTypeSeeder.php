<?php

use Illuminate\Database\Seeder;
use App\Models\CompanyType;

class CompanyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CompanyType::create([
            'type'=>'Minimercado'
        ]);
        CompanyType::create([
            'type'=>'Fruteria'
        ]);
        CompanyType::create([
            'type'=>'Distribuidor de gas'
        ]);
        CompanyType::create([
            'type'=>'Tienda de barrio'
        ]);
        CompanyType::create([
            'type'=>'Vegetales y hortalizas'
        ]);
    }
}
