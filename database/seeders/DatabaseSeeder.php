<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
		//Execute the Products Seeder to load the products into the products table.
		
		$this->call([
			ProductSeeder::class
		]);
    }
}
