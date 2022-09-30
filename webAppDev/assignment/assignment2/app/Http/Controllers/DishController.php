<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Dish;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class DishController extends Controller
{
    public function __construct() {
        $this->middleware('auth', ['except'=>['index', 'show']]);
        $this->middleware('restaurant', ['except'=>['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('dish.create_form');
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
        $restaurantId = Auth::id(); 
        $this->validate($request, [
            'name' => [
                'required',
                'max:255',
                'min:4',
                Rule::unique("dishes")->where(fn ($query) => $query->where("restaurant_id", $restaurantId)),
            ],
            'price' => 'required|numeric|min:0',
            'description' => 'nullable',
        ]);

        $dish = new Dish();    
        $dish->name = $request->name;    
        $dish->price = $request->price;    
        $dish->description = $request->description;    
        $dish->restaurant_id = $restaurantId;  
        $dish->save();
        return redirect("restaurant/$restaurantId");    
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
        $dish = Dish::find($id);
        return view('dish.edit_form')->with('dish', $dish);
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
        $restaurantId = Auth::id(); 
        $dish=Dish::find($id);
        $this->validate($request, [
            'name' => [
                'required',
                'max:255',
                'min:4',
                Rule::unique("dishes")->ignore($dish->id)->where(fn ($query) => $query->where("restaurant_id", $restaurantId)),
            ],
            'price' => 'required|numeric|min:0',
            'description' => 'nullable',
            'discount' => 'nullable|numeric|max:100|min:0',
        ]);
        $dish->name = $request->name;
        $dish->price = $request->price;
        $dish->description = $request->description;
        $dish->discount = $request->discount;
        $dish->update();
        return redirect("restaurant/$restaurantId"); 
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
        Dish::destroy($id);
        return back();
        // return redirect('product');
    }
}
