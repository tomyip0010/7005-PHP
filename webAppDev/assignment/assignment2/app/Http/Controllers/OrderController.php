<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Dish;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        // $this->middleware('restaurant', ['except'=>['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = Auth::user();
        $isRestaurant = $user -> userType === '2';
        if ($isRestaurant) {
            $orders = $user-> receivedOrders() -> where('fulfilled', true) -> orderby('cart_id') -> get();
        } else {
            $orders = $user-> orders() -> where('fulfilled', true) -> orderby('cart_id') -> get();
        }
        // dd($user -> userType, $isRestaurant, $orders);
        return view('order.index')->with('orders', $orders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $userId = Auth::id(); 
        $dishId = $request -> dishId;
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
        $placeOrder = $request -> placeOrder === 'true';
        if ($placeOrder) {
            $restaurantId = $request -> restaurantId;
        } else {
            $dishId = $request -> dishId;
            $dish = Dish::find($dishId);
            $restaurantId = $dish -> restaurant_id;
        }

        $sessionData = $request -> session() -> get('cartId');

        if (!$sessionData || !array_key_exists('res'.$restaurantId, $sessionData)) {
            $currentTime = new Carbon();
            $cartId = $currentTime->getTimestamp();
            if (!$sessionData) {
                $existingSessions = [];
            } else {
                $existingSessions = $sessionData;
            }
            $request -> session() -> put('cartId', array_merge(['res'.$restaurantId => $cartId], $existingSessions));
        } else {
            $cartId = $sessionData['res'.$restaurantId];
        }
        $user = Auth::user(); 
        // dd($cartId, $sessionData);
        if ($placeOrder) {
            // dd($cartId, $sessionData, $restaurantId);
            $pendingOrders = $user-> orders()
                ->where('fulfilled', false)
                ->where('cart_id', $cartId);
            $pendingOrders -> update([
                'fulfilled' => true,
                'order_date' => time(),
            ]);
            $request -> session() -> forget('cartId');
            return redirect("order/$cartId");
        } else {
            $quantity = $request -> quantity;
            $existingOrders = $user->orders()
                ->where('fulfilled', false)
                ->where('cart_id', $cartId)
                ->where('dish_id', $dish -> id);
            if ($existingOrders -> count() > 0) {
                $existingOrders -> increment('quantity', $quantity);
            } else {
                $user->orderedDishes()->attach($dish->id, array(
                    'quantity' => $quantity,
                    'cart_id' => $cartId,
                    'fulfilled' => false,
                    'restaurant_id' => $restaurantId,
                    'dish_name' => $dish -> name,
                    'price' => $dish -> price,
                    'discount' => $dish -> discount,
                    'address' => $user -> address,
                ));
            }
            return back();
        }
    }

    /**
     * Display the ordered summary
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $user = Auth::user();
        $isRestaurant = $user -> userType === '2';
        if ($isRestaurant) {
            $orders = $user-> receivedOrders() -> whereRaw('fulfilled = ? and cart_id = ?', array(true, $id)) -> get();
        } else {
            $orders = $user-> orders() -> whereRaw('fulfilled = ? and cart_id = ?', array(true, $id)) -> get();
        }
        return view('order.show') -> with('orders', $orders);
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
        $user = Auth::user(); 
        $sessionData = session('cartId');
        if ($sessionData) {
            foreach($sessionData as $key => $cartId) {
                $existingOrders = $user->orders()
                        ->where('fulfilled', false)
                        ->where('cart_id', $cartId)
                        ->where('dish_id', $id);
                $existingOrders -> delete();
            }
        }
        return back();
    }
}
