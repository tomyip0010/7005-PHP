@extends('layouts.master')

@section('title')
   Associative array search result page
@endsection

@section('action')
   <h3>Search result for {{ $filter }}</h3>
@endsection

@section('content')
    <table class="bordered">
        <thead>
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>From</th>
                <th>To</th>
                <th>Duration</th>
                <th>Party</th>
                <th>State</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pms as $pm)
                <tr>
                    <td>{{ $loop -> index + 1 }}</td>
                    <td>{{ $pm['name'] }}</td>
                    <td>{{ $pm['from'] }}</td>
                    <td>{{ $pm['to'] }}</td>
                    <td>{{ $pm['duration'] }}</td>
                    <td>{{ $pm['party'] }}</td>
                    <td>{{ $pm['state'] }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan=7>
                        No results found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection                                          