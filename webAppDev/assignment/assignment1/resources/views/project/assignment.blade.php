@extends('layouts.master')

@section('title')
  Project Assigment
@endsection

@section('content')
  <!-- Table -->
  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
      <h6 class="m-0 font-weight-bold text-primary">Project Assignment</h6>
      <form method="post" action="{{url('project/assignment')}}">
        {{ csrf_field() }}
        <input type="submit" value="Auto Assign" class="btn btn-success btn-user btn-block">
      </form>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Student ID</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Project ID</th>
              <th>Project Name</th>
            </tr>
          </thead>
          <tbody>
            @forelse($assignments as $assignment)
              <tr>
                <td>{{ $assignment -> student_id }}</td>
                <td>{{ $assignment -> first_name }}</td>
                <td>{{ $assignment -> last_name }}</td>
                <td>{{ $assignment -> project_id }}</td>
                <td>{{ $assignment -> title }}</td>
              </tr>
            @empty
              <tr>
                <td colspan=5>
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
