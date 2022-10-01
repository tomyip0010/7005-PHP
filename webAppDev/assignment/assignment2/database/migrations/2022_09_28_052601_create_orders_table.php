<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->integer('restaurant_id');
            $table->integer('dish_id');
            $table->integer('cart_id');
            $table->integer('quantity');
            $table->string('dish_name');
            $table->integer('price');
            $table->integer('address');
            $table->integer('discount')->nullable();
            $table->boolean('fulfilled')->default(0);
            $table->date('order_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('orders');
    }
};
