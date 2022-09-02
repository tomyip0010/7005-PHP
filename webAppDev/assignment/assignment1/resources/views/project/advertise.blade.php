@extends('layouts.master')

@section('title')
  Advertise
@endsection

@section('content')
  <form class="user" method="post" action="{{url('project/advertise')}}">
    {{ csrf_field() }}
    <div class="form-group">
      <input type="text" name="companyName" class="form-control" placeholder="Company Name">
    </div>
    <div class="form-group">
      <input type="text" name="location" class="form-control" placeholder="Location">
    </div>
    <div class="form-group">
      <input type="text" name="title" class="form-control" placeholder="Project Title">
    </div>
    <div class="form-group">
      <input type="text" name="relatedMajor" class="form-control" placeholder="Related Major">
    </div>
    <div class="form-group">
      <textarea name="description" rows="6" class="form-control" placeholder="Project Description"></textarea>
    </div>
    <div class="form-group">
      <select name="availableSlot" class="form-control">
        <option value="" disabled selected>Select number of available positions</option>
        @foreach (range(3,8) as $opt)
          <option value="{{$opt}}">{{$opt}}</option>
        @endforeach
    	</select>
    </div>
    <input type="submit" value="Confirm" class="btn btn-primary btn-user btn-block">
  </form>
@endsection