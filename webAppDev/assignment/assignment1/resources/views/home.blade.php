@extends('layouts.master')

@section('title')
  Home
@endsection

@section('content')
  <!-- Table -->
  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
      <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
      <a href="{{url('project/advertise')}}" class="btn btn-success">
        <span class="text">+ Advertise</span>
      </a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>ID</th>
              <th>Title</th>
              <th>Company</th>
              <th>Total Applications</th>
            </tr>
          </thead>
          <tbody>
            @forelse($projects as $project)
              <tr class="row-clickable" data-path="{{url('project/'.$project -> id) }}">
                <td>{{ $project -> id }}</td>
                <td>{{ $project -> title }}</td>
                <td>{{ $project -> company_name }}</td>
                <td>{{ $project -> application_no }}</td>
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
