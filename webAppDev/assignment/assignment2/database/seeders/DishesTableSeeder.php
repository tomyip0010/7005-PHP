<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DishesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
			DB::table('dishes')->insert([
				'name' => "Teriyaki",
				'description' => 'Choice of chicken or beef with thick egg noodles, fresh bean shoots, spring onion, garlic, capsicum, carrot, bok choy & onion in our ginger soy teriyaki sauce.',
				'price' => 17.95,
				'restaurant_id' => 2,
			]);
			DB::table('dishes')->insert([
				'name' => "Satay",
				'description' => 'Choice of chicken or beef with thick egg noodles, fresh bean shoots, spring onion, capsicum, carrot, garlic, bok choy, broccoli & onion in our rich peanut satay curry sauce.',
				'price' => 17.95,
				'restaurant_id' => 2,
			]);
			DB::table('dishes')->insert([
				'name' => "Special Fried Rice",
				'description' => 'Shrimp, char siu pork, fresh bean shoots, egg, peas & spring onion finished with signature wok-charred flavour.',
				'price' => 16.95,
				'restaurant_id' => 2,
			]);
			DB::table('dishes')->insert([
				'name' => "Japanese Crispy Chicken",
				'description' => 'Crispy chicken with sweet chilli mayonnaise, served with egg fried rice.',
				'price' => 16.95,
				'restaurant_id' => 2,
			]);
		
			DB::table('dishes')->insert([
				'name' => "Zinger Fillet Piece",
				'description' => 'Zinger Fillet Piece',
				'price' => 4.95,
				'restaurant_id' => 3,
			]);
			DB::table('dishes')->insert([
				'name' => "Maxi Popcorn Chicken Combo",
				'description' => 'Popcorn with 1 Regular Chips and 1 Regular Drink.',
				'price' => 13.45,
				'restaurant_id' => 3,
			]);
			DB::table('dishes')->insert([
				'name' => "Original Recipe Burger Combo",
				'description' => 'Burger with 1 Regular Chips and 1 Regular Drink.',
				'price' => 11.45,
				'restaurant_id' => 3,
			]);
			DB::table('dishes')->insert([
				'name' => "BBQ Bacon Stacker Burger Combo",
				'description' => 'Burger with 1 Regular Chips and 1 Regular Drink.',
				'price' => 15.45,
				'restaurant_id' => 3,
			]);
    }
}
