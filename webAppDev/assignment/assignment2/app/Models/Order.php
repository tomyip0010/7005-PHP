<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    function dishes() {
        return $this->belongsTo('App\Models\Dish', 'dish_id', 'id');
    }

    function orderedBy() {
        return $this->belongsTo('App\Models\User', 'customer_id', 'id');
    }
    
    function deliveredBy() {
        return $this->belongsTo('App\Models\User', 'restaurant_id', 'id');
    }
}
