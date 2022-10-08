<?php

use Illuminate\Support\Facades\Auth;
use App\Models\Dish;
use App\Models\User;


/** Retreive the user type label by userType */
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

/** Check if the current user is a restaurant */
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

/** check if the current user owned the restaurant */
if (!function_exists('isOwnedRestaurant')) {
    function isOwnedRestaurant($restaurantId)
    {
        if (Auth::check()) {
            $restaurant = User::find($restaurantId);
            $userType = Auth::user()->userType;
            $approved = Auth::user()->approved;
            $userId = Auth::user()->id;
            if ($userType === '2' && $userId == $restaurant -> id && $approved) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
     }
}

/** check if the restaurant owned the dish */
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

/** get the dish price with discount */
if (!function_exists('getFinalDishPrice')) {
    function getFinalDishPrice($item, $isPivot = true)
    {
        $discount = $item -> discount;
        $price = $item -> price;
        if ($isPivot) {
            $quantity = $item -> pivot -> quantity;
        } else {
            $quantity = $item -> quantity;
        }
        if ($discount) {
            return $price * $quantity * (100 - $discount) / 100;
        } else {
            return $price * $quantity;
        }
     }
}


/** get the total price of an order */
if (!function_exists('getOrderSum')) {
    function getOrderSum($orders, $isPivot = true)
    {
        $total = 0;
        foreach ($orders as $order) {
            $total += getFinalDishPrice($order, $isPivot);
        }
        return $total;
     }
}