@extends('layouts.app')

@section('title')
    Orders List
@endsection

@section('content')
    <div class="relative rounded-xl overflow-auto">
		<div class="shadow-sm overflow-hidden py-5">
			<table class="border-collapse table-fixed w-full text-sm bg-white">
				<thead>
					<tr>
						<th class="px-6 py-4">Order ID #</th>
						<th class="px-6 py-4">Order Date</th>
					</tr>
				</thead>
				<tbody>
					@forelse($orders -> groupby('cart_id') as $order)
						<tr class="hover-bg cursor-pointer">
							<td class="border-t border-slate-100 dark:border-slate-700 text-slate-500 dark:text-slate-400">
								<a href="order/{{$order[0]->cart_id}}" class="w-100 h-100 p-4 pl-8 d-block !text-black font-bold">
									{{ $order[0] -> cart_id }}
								</a>
							</td>
							<td class="border-t border-slate-100 dark:border-slate-700 text-slate-500 dark:text-slate-400">
								<a href="order/{{$order[0]->cart_id}}" class="w-100 h-100 p-4 pl-8 d-block text-d !text-black font-bold">
									{{ Carbon\Carbon::createFromTimestamp(@$order[0] -> order_date)->tz('Australia/Brisbane')->toDateTimeString() }}
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
