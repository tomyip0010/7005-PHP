<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Dish;
use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
{
    public function __construct() {
        $this->middleware('auth', ['except'=>['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $items_per_page = 1; 
        $restaurants = User::where('userType', '2')->paginate($items_per_page);
        return view('restaurant.index')->with('restaurants', $restaurants);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $items_per_page = 5; 
        $restaurant = User::find($id);
        $dishes = $restaurant->dishes()->paginate($items_per_page);
        $orders = NULL;
        $sessionData = session('cartId');
        // dd($sessionData);
        if (Auth::check() && $sessionData && array_key_exists('res'.$restaurant -> id, $sessionData)) {
            $cartId = $sessionData['res'.$restaurant -> id];
            if ($cartId) {
                $user = Auth::user();
                $orders = $user -> orderedDishes() -> whereRaw('fulfilled = ? and cart_id = ?', array(false, $cartId)) -> get();
            }
        }
        // dd($orders);
        return view('restaurant.show')->with('restaurant', $restaurant)->with('dishes', $dishes)->with('orders', $orders);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
