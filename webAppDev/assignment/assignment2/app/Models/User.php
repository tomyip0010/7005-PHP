<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'userType',
        'address',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    function dishes() {
        return $this->hasMany('App\Models\Dish', 'restaurant_id', 'id');
    }

    function orders() {
        return $this->hasMany('App\Models\Order', 'customer_id', 'id');
    }

    function receivedOrders() {
        return $this->hasMany('App\Models\Order', 'restaurant_id', 'id');
    }

    function orderedDishes() {
        return $this->belongsToMany('App\Models\Dish', 'orders', 'customer_id', 'dish_id')->withPivot('quantity', 'fulfilled', 'cart_id', 'restaurant_id', 'order_date', 'dish_name', 'price', 'discount', 'address')->withTimestamps();
    }

    function receivedDishes() {
        return $this->belongsToMany('App\Models\Dish', 'orders', 'restaurant_id', 'dish_id')->withPivot('quantity', 'fulfilled', 'cart_id', 'customer_id', 'order_date', 'dish_name', 'price', 'discount', 'address')->withTimestamps();
    }
    
    function favouritedDishes() {
        return $this->belongsToMany('App\Models\Dish', 'favourites', 'customer_id', 'dish_id');
    }
}
