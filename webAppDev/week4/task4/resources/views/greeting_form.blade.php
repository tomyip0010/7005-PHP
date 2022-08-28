@extends('layouts.master')

@section('title')
   Greeting Form
@endsection

@section('content')
    <form action="greeting" method="post">
        {{ csrf_field() }}
        First name:<br>

        <input type="text" name="name"><br>

        Age:<br>

        <input type="text" name="age"><br><br>

        <input type="submit" value="Submit">
    </form> 
@endsection                                          