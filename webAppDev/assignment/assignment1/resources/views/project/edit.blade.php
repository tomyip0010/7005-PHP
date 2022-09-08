@extends('layouts.master')

@section('title')
  Edit Project
@endsection

@section('content')
  <form class="user mb-4" method="post" action="{{url('project/'.$projectId)}}">
    {{ csrf_field() }}
    <div class="form-group">
      <label for="companyName">Company Name</label>
      <input value="{{ $project -> company_name }}" disabled type="text" class="form-control" name="companyName" placeholder="Company Name">
      <input value="{{ $project -> company_name }}" hidden type="text" name="companyName" placeholder="Company Name">
    </div>
    <div class="form-group">
      <label for="location">Company Location</label>
      <input value="{{ $project -> location }}" disabled type="text" class="form-control" name="location" placeholder="Location">
      <input value="{{ $project -> location }}" hidden type="text" name="location" placeholder="Location">
    </div>
    <div class="form-group">
      <label for="title">Project Title</label>
      <input value="{{ $project -> title }}" type="text" name="title" class="form-control {{$errors->has('title') ? 'is-invalid' : ''}}" placeholder="Project Title">
    </div>
    <div class="form-group">
      <label for="relatedMajor">Related Major</label>
      <input value="{{ $project -> related_major }}" type="text" name="relatedMajor" class="form-control {{$errors->has('relatedMajor') ? 'is-invalid' : ''}}" placeholder="Related Major">
    </div>
    <div class="form-group">
      <label for="description">Project Description</label>
      <textarea name="description" rows="6" class="form-control {{$errors->has('description') ? 'is-invalid' : ''}}" placeholder="Project Description">{{ $project -> description }}</textarea>
    </div>
    <div class="form-group">
      <label for="availableSlot">No. of Available Positions</label>
      <!-- <input type="text" name="availableSlot" value="{{ $project -> available_slot }}" class="form-control {{$errors->has('availableSlot') ? 'is-invalid' : ''}}" placeholder="Related Major">
      @if($errors->has('availableSlot'))
        <div class="invalid-feedback">{{ $errors->first('availableSlot') }}</div>
      @endif -->
      <select name="availableSlot" class="form-control {{$errors->has('availableSlot') ? 'is-invalid' : ''}}">
        <option value="" disabled>Select number of available positions</option>
        @foreach (range(1,10) as $opt)
          <option value="{{$opt}}" {{$opt == $project -> available_slot ? 'selected' : ''}}>{{$opt}}</option>
        @endforeach
    	</select>
      @if($errors->has('availableSlot'))
        <div class="invalid-feedback">{{ $errors->first('availableSlot') }}</div>
      @endif
    </div>
    <input type="submit" value="Confirm" class="btn btn-primary btn-user btn-block">
  </form>
@endsection