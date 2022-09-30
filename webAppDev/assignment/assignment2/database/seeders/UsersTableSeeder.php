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
        'id' => 1,
        'name' => "admin",
        'email' => 'admin@gmail.com',
        'userType' => '1',
        'approved' => true,
        'password' => bcrypt('123123'),
      ]);

      // Restaurant User
      DB::table('users')->insert([
        'id' => 2,
        'name' => "Noodle Box",
        'email' => 'noodlebox@gmail.com',
        'userType' => '2',
        'address' => 'South Port, GC',
        'approved' => true,
        'password' => bcrypt('123123'),
      ]);
      DB::table('users')->insert([
        'id' => 3,
        'name' => "KFC",
        'email' => 'kfc@gmail.com',
        'userType' => '2',
        'address' => 'South Port, GC',
        'approved' => true,
        'password' => bcrypt('123123'),
      ]);

      // Customer User
      DB::table('users')->insert([
        'id' => 4,
        'name' => "tom",
        'email' => 'tom@gmail.com',
        'userType' => '3',
        'address' => 'Customer 1, GC',
        'approved' => true,
        'password' => bcrypt('123123'),
      ]);
      DB::table('users')->insert([
        'id' => 5,
        'name' => "test",
        'email' => 'test@test.com',
        'userType' => '3',
        'address' => 'Customer 1, GC',
        'approved' => true,
        'password' => bcrypt('123123'),
      ]);
    }
}
