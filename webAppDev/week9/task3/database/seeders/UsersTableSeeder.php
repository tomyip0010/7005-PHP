<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()    {
      DB::table('users')->insert([
        'name' => "Bob",
        'email' => 'Bob@gmail.com',
        'password' => bcrypt('123456'),
      ]);
      DB::table('users')->insert([
        'name' => "Fred",
        'email' => 'Fred@gmail.com',
        'password' => bcrypt('123456'),
      ]);
      DB::table('users')->insert([
        'name' => "tom",
        'email' => 'tom@gmail.com',
        'password' => bcrypt('123456'),
      ]);
    }
}
