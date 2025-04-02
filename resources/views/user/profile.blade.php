@extends('layouts.app')

@section('content')

<div class="container">
  <form class="card" method="POST" enctype="multipart/form-data" action="{{ route('user_update_profile') }}">
    {{ csrf_field() }}
    <div class="card-header">
      <h3 class="card-title">
        {{ __('auth.profile') }}
      </h3>
    </div>
    <div class="card-body">
      <div class="row">

        <div class="col-md-6 mb-10">
          <div class="form-group">
            <label class="form-label">{{ __('user.firstname') }}</label>
            <input class="form-control form-control-solid" id="firstname" name="firstname" value="{{ $object->firstname }}" type="text" required="">
          </div>
        </div>

        <div class="col-md-6 mb-10">
          <div class="form-group">
            <label class="form-label">{{ __('user.lastename') }}</label>
            <input class="form-control form-control-solid" id="lastename" name="lastename" value="{{ $object->lastename }}" type="text" required="">
          </div>
        </div>
        <div class="col-md-6 mb-10">
          <div class="form-group">
            <label class="form-label">{{ __('user.email') }}</label>
            <input class="form-control form-control-solid" id="email" name="email" value="{{ $object->email }}" type="email" required="">
          </div>
        </div>
        <div class="col-md-6 mb-10">
          <div class="form-group">
            <label class="form-label">{{ __('user.password') }}</label>
            <input class="form-control form-control-solid" id="password" name="password" type="password" value="">
          </div>
        </div>
        <div class="col-md-6 mb-10">
          <div class="form-group">
            <label class="form-label">{{ __('user.phone') }}</label>
            <input class="form-control form-control-solid" id="phone" value="{{ $object->phone }}" name="phone" type="text">
          </div>
        </div>
        <div class="col-md-6 mb-10">
          <div class="form-group">
            <label class="form-label">{{ __('user.cin') }}</label>
            <input class="form-control form-control-solid" id="cin" value="@if($object->id){{ $object->cin }}@else{{ old('cin') }}@endif" name="cin" type="text">
          </div>
        </div>
        <div class="col-md-6 mb-10">
          <div class="form-group">
            <label class="form-label">{{ __('user.avatar') }}</label>
            <div class="d-flex">
              @if($object->id){!! $object->getavatar() !!}@endif
              <input class="form-control form-control-solid" id="avatar" name="avatar" type="file">
            </div>
          </div>
        </div>

      </div>
    </div>
    <div class="card-footer text-right">
      <button type="submit" id="save_btn" class="btn btn-success"> <i class="fa fa-check"></i>&nbsp; {{ __('global.submit') }}</button>
    </div>
  </form>

</div>
@endsection