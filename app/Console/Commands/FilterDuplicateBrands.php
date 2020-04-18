<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Brand;
use App\Models\Product;

class FilterDuplicateBrands extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'brands:filter_duplicate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $brands = Brand::select('id', 'name')->groupBy(['name'])->get();
        
        foreach ($brands as $brand) {
            $duplicates =  Brand::where('name', $brand->name)->where('id', '<>', $brand->id)->get();
            $this->line("brand {$brand->name} - {$brand->id}");
            if ($duplicates->count() > 0) {
                foreach ($duplicates as $duplicate) {
                    $products = Product::where('brand_id', $duplicate->id)->get();
                    foreach ($products as $product) {
                        $product->brand_id=$brand->id;
                        $product->save();
                    }
                    $duplicate->delete();
                }
            }
        }
    }
}
