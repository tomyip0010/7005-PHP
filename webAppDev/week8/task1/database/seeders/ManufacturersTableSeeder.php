<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class ManufacturersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('manufacturers')->insert([
            'name' => Str::random(8),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('manufacturers')->insert([
            'name' => Str::random(8),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('manufacturers')->insert([
            'name' => Str::random(8),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('manufacturers')->insert([
            'name' => Str::random(8),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('manufacturers')->insert([
            'name' => Str::random(8),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
    }
}
