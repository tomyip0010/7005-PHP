@extends('layouts.master')

@section('title')
  Detail
@endsection

@section('content')
  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
      <h6 class="m-0 font-weight-bold text-primary">Project Detail</h6>
      <div>
        <a href="{{url('project/delete/'.$projectId)}}" class="btn btn-danger">
          <span class="text">Delete</span>
        </a>
        <a href="{{url('project/edit/'.$projectId)}}" class="btn btn-success">
          <span class="text">Edit</span>
        </a>
      </div>
    </div>
    <div class="card-body container">
      <div class="row">
        <p class="col-3">Title: </p>
        <p class="col-9">{{ $project -> title}}</p>
      </div>
      <div class="row">
        <p class="col-3">Description: </p>
        <p class="col-9 white-space-pre">{{ $project -> description}}</p>
      </div>
      <div class="row">
        <p class="col-3">Major: </p>
        <p class="col-9">{{ $project -> related_major}}</p>
      </div>
      <div class="row">
        <p class="col-3">Available roles: </p>
        <p class="col-9">{{ $project -> available_slot }}</p>
      </div>
      <div class="row">
        <p class="col-3">Company: </p>
        <p class="col-9">{{ $project -> company_name }}</p>
      </div>
      <div class="row">
        <p class="col-3">Location: </p>
        <p class="col-9">{{ $project -> location }}</p>
      </div>
    </div>
    <!-- Table -->
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Applicants</h6>
        <a href="{{url("project/$projectId/apply")}}" class="btn btn-danger">
          <span class="text">Apply</span>
        </a>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Student ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Priority</th>
              </tr>
            </thead>
            <tbody>
              @forelse($students as $student)
                <tr class="row-clickable" data-path="{{url('application/'.$student -> applicationId) }}">
                  <td>{{ $student -> id }}</td>
                  <td>{{ $student -> first_name }}</td>
                  <td>{{ $student -> last_name }}</td>
                  <td>{{ $student -> priority }}</td>
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