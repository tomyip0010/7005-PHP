@extends('layouts.master')

@section('title')
  Product Detail
@endsection

@section('content')
  <h1>Product: {{$product->name}}</h1>
  <p>Price: {{$product->price}}</p>
  <p>Manufacturer: {{$product->manufacturer->name}}</p>
  <p><a href='{{url("product/$product->id/edit")}}'>Edit</a></p>
  <p>
    <form method="POST" action='{{url("product/$product->id")}}'>
      {{csrf_field()}}
      {{ method_field('DELETE') }}
      <input type="submit" value="Delete">
    </form>
  </p>
@endsection