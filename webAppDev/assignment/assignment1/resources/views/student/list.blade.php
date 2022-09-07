@extends('layouts.master')

@section('title')
  Students List
@endsection

@section('content')
  <!-- Table -->
  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
      <h6 class="m-0 font-weight-bold text-primary">Students List</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>ID</th>
              <th>First Name</th>
              <th>Last Name</th>
            </tr>
          </thead>
          <tbody>
            @forelse($students as $student)
              <tr class="row-clickable" data-path="{{url('student/detail/'.$student -> student_id) }}">
                <td>{{ $student -> student_id }}</td>
                <td>{{ $student -> first_name }}</td>
                <td>{{ $student -> last_name }}</td>
              </tr>
            @empty
              <tr>
                <td colspan=3>
                  No results found.
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection

@section('styles')
  <link href="{{asset('css/common.css')}}" type="text/css" rel="stylesheet">
@endsection

@section('scripts')
  <script src="{{asset('js/datatable.js')}}"></script>
@endsection