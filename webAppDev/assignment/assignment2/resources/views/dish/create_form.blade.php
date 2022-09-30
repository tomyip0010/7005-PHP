@extends('layouts.app')

@section('title')
    Add Dish
@endsection

@section('content')
    <form method="POST" action='{{url("dish")}}' enctype="multipart/form-data">
        @csrf

        <!-- Dish Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" autofocus />
            @if ($errors->first('name'))
                <span class="text-danger font-bold">{{$errors->first('name')}}</span>
            @endif
        </div>

        <!-- Dish Description -->
        <div class="mt-4">
            <x-input-label for="description" :value="__('description')" />
            <textarea id="description" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" type="text" name="description">{{ old('description') }}</textarea>
            @if ($errors->first('description'))
                <span class="text-danger font-bold">{{$errors->first('description')}}</span>
            @endif
        </div>

        <!-- Dish Price -->
        <div class="mt-4">
            <x-input-label for="price" :value="__('Price($)')" />
            <x-text-input id="price" class="block mt-1 w-full" type="number" step=".01" name="price" :value="old('price')" />
            @if ($errors->first('price'))
                <span class="text-danger font-bold">{{$errors->first('price')}}</span>
            @endif
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-4">
                {{ __('Create') }}
            </x-primary-button>
        </div>
    </form>
@endsection
