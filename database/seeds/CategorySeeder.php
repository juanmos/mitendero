<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'category'=>'Frutas',
            'icon'=>'/images/web/categories/fruits.svg'
        ]);
        $panaderia = Category::create([
            'category'=>'Panaderia',
            'icon'=>'/images/web/categories/bread.svg'
        ]);
        $bebidas = Category::create([
            'category'=>'Bebidas',
            'icon'=>'/images/web/categories/soda.svg'
        ]);
        $licores = Category::create([
            'category'=>'Licores',
            'icon'=>'/images/web/categories/liquor.svg'
        ]);
        $carnes = Category::create([
            'category'=>'Carnes y Pescados',
            'icon'=>'/images/web/categories/fish.svg'
        ]);
        $snacks=Category::create([
            'category'=>'Snacks',
            'icon'=>'/images/web/categories/snacks.svg'
        ]);
        $lacteos = Category::create([
            'category'=>'Lacteos y Huevos',
            'icon'=>'/images/web/categories/eggs.svg'
        ]);
        $embutidos= Category::create([
            'category'=>'Embutidos',
            'icon'=>'/images/web/categories/sausages.svg'
        ]);
        $enlatados=Category::create([
            'category'=>'Enlatados',
            'icon'=>'/images/web/categories/canned-food.svg'
        ]);
        $abarrotes=Category::create([
            'category'=>'Abarrotes',
            'icon'=>'/images/web/categories/flour.svg'
        ]);
        Category::create([
            'category'=>'Vegetales',
            'icon'=>'/images/web/categories/vegetables.svg'
        ]);
        $limpieza=Category::create([
            'category'=>'Limpieza',
            'icon'=>'/images/web/categories/bucket.svg'
        ]);
        $higuiene =Category::create([
            'category'=>'Higuiene personal',
            'icon'=>'/images/web/categories/toothbrush.svg'
        ]);
        $mascotas = Category::create([
            'category'=>'Mascotas',
            'icon'=>'/images/web/categories/pet.svg'
        ]);

        $licores->subcategory()->create([
            'category'=>'Cervezas'
        ]);
        $licores->subcategory()->create([
            'category'=>'Ron'
        ]);
        $licores->subcategory()->create([
            'category'=>'Vodka'
        ]);
        $licores->subcategory()->create([
            'category'=>'Whiskey'
        ]);
        $licores->subcategory()->create([
            'category'=>'Gin'
        ]);
        $licores->subcategory()->create([
            'category'=>'Vinos y Espumantes'
        ]);
        $licores->subcategory()->create([
            'category'=>'Otros'
        ]);

        $lacteos->subcategory()->create([
            'category'=>'Leche'
        ]);
        $lacteos->subcategory()->create([
            'category'=>'Queso'
        ]);
        $lacteos->subcategory()->create([
            'category'=>'Yogurt'
        ]);
        $lacteos->subcategory()->create([
            'category'=>'Mantequilla'
        ]);
        $lacteos->subcategory()->create([
            'category'=>'Otros'
        ]);

        $snacks->subcategory()->create([
            'category'=>'Galletas'
        ]);
        $snacks->subcategory()->create([
            'category'=>'Snacks'
        ]);
        $snacks->subcategory()->create([
            'category'=>'Chocolates'
        ]);
        $snacks->subcategory()->create([
            'category'=>'Caramelos'
        ]);
        $snacks->subcategory()->create([
            'category'=>'Frutas secas'
        ]);
        $snacks->subcategory()->create([
            'category'=>'Chicles'
        ]);

        $bebidas->subcategory()->create([
            'category'=>'Aguas'
        ]);
        $bebidas->subcategory()->create([
            'category'=>'Colas'
        ]);
        $bebidas->subcategory()->create([
            'category'=>'Cafe'
        ]);
        $bebidas->subcategory()->create([
            'category'=>'Tes'
        ]);
        $bebidas->subcategory()->create([
            'category'=>'Jugos'
        ]);

        $carnes->subcategory()->create([
            'category'=>'Carne de res'
        ]);
        $carnes->subcategory()->create([
            'category'=>'Carne de chancho'
        ]);

        $carnes->subcategory()->create([
            'category'=>'Pavo'
        ]);
        $carnes->subcategory()->create([
            'category'=>'Pollo'
        ]);
        $carnes->subcategory()->create([
            'category'=>'Pescado'
        ]);
        $carnes->subcategory()->create([
            'category'=>'Camarón'
        ]);
        $carnes->subcategory()->create([
            'category'=>'Otros mariscos'
        ]);

        $embutidos->subcategory()->create([
            'category'=>'Jamones'
        ]);
        $embutidos->subcategory()->create([
            'category'=>'Salchichas'
        ]);
        $embutidos->subcategory()->create([
            'category'=>'Otros'
        ]);

        $limpieza->subcategory()->create([
            'category'=>'Ambientadores'
        ]);
        $limpieza->subcategory()->create([
            'category'=>'Detergente'
        ]);
        $limpieza->subcategory()->create([
            'category'=>'Fundas y plasticos'
        ]);
        $limpieza->subcategory()->create([
            'category'=>'Platos y Vasos'
        ]);
        $limpieza->subcategory()->create([
            'category'=>'Articulos de cocina'
        ]);
        $limpieza->subcategory()->create([
            'category'=>'Lavanderia'
        ]);
        $limpieza->subcategory()->create([
            'category'=>'Papel higuienico'
        ]);

        $higuiene->subcategory()->create([
            'category'=>'Cremas y Lociones'
        ]);
        $higuiene->subcategory()->create([
            'category'=>'Desodorantes'
        ]);
        $higuiene->subcategory()->create([
            'category'=>'Higuiene oral'
        ]);
        $higuiene->subcategory()->create([
            'category'=>'Cuidado femenino'
        ]);
        $higuiene->subcategory()->create([
            'category'=>'Planeación familiar'
        ]);
        $higuiene->subcategory()->create([
            'category'=>'Belleza'
        ]);
        $higuiene->subcategory()->create([
            'category'=>'Primeros auxilios'
        ]);

        $mascotas->subcategory()->create([
            'category'=>'Comida y cuidado de perros'
        ]);
        $mascotas->subcategory()->create([
            'category'=>'Comida y cuidado de gatos'
        ]);
        $mascotas->subcategory()->create([
            'category'=>'Otros animales'
        ]);

        $abarrotes->subcategory()->create([
            'category'=>'Condimentos'
        ]);
        $abarrotes->subcategory()->create([
            'category'=>'Salsa'
        ]);
        $abarrotes->subcategory()->create([
            'category'=>'Mieles y Nectares'
        ]);
        $abarrotes->subcategory()->create([
            'category'=>'Mermeladas'
        ]);
        $abarrotes->subcategory()->create([
            'category'=>'Aceites y Vinagres'
        ]);
        $abarrotes->subcategory()->create([
            'category'=>'Gelatinas, Masas y Hornear'
        ]);

        $enlatados->subcategory()->create([
            'category'=>'Vegetales'
        ]);
        $enlatados->subcategory()->create([
            'category'=>'Granos'
        ]);
        $enlatados->subcategory()->create([
            'category'=>'Carnes y Mariscos'
        ]);
        $enlatados->subcategory()->create([
            'category'=>'Sopas'
        ]);

        $panaderia->subcategory()->create([
            'category'=>'Panes'
        ]);
        $panaderia->subcategory()->create([
            'category'=>'Tortillas'
        ]);
        $panaderia->subcategory()->create([
            'category'=>'Postres'
        ]);
    }
}
