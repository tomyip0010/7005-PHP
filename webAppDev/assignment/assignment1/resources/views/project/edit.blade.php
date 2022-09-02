@extends('layouts.master')

@section('title')
  Edit Project
@endsection

@section('content')
  <form class="user" method="post" action="{{url('project/'.$project -> id)}}">
    {{ csrf_field() }}
    <div class="form-group">
      <input value={{ $project -> company_name }} disabled type="text" name="companyName" class="form-control" placeholder="Company Name">
    </div>
    <div class="form-group">
      <input value={{ $project -> location }} disabled type="text" name="location" class="form-control" placeholder="Location">
    </div>
    <div class="form-group">
      <input value={{ $project -> title }} type="text" name="title" class="form-control" placeholder="Project Title">
    </div>
    <div class="form-group">
      <input value={{ $project -> related_major }} type="text" name="relatedMajor" class="form-control" placeholder="Related Major">
    </div>
    <div class="form-group">
      <textarea name="description" rows="6" class="form-control" placeholder="Project Description">{{ $project -> description }}</textarea>
    </div>
    <div class="form-group">
      <select name="availableSlot" class="form-control">
        <option value="" disabled>Select number of available positions</option>
        @foreach (range(3,8) as $opt)
          <option value="{{$opt}}" {{intval($opt) == intval($project -> available_slot) ? 'selected' : ''}}>{{$opt}}</option>
        @endforeach
    	</select>
    </div>
    <input type="submit" value="Confirm" class="btn btn-primary btn-user btn-block">
  </form>
@endsection