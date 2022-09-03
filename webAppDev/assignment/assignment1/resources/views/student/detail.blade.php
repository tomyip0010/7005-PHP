@extends('layouts.master')

@section('title')
  Detail
@endsection

@section('content')
  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
      <h6 class="m-0 font-weight-bold text-primary">Student Detail</h6>
    </div>
    <div class="card-body container">
      <div class="row">
        <p class="col-3">ID: </p>
        <p class="col-9">{{ $student -> id}}</p>
      </div>
      <div class="row">
        <p class="col-3">First Name: </p>
        <p class="col-9 white-space-pre">{{ $student -> first_name}}</p>
      </div>
      <div class="row">
        <p class="col-3">Last Name: </p>
        <p class="col-9">{{ $student -> last_name }}</p>
      </div>
    </div>
    <!-- Table -->
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Applications</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Project ID</th>
                <th>Project Title</th>
                <th>Company Name</th>
                <th>Priority</th>
              </tr>
            </thead>
            <tbody>
              @forelse($applications as $application)
                <tr>
                  <td>{{ $application -> project_id }}</td>
                  <td>{{ $application -> title }}</td>
                  <td>{{ $application -> company_name }}</td>
                  <td>{{ $application -> priority }}</td>
                </tr>
              @empty
                <tr>
                  <td colspan=4>
                    No results found.
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
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