<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    
    function uploadedBy() {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    function uploadedFor() {
        return $this->belongsTo('App\Models\Dish');
    }
}
