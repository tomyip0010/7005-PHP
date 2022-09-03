@extends('layouts.master')

@section('title')
  Student Apply
@endsection

@section('content')
  @if($error)
    <div class="alert alert-danger" role="alert">
      {{ $error }}
    </div>
  @endif
  <form class="user needs-validation mb-4" novalidate method="post" action="{{url('project/'.request()->projectId.'/apply')}}">
    {{ csrf_field() }}
    <div class="form-group">
      <label for="firstName">First Name</label>
      <input type="text" name="firstName" class="form-control" placeholder="First Name" required minlength="3" pattern="[A-Za-z\s]+">
      <div class="invalid-feedback"></div>
    </div>
    <div class="form-group">
      <label for="lastName">Last Name</label>
      <input type="text" name="lastName" class="form-control" placeholder="Last Name" required minlength="3" pattern="[A-Za-z\s]+">
      <div class="invalid-feedback"></div>
    </div>
    <div class="form-group">
      <label for="justification">Justification</label>
      <textarea name="justification" rows="6" class="form-control" placeholder="Justification" required></textarea>
      <div class="invalid-feedback"></div>
    </div>
    <div class="form-group">
      <label for="priority">Priority</label>
      <select name="priority" class="form-control">
        @foreach (range(1,3) as $opt)
          <option value="{{$opt}}">{{$opt}}</option>
        @endforeach
    	</select>
    </div>
    <input type="submit" value="Apply" class="btn btn-primary btn-user btn-block">
  </form>
@endsection

@section('scripts')
  <script src="{{asset('js/form.js')}}"></script>
@endsection