@extends('layouts.master')

@section('title')
   Associative array search
@endsection

@section('action')
   Query
@endsection

@section('content')
    <form method="get" action="search">
        {{ csrf_field() }}
        <table>
            <tr>
                <td>Name: </td>
                <td>
                    <input type="text" name="name">
                </td>
            </tr>
            <tr>
                <td>Year: </td>
                <td>
                    <input type="text" name="year">
                </td>
            </tr>
            <tr>
                <td>State: </td>
                <td>
                    <input type="text" name="state">
                </td>
            </tr>
            <tr>
                <td colspan=2>
                    <input type="submit" value="Search">
                    <input type="reset" value="Reset">
                </td>
            </tr>
        <table>
    </form>
@endsection                                          