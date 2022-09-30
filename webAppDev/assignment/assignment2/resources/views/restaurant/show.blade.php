@extends('layouts.app')

@section('title')
{{ $restaurant -> name}}
@endsection

@section('content')
    @if (isOwnedRestaurant($restaurant -> id))
        <a href='{{url("dish/create")}}' class="ml-auto bg-primary hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Add Dish
        </a>
    @endif
	@forelse($dishes as $dish)
		<div class="my-4 flex flex-row items-center bg-white rounded-lg border shadow-md">
			<div class="w-75 flex flex-col justify-between p-4 leading-normal">
				<h5 class="mb-2 text-2xl font-bold text-black">{{ $dish -> name }}</h5>
				@if ($dish->discount)
					<div class="flex">
						<b class="font-bold text-primary">${{ $dish -> price * (100 - $dish -> discount)/100 }}</b>
						<small class="font-bold line-through ml-2">${{ $dish -> price }}</small>
						<small class="badge bg-primary text-capitalize ml-2">{{ $dish -> discount }}% off</small>
					</div>
				@else
					<small class="font-bold">${{ $dish -> price }}</small>
				@endif
				<p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $dish -> description }}</p>
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
						<a href='{{url("dish/$dish->id/edit")}}' class="inline-flex items-center px-4 py-2 bg-gray-800 rounded-md font-semibold text-xs text-white uppercase">Edit</a>
						<div class="ml-4">
							<form method="POST" action='{{url("dish/$dish->id")}}'>
								{{csrf_field()}}
								{{ method_field('DELETE') }}
								<input type="submit" value="Delete" class="bg-danger text-white font-bold py-2 px-4 rounded"">
							</form>
						</div>
					</div>
				@elseif (Auth::check())
					<form method="POST" action='{{url("order")}}' class="h-[180px] flex flex-col justify-between py-4">
						{{csrf_field()}}
						<div class="custom-number-input h-10 w-32">
							<label for="quantity" class="w-full text-gray-700 text-sm font-semibold">Quantity</label>
							<div class="flex flex-row h-10 w-full rounded-lg relative bg-transparent mt-1">
								<button data-action="decrement" class=" bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-l cursor-pointer outline-none">
									<span class="m-auto text-2xl font-thin">−</span>
								</button>
								<input type="number" class="outline-none border-0 focus:outline-none text-center w-full bg-gray-300 font-semibold text-md hover:text-black focus:text-black  md:text-basecursor-default flex items-center text-gray-700  outline-none" name="quantity" value="0"></input>
								<button data-action="increment" class="bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-r cursor-pointer">
									<span class="m-auto text-2xl font-thin">+</span>
								</button>
							</div>
						</div>
						<input type="submit" value="Add to order" class="bg-cyan-500 text-white font-bold py-2 px-4 rounded"">
					</form>
				@endif
			</div>
		</div>
	@empty
		<div>Empty</div>
	@endforelse
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
		value--;
		target.value = value;
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
