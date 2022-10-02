@extends('layouts.app')

@section('title')
    Order Detail
@endsection

@section('content')
    <div class="flex flex-col px-4 py-6 md:p-6 xl:p-8 bg-white rounded-lg border shadow-md">
        <div class="flex justify-center items-center w-full space-y-4 mt-4 flex-col border-gray-200 border-b pb-4">
            @foreach ($orders -> groupby('cart_id') as $orderId => $order)
                <h3 class="text-xl font-semibold leading-5 text-gray-800">Order Summary # {{ $orderId }}</h3>
                @if (isRestaurant())
                    <div class="flex justify-between items-center w-full text-gray-900 font-bold">
                        <p class="text-base leading-4">Customer Name: </p>
                        <p class="text-base leading-4">{{$order[0] -> orderedBy() -> get()[0] -> name}}</p>
                    </div>
                @else
                    <div class="flex justify-between items-center w-full text-gray-900 font-bold">
                        <p class="text-base leading-4">Restaurant Name: </p>
                        <p class="text-base leading-4">{{$order[0] -> deliveredBy() -> get()[0] -> name}}</p>
                    </div>
                @endif
                <div class="flex justify-between items-center w-full text-gray-900 font-bold">
                    <p class="text-base leading-4">Delivery Address: </p>
                    <p class="text-base leading-4">{{$order[0] -> address}}</p>
                </div>
                <div class="flex justify-between items-center w-full text-gray-900 font-bold">
                    <p class="text-base leading-4">Order Date: </p>
                    <p class="text-base leading-4">{{ Carbon\Carbon::createFromTimestamp(@$order[0] -> order_date)->tz('Australia/Brisbane')->toDateTimeString()}}</p>
                </div>
                @foreach ($order as $orderInfo)
                    <div class="flex justify-between items-center w-full">
                        <p class="text-base leading-4 text-gray-800">
                            {{ $orderInfo -> dish_name }} x {{ $orderInfo -> quantity }}
                            @if ($orderInfo -> discount)
                                <span class="p-1 text-xs font-medium bg-white leading-3 text-gray-400">{{$orderInfo -> discount }}% OFF</span>
                            @endif
                        </p>
                        <p class="text-base leading-4 text-gray-600">${{ getFinalDishPrice($orderInfo, false) }}</p>
                    </div>
                @endforeach
            @endforeach
        </div>
        <div class="flex justify-between items-center w-full mt-4">
            <p class="text-base font-semibold leading-4 text-gray-800">Total</p>
            <p class="text-base font-semibold leading-4 text-gray-600">$ {{ getOrderSum($orders, false) }}</p>
        </div>
    </div>
@endsection
