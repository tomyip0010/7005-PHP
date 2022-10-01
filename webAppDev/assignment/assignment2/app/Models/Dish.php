<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;

    function restaurant() {
        return $this->belongsTo('App\Models\User');
    }

    function images() {
        return $this->hasMany('App\Models\Image', 'dish_id', 'id');
    }

    function orders() {
        return $this->hasMany('App\Models\Order', 'dish_id', 'id');
    }
}
