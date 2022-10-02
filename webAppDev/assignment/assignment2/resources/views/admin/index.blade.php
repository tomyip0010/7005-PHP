@extends('layouts.app')

@section('title')
    Admin - Restaurant Management Dashboard
@endsection

@section('content')
    <div class="relative rounded-xl overflow-auto">
		<div class="shadow-sm overflow-hidden py-5">
			<table class="border-collapse table-fixed w-full text-sm bg-white">
				<thead>
					<tr>
						<th class="px-6 py-4">ID</th>
						<th class="px-6 py-4">Restaurant</th>
						<th class="px-6 py-4">Action</th>
					</tr>
				</thead>
				<tbody>
					@forelse($unapprovedRestaurants as $unapprovedRestaurant)
						<tr class="hover-bg cursor-pointer">
							<td class="border-t border-slate-100 dark:border-slate-700 text-slate-500 dark:text-slate-400">
								<a href="restaurant/{{$unapprovedRestaurant->id}}" class="w-100 h-100 p-4 pl-8 d-block !text-black font-bold">
									{{ $unapprovedRestaurant -> id }}
								</a>
							</td>
							<td class="border-t border-slate-100 dark:border-slate-700 text-slate-500 dark:text-slate-400">
								<a href="restaurant/{{$unapprovedRestaurant->id}}" class="w-100 h-100 p-4 pl-8 d-block text-d !text-black font-bold">
									{{ $unapprovedRestaurant -> name }}
								</a>
							</td>
							<td class="border-t border-slate-100 dark:border-slate-700 text-slate-500 dark:text-slate-400">
								<form method="POST" action='{{url("approve")}}'>
									@csrf
									<input type="hidden" name="restaurantId" value="{{$unapprovedRestaurant -> id}}">
									<input type="submit" value="Approve" class="bg-red-400 text-white rounded-full p-2 hover:bg-red-600 px-4 ml-4">
								</form>
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
