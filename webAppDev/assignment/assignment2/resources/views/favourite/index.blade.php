@extends('layouts.app')

@section('title')
    My Favourite Dishes
@endsection

@section('content')
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
