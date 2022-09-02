@extends('layouts.master')

@section('title')
  Student Apply
@endsection

@section('content')
  <form class="user" method="post" action="{{url('project/'.request()->projectId.'/apply')}}">
    {{ csrf_field() }}
    <div class="form-group">
      <input type="text" name="firstName" class="form-control" placeholder="First Name">
    </div>
    <div class="form-group">
      <input type="text" name="lastName" class="form-control" placeholder="Last Name">
    </div>
    <div class="form-group">
      <textarea name="justification" rows="6" class="form-control" placeholder="Justification"></textarea>
    </div>
    <div class="form-group">
      <select name="priority" class="form-control">
        <option value="" disabled selected>Select Priority</option>
        @foreach (range(1,3) as $opt)
          <option value="{{$opt}}">{{$opt}}</option>
        @endforeach
    	</select>
    </div>
    <input type="submit" value="Apply" class="btn btn-primary btn-user btn-block">
  </form>
@endsection