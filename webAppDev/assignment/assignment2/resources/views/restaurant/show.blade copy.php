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
	<div class="relative rounded-xl overflow-auto">
		<div class="shadow-sm overflow-hidden py-5">
			<table class="border-collapse table-fixed w-full text-sm bg-white">
				<thead>
					<tr>
						<th class="px-6 py-4">ID</th>
						<th class="px-6 py-4">Image</th>
						<th class="px-6 py-4">Name</th>
						<th class="px-6 py-4">Price</th>
						<th class="px-6 py-4">Description</th>
						<th class="px-6 py-4"></th>
					</tr>
				</thead>
				<tbody>
					@forelse($dishes as $dish)
						<tr class="">
							<td class="text-center border-t border-slate-100 dark:border-slate-700 text-slate-500 dark:text-slate-400">
								{{ $dish -> id }}
							</td>
							<td class="border-t border-slate-100 dark:border-slate-700 text-slate-500 dark:text-slate-400">
								@if ($dish->image)
									<img style="width: 125px; height: 100px" src="{{url($dish->image)}}" alt="" />
								@else
									<img style="width: 125px; height: 100px" src="{{asset('dish_images/default-placeholder.png')}}" alt="" />
								@endif
							</td>
							<td class="border-t border-slate-100 dark:border-slate-700 text-slate-500 dark:text-slate-400">
								{{ $dish -> name }}
							</td>
							<td class="border-t border-slate-100 dark:border-slate-700 text-slate-500 dark:text-slate-400">
								${{ $dish -> price }}
							</td>
							<td class="border-t border-slate-100 dark:border-slate-700 text-slate-500 dark:text-slate-400">
								{{ $dish -> description }}
							</td>
                            @if (isOwnedRestaurant($restaurant -> id))
                                <td class="border-t border-slate-100 dark:border-slate-700 text-slate-500 dark:text-slate-400 d-flex gap-2 p-4 pl-8">
                                    <a href='{{url("dish/$dish->id/edit")}}' class="bg-primary hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        Edit
                                    </a>
                                    <span>
                                        <form method="POST" action='{{url("dish/$dish->id")}}'>
                                            {{csrf_field()}}
                                            {{ method_field('DELETE') }}
                                            <input type="submit" value="Delete" class="bg-danger hover:bg-red-700 text-white font-bold py-2 px-4 rounded"">
                                        </form>
                                    </span>
                                </td>
                            @endif
						</tr>
					@empty
						<tr>
							<td colspan=4 class="px-6 py-4">Empty</td>
						</tr>
					@endforelse
				</tbody>
			</table>
		</div>
	</div>
	{{ $dishes->links()}}
@endsection
