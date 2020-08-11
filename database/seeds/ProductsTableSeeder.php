<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Product;
class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('products')->insert([[
        //     'seller_id'=>1,
        //     'seller_name'=>'Admin',
        //     'name'=>'Product name',
        //     'description'=>'description',
        //     'quantity'=>5,
        //     'image'=>'placeholder-image.png',
        //     'price'=>50,
        //     'type'=>'Electronics'
        // ]]);
        factory(App\Product::class, 100)->create();
    }
}
