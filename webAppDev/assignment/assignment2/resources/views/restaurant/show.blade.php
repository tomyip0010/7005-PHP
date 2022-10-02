@extends('layouts.app')

@section('title')
{{ $restaurant -> name}}
<p>
	<small class="text-gray-400">{{$restaurant -> address}}</small>
</p>
@endsection

@section('content')
    @if (isOwnedRestaurant($restaurant -> id))
        <a href='{{url("dish/create")}}' class="ml-auto bg-primary hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Add Dish
        </a>
    @endif
	<div class="flex gap-2 my-4">
		<div class="flex flex-col gap-2 w-full">
			@forelse($dishes as $dish)
				<div class="flex flex-row items-center bg-white rounded-lg border shadow-md">
					<div class="w-75 flex flex-col justify-between p-4 leading-normal">
						<div class="flex gap-2">
							<h5 class="mb-2 text-2xl font-bold text-black">{{ $dish -> name }}</h5>
							@if (Auth::check() && getUserTypeLabel() === 'customer')
								@if ($dish -> favouritedBy() -> where('customer_id', Auth::id()) -> count() > 0)
									<form method="POST" action='{{url("favourite/".$dish -> id)}}'>
										{{csrf_field()}}
										{{ method_field('DELETE') }}
										<button type="submit" class="text-red-400 border-2 rounded-full p-2 hover:bg-red-400 hover:text-white">
											<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
												<path d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z" />
											</svg>
										</button>
										<!-- <input type="submit" value="" class="text-red-400 rounded-full p-2 hover:bg-red-400 hover:text-white"> -->
									</form>
								@else
									<form method="POST" action='{{url("favourite")}}'>
										{{csrf_field()}}
										<input type="hidden" name="dishId" value="{{$dish -> id}}">
										<button type="submit" class="text-gray-400 border-2 rounded-full p-2 hover:bg-red-400 hover:text-white">
											<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
												<path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
											</svg>
										</button>
										<!-- <input type="submit" value="" class="text-red-400 rounded-full p-2 hover:bg-red-400 hover:text-white"> -->
									</form>
								@endif
							@endif
						</div>
						@if ($dish->discount)
							<div class="flex">
								<b class="font-bold text-primary">${{ $dish -> price * (100 - $dish -> discount)/100 }}</b>
								<small class="font-bold line-through ml-2">${{ $dish -> price }}</small>
								<small class="badge bg-primary text-capitalize ml-2">{{ $dish -> discount }}% off</small>
							</div>
						@else
							<small class="font-bold">${{ $dish -> price }}</small>
						@endif
						<p class="mb-3 font-normal text-gray-700 text-gray-400">{{ $dish -> description }}</p>
						<div class="flex justify-start mb-4 gap-2">
							@if ($dish -> images() -> count() > 0)
								@foreach ($dish -> images as $image)
									<div class="flex flex-col gap-2">
										<img style="width: 125px; height: 100px" src="{{url($image->filePath)}}" alt="" />
										<div class="flex flex-col">
											@foreach($image -> uploadedBy() -> get() as $uploader)
												<small><b>Uploaded By:</b></small>
												<small>{{ $uploader -> name}}</small>
											@endforeach
										</div>
									</div>
								@endforeach
							@endif
						</div>
						@if (Auth::check())
						<div class="relative flex items-center justify-start overflow-hidden">
							<a href='{{url("image/create?dishId=$dish->id")}}' class="px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">+ Upload Image</a>	
						</div>
						@endif
					</div>
					<div class="h-full flex ">
						@if (isOwnedRestaurant($restaurant -> id))
							<div class="flex mt-4 space-x-3 md:mt-6">
								<div>
									<a href='{{url("dish/$dish->id/edit")}}' class="d-block px-4 py-2 bg-gray-800 rounded-md font-bold text-white">Edit</a>
								</div>
								<div class="ml-4">
									<form method="POST" action='{{url("dish/$dish->id")}}'>
										{{csrf_field()}}
										{{ method_field('DELETE') }}
										<input type="submit" value="Delete" class="bg-danger text-white font-bold py-2 px-4 rounded"">
									</form>
								</div>
							</div>
						@elseif (Auth::check() && Auth::user() -> userType === '3')
							<form method="POST" action='{{url("order")}}' class="h-[180px] flex flex-col justify-between py-4">
								{{csrf_field()}}
								<div class="custom-number-input h-10 w-32">
									<label for="quantity" class="w-full text-gray-700 text-sm font-semibold">Quantity</label>
									<div class="flex flex-row h-10 w-full rounded-lg relative bg-transparent mt-1">
										<button data-action="decrement" class=" bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-l cursor-pointer outline-none">
											<span class="m-auto text-2xl font-thin">−</span>
										</button>
										<input type="number" min=1 value="1" class="outline-none border-0 focus:outline-none text-center w-full bg-gray-300 font-semibold text-md hover:text-black focus:text-black  md:text-basecursor-default flex items-center text-gray-700  outline-none" name="quantity" value="0"></input>
										<button data-action="increment" class="bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-r cursor-pointer">
											<span class="m-auto text-2xl font-thin">+</span>
										</button>
									</div>
								</div>
								<input type="hidden" name="dishId" value="{{$dish -> id}}">
								<input type="submit" value="Add to order" class="bg-cyan-500 text-white font-bold py-2 px-4 rounded"">
							</form>
						@endif
					</div>
				</div>
			@empty
				<div>Empty</div>
			@endforelse
		</div>
		@if ($orders && $orders -> count() > 0)
			<div class="flex flex-col px-4 py-6 md:p-6 xl:p-8 w-1/2 max-w-[350px] bg-white rounded-lg border shadow-md">
				<h3 class="text-xl font-semibold leading-5 text-gray-800">Order Summary</h3>
				<div class="flex justify-center items-center w-full space-y-4 mt-4 flex-col border-gray-200 border-b pb-4">
					@foreach ($orders as $order)
						<div class="flex justify-between items-center w-full">
							<p class="text-base leading-4 text-gray-800">
								{{ $order -> name }} x {{ $order -> pivot -> quantity }}
								@if ($order -> discount)
									<span class="p-1 text-xs font-medium bg-white leading-3 text-gray-400">{{$order -> discount }}% OFF</span>
								@endif
							</p>
							<div class="flex gap-2 items-center w-1/2 justify-end">
								<form method="POST" action='{{url("order/$order->id")}}'>
									{{csrf_field()}}
									{{ method_field('DELETE') }}
									<button type="submit" class="text-red-400 rounded-full p-2 hover:bg-red-400 hover:text-white">
										<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/></svg>
									</button>
									<!-- <input type="submit" value="" class="text-red-400 rounded-full p-2 hover:bg-red-400 hover:text-white"> -->
								</form>
								<p class="text-base leading-4 text-gray-600">$ {{ getFinalDishPrice($order) }}</p>
							</div>
						</div>
					@endforeach
				</div>
				<div class="flex justify-between items-center w-full mt-4">
					<p class="text-base font-semibold leading-4 text-gray-800">Total</p>
					<p class="text-base font-semibold leading-4 text-gray-600">$ {{ getOrderSum($orders) }}</p>
				</div>
				<form method="POST" action='{{url("order")}}' class="h-[180px] flex flex-col justify-between py-4">
					{{csrf_field()}}
					<input type="hidden" name="placeOrder" value="true">
					<input type="hidden" name="restaurantId" value="{{$restaurant -> id}}">
					<input type="submit" value="Place Order Now" class="bg-red-400 text-white font-bold py-2 px-4 rounded"">
				</form>
			</div>
		@endif
	</div>
	{{ $dishes->links()}}


	<style>
	input[type='number']::-webkit-inner-spin-button,
	input[type='number']::-webkit-outer-spin-button {
		-webkit-appearance: none;
		margin: 0;
	}

	.custom-number-input input:focus {
		outline: none !important;
	}

	.custom-number-input button:focus {
		outline: none !important;
	}
	</style>

	<script>
	function decrement(e) {
		e.preventDefault();
		const btn = e.target.parentNode.parentElement.querySelector(
		'button[data-action="decrement"]'
		);
		const target = btn.nextElementSibling;
		let value = Number(target.value);
		if (value > 1) {
			value--;
			target.value = value;
		}
	}

	function increment(e) {
		e.preventDefault();
		const btn = e.target.parentNode.parentElement.querySelector(
		'button[data-action="decrement"]'
		);
		const target = btn.nextElementSibling;
		let value = Number(target.value);
		value++;
		target.value = value;
	}

	const decrementButtons = document.querySelectorAll(
		`button[data-action="decrement"]`
	);

	const incrementButtons = document.querySelectorAll(
		`button[data-action="increment"]`
	);

	decrementButtons.forEach(btn => {
		btn.addEventListener("click", decrement);
	});

	incrementButtons.forEach(btn => {
		btn.addEventListener("click", increment);
	});
	</script>
@endsection
