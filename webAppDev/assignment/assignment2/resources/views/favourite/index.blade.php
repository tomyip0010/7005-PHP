@extends('layouts.app')

@section('title')
    My Favourite Dishes
@endsection

@section('content')
	@if ($dish)
		<h2 class="font-bold text-3xl mb-2">You may also like: </h2>
		<div class="bg-white rounded-lg border shadow-md">
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
				<a class="font-bold" href='{{url("restaurant/".$dish -> restaurant -> id)}}'>{{$dish -> restaurant -> name}}</a>
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
			</div>
		</div>
	@endif
    <div class="relative rounded-xl overflow-auto">
		<div class="shadow-sm overflow-hidden py-5">
			<table class="border-collapse table-fixed w-full text-sm bg-white">
				<thead>
					<tr>
						<th class="px-6 py-4">ID</th>
						<th class="px-6 py-4">Dish</th>
						<th class="px-6 py-4">Restaurant</th>
					</tr>
				</thead>
				<tbody>
					@forelse($favDishes as $favDish)
						<tr class="hover-bg cursor-pointer">
							<td class="border-t border-slate-100 dark:border-slate-700 text-slate-500 dark:text-slate-400">
								<a href="restaurant/{{$favDish->restaurant->id}}" class="w-100 h-100 p-4 pl-8 d-block !text-black font-bold">
									{{ $favDish -> id }}
								</a>
							</td>
							<td class="border-t border-slate-100 dark:border-slate-700 text-slate-500 dark:text-slate-400">
								<a href="restaurant/{{$favDish->restaurant->id}}" class="w-100 h-100 p-4 pl-8 d-block text-d !text-black font-bold">
									{{ $favDish -> name }}
								</a>
							</td>
							<td class="border-t border-slate-100 dark:border-slate-700 text-slate-500 dark:text-slate-400">
								<a href="restaurant/{{$favDish->restaurant->id}}" class="w-100 h-100 p-4 pl-8 d-block text-d !text-black font-bold">
									{{ $favDish -> restaurant -> name }}
								</a>
							</td>
						</tr>
					@empty
						<tr>
							<td colspan=3 class="px-6 py-4">Empty</td>
						</tr>
					@endforelse
				</tbody>
			</table>
		</div>
	</div>
@endsection
