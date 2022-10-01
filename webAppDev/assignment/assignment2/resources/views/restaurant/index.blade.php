@extends('layouts.app')

@section('title')
Restaurants
@endsection

@section('content')
<div class="relative rounded-xl overflow-auto">
    <div class="shadow-sm overflow-hidden py-5">
        <table class="border-collapse table-fixed w-full text-sm bg-white">
            <thead>
                <tr>
                    <th class="px-6 py-4">ID</th>
                    <th class="px-6 py-4">Name</th>
                </tr>
            </thead>
            <tbody>
                @forelse($restaurants as $restaurant)
                    <tr class="hover-bg cursor-pointer">
                        <td class="border-t border-slate-100 dark:border-slate-700 text-slate-500 dark:text-slate-400">
                            <a href="restaurant/{{$restaurant->id}}" class="w-100 h-100 p-4 pl-8 d-block !text-black font-bold">
                                {{ $restaurant -> id }}
                            </a>
                        </td>
                        <td class="border-t border-slate-100 dark:border-slate-700 text-slate-500 dark:text-slate-400">
                            <a href="restaurant/{{$restaurant->id}}" class="w-100 h-100 p-4 pl-8 d-block text-d !text-black font-bold">
                                {{ $restaurant -> name }}
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
{{ $restaurants->links()}}
@endsection
