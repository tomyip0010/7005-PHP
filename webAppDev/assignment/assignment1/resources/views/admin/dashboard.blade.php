@extends('layouts.master')

@section('title')
  Dashboard
@endsection

@section('content')
  <!-- Table -->
  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
      <h6 class="m-0 font-weight-bold text-primary">Industry Project Leaderboard</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>ID</th>
              <th>Company</th>
              <th>Total Projects</th>
            </tr>
          </thead>
          <tbody>
            @forelse($companies as $company)
              <tr>
                <td>{{ $company -> id }}</td>
                <td>{{ $company -> company_name }}</td>
                <td>{{ $company -> project_no }}</td>
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