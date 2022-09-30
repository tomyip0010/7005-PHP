@extends('layouts.app')

@section('title')
    Add Dish
@endsection

@section('content')
    <form method="POST" action='{{url("dish/$dish->id")}}'>
        @csrf
        {{ method_field('PUT') }}
        <!-- Dish Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $dish->name)" autofocus />
            @if ($errors->first('name'))
                <span class="text-danger font-bold">{{$errors->first('name')}}</span>
            @endif
        </div>

        <!-- Dish Description -->
        <div class="mt-4">
            <x-input-label for="description" :value="__('description')" />
            <textarea id="description" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" type="text" name="description">{{ old('description', $dish->description) }}</textarea>
            @if ($errors->first('description'))
                <span class="text-danger font-bold">{{$errors->first('description')}}</span>
            @endif
        </div>

        <!-- Dish Price -->
        <div class="mt-4">
            <x-input-label for="price" :value="__('Price($)')" />
            <x-text-input id="price" class="block mt-1 w-full" type="number" step=".01" name="price" :value="old('price', $dish->price)" />
            @if ($errors->first('price'))
                <span class="text-danger font-bold">{{$errors->first('price')}}</span>
            @endif
        </div>

        <!-- Dish Discount -->
        <div class="mt-4">
            <x-input-label for="discount" :value="__('Discount(%)')" />
            <x-text-input id="discount" class="block mt-1 w-full" type="number" step=".01" name="discount" :value="old('discount', $dish->discount)" />
        </div>
        @if ($errors->first('discount'))
            <span class="text-danger font-bold">{{$errors->first('discount')}}</span>
        @endif

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-4">
                {{ __('Update') }}
            </x-primary-button>
        </div>
    </form>
@endsection
