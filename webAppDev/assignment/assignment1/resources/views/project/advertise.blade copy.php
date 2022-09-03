@extends('layouts.master')

@section('title')
  Advertise
@endsection

@section('content')
  <form class="user" method="post" action="{{url('project/advertise')}}">
    {{ csrf_field() }}
    <div class="form-group">
      <label for="companyName">Company Name</label>
      <input type="text" name="companyName" value="{{ old('companyName') }}" class="form-control {{$errors->has('companyName') ? 'is-invalid' : ''}}" placeholder="Company Name">
      @if($errors->has('companyName'))
        <div class="invalid-feedback">{{ $errors->first('companyName') }}</div>
      @endif
    </div>
    <div class="form-group">
      <label for="location">Company Location</label>
      <input type="text" name="location" value="{{ old('location') }}" class="form-control {{$errors->has('location') ? 'is-invalid' : ''}}" placeholder="Location">
      @if($errors->has('location'))
        <div class="invalid-feedback">{{ $errors->first('location') }}</div>
      @endif
    </div>
    <div class="form-group">
      <label for="title">Project Title</label>
      <input type="text" name="title" value="{{ old('title') }}" class="form-control {{$errors->has('title') ? 'is-invalid' : ''}}" placeholder="Project Title">
      @if($errors->has('title'))
        <div class="invalid-feedback">{{ $errors->first('title') }}</div>
      @endif
    </div>
    <div class="form-group">
      <label for="relatedMajor">Related Major</label>
      <input type="text" name="relatedMajor" value="{{ old('relatedMajor') }}" class="form-control {{$errors->has('relatedMajor') ? 'is-invalid' : ''}}" placeholder="Related Major">
      @if($errors->has('relatedMajor'))
        <div class="invalid-feedback">{{ $errors->first('relatedMajor') }}</div>
      @endif
    </div>
    <div class="form-group">
      <label for="description">Project Description</label>
      <textarea name="description" rows="6" class="form-control {{$errors->has('description') ? 'is-invalid' : ''}}" placeholder="Project Description">{{ old('description') }}</textarea>
      @if($errors->has('description'))
        <div class="invalid-feedback">{{ $errors->first('description') }}</div>
      @endif
    </div>
    <div class="form-group">
      <label for="availableSlot">No. of Available Positions</label>
      <input type="text" name="availableSlot" value="{{ old('availableSlot') }}" class="form-control {{$errors->has('availableSlot') ? 'is-invalid' : ''}}" placeholder="Related Major">
      @if($errors->has('availableSlot'))
        <div class="invalid-feedback">{{ $errors->first('availableSlot') }}</div>
      @endif
      <!-- <select name="availableSlot" class="form-control {{$errors->has('availableSlot') ? 'is-invalid' : ''}}">
        <option value="" disabled selected>Select number of available positions</option>
        @foreach (range(3,8) as $opt)
          <option value="{{$opt}}">{{$opt}}</option>
        @endforeach
    	</select>
      @if($errors->has('availableSlot'))
        <div class="invalid-feedback">{{ $errors->first('availableSlot') }}</div>
      @endif -->
    </div>
    <input type="submit" value="Confirm" class="btn btn-primary btn-user btn-block">
  </form>
@endsection