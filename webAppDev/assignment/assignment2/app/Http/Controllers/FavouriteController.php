<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Dish;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class FavouriteController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the recommended favourite
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = Auth::user();
        $favDishes = $user -> favouritedDishes;

        $recommend = NULL;
        if (count($favDishes) >=5) {
            foreach ($favDishes as $favDish) {
                $favDishesIDs[] = $favDish -> id;
            }
            // Get orders includes the most favourited dishes
            $orders = Order::whereIn('dish_id', $favDishesIDs)
                -> selectRaw('*, count("cart_id")')
                -> groupBy('cart_id')
                -> orderBy('cart_id', 'desc') -> get();

            foreach ($orders as $order) {
                $orderId = $order -> cart_id;
                $orderedDishes = Order::where('cart_id', $orderId) -> whereNotIn('dish_id', $favDishesIDs) -> get();
                $numOfDishes = count($orderedDishes);
                if ($numOfDishes > 0) {
                    $randNum = rand(0, $numOfDishes - 1);
                    $recommendDishId = $orderedDishes[$randNum] -> dish_id;
                    $recommend = Dish::find($recommendDishId);
                    // dd($recommend);
                }
            }
        }

        return view('favourite.index')->with('favDishes', $favDishes)->with('dish', $recommend);
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
        $this->validate($request, [
            'dishId' => 'exists:dishes,id',
        ]);
        $user = Auth::user();
        $dishId = $request -> dishId;
        $user -> favouritedDishes() -> attach($dishId);
        return back();
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
    public function destroy($dishId)
    {
        //
        $user = Auth::user();
        $user -> favouritedDishes() -> detach($dishId);
        return back();
    }
}
