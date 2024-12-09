<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Log;
use Datetime;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
	 
    public function run(): void
    {
        $file_path = storage_path() . "\products.json"; // File Path
		$products = json_decode(file_get_contents($file_path), true); // Read the json file
		
		foreach($products as $product){
			//Insert the product
			DB::table('tbl_products')->insert([
				'name' => $product['name'],
				'price' => $product['price'],
				'description' => $product['desc'],
				'created_at'=>date('Y-m-d h:i:s')
			]);
		}
    }
}
