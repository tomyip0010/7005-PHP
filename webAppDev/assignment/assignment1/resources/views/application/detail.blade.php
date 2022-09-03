@extends('layouts.master')

@section('title')
  Detail
@endsection

@section('content')
  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
      <h6 class="m-0 font-weight-bold text-primary">Application Detail</h6>
    </div>
    <div class="card-body container">
      <div class="row">
        <p class="col-3">Project Name: </p>
        <p class="col-9">{{ $application -> title }}</p>
      </div>
      <div class="row">
        <p class="col-3">Company: </p>
        <p class="col-9">{{ $application -> company_name }}</p>
      </div>
      <div class="row">
        <p class="col-3">First Name: </p>
        <p class="col-9">{{ $application -> first_name }}</p>
      </div>
      <div class="row">
        <p class="col-3">Last Name: </p>
        <p class="col-9">{{ $application -> last_name }}</p>
      </div>
      <div class="row">
        <p class="col-3">Justification: </p>
        <p class="col-9 white-space-pre">{{ $application -> justification }}</p>
      </div>
    </div>
  </div>
@endsection
