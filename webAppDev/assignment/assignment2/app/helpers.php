<?php

use Illuminate\Support\Facades\Auth;
use App\Models\Dish;
use App\Models\User;

if (!function_exists('getUserTypeLabel')) {
    function getUserTypeLabel()
    {
        if (Auth::check()) {
            $userType = Auth::user()->userType;
            if ($userType === '1') {
                return 'admin';
            } elseif ($userType === '2') {
                return 'restaurant';
            } elseif ($userType === '3') {
                return 'customer';
            } else {
                return '';
            }
        } else {
            return '';
        }
     }
}

if (!function_exists('isRestaurant')) {
    function isRestaurant()
    {
        if (Auth::check()) {
            $userType = Auth::user()->userType;
            $userId = Auth::user()->id;
            if ($userType === '2') {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
     }
}

if (!function_exists('isOwnedRestaurant')) {
    function isOwnedRestaurant($restaurantId)
    {
        if (Auth::check()) {
            $restaurant = User::find($restaurantId);
            $userType = Auth::user()->userType;
            $userId = Auth::user()->id;
            if ($userType === '2' && $userId == $restaurant -> id) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
     }
}

if (!function_exists('isOwnedDish')) {
    function isOwnedDish($dishId)
    {
        if (Auth::check()) {
            $dish = Dish::find($dishId);
            $userType = Auth::user()->userType;
            $userId = Auth::user()->id;
            if ($userType === '2' && $userId == $dish -> restaurant_id) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
     }
}