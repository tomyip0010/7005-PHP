@extends('layouts.app')

@section('title')
	Welcome to Food Portal
@endsection

@section('content')
<div class="relative rounded-xl overflow-auto">
	<h2 class="font-bold text-2xl text-orange-500 flex gap-2 items-center">
		<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
			<path stroke-linecap="round" stroke-linejoin="round" d="M15.362 5.214A8.252 8.252 0 0112 21 8.25 8.25 0 016.038 7.048 8.287 8.287 0 009 9.6a8.983 8.983 0 013.361-6.867 8.21 8.21 0 003 2.48z" />
			<path stroke-linecap="round" stroke-linejoin="round" d="M12 18a3.75 3.75 0 00.495-7.467 5.99 5.99 0 00-1.925 3.546 5.974 5.974 0 01-2.133-1A3.75 3.75 0 0012 18z" />
		</svg>
		<span>Top 5 Ordered Dishes</span>
	</h2>
	<div class="shadow-sm overflow-hidden py-5">
		<table class="border-collapse table-fixed w-full text-sm bg-white">
			<thead>
				<tr>
					<th class="px-6 py-4">Dish Name</th>
					<th class="px-6 py-4">Total Ordered</th>
					<th class="px-6 py-4">Restaurant</th>
				</tr>
			</thead>
			<tbody>
				@forelse($top5Orders as $order)
					<tr class="hover-bg cursor-pointer">
						<td class="border-t border-slate-100 dark:border-slate-700 text-slate-500 dark:text-slate-400">
							<a href="restaurant/{{$order -> dishes -> restaurant_id}}" class="w-100 h-100 p-4 pl-8 d-block text-d !text-black font-bold">
								{{ $order -> dishes -> name }}
							</a>
						</td>
						<td class="border-t border-slate-100 dark:border-slate-700 text-slate-500 dark:text-slate-400">
							<a href="restaurant/{{$order -> dishes -> restaurant_id}}" class="w-100 h-100 p-4 pl-8 d-block text-d !text-black font-bold">
								{{ $order -> dishOrderCount }}
							</a>
						</td>
						<td class="border-t border-slate-100 dark:border-slate-700 text-slate-500 dark:text-slate-400">
							<a href="restaurant/{{$order -> dishes -> restaurant_id}}" class="w-100 h-100 p-4 pl-8 d-block text-d !text-black font-bold">
								{{ $order -> dishes -> restaurant -> name }}
							</a>
						</td>
					</tr>
				@empty
					<tr>
						<td colspan=2 class="px-6 py-4">Empty</td>
					</tr>
				@endforelse
			</tbody>
		</table>
	</div>
</div>
@endsection
