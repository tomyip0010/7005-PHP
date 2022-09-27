<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()    {
        DB::table('products')->insert([
            'name' => Str::random(8),
            'price' => rand(1, 9999),
            'manufacturer_id' => 1,
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('products')->insert([
            'name' => Str::random(8),
            'price' => rand(1, 9999),
            'manufacturer_id' => 2,
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('products')->insert([
            'name' => Str::random(8),
            'price' => rand(1, 9999),
            'manufacturer_id' => 3,
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('products')->insert([
            'name' => Str::random(8),
            'price' => rand(1, 9999),
            'manufacturer_id' => 1,
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('products')->insert([
            'name' => Str::random(8),
            'price' => rand(1, 9999),
            'manufacturer_id' => 1,
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
    }
}
