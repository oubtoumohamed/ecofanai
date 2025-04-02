@extends('layouts.app')

@section('content')

<div class="container">
  <form class="card" method="POST" enctype="multipart/form-data" action="@if($object->id){{ route('user_update',$object->id) }}@else{{ route('user_store') }}@endif">
    {{ csrf_field() }}
    <div class="card-header">
      <h3 class="card-title">
        @if($object->id)
          {{ __('user.user_edit') }}
        @else
          {{ __('user.user_create') }}
        @endif
      </h3>
    </div>
    <div class="card-body">
      <div class="row">

        <div class="col-md-6 mb-3">
          <div class="form-group">
            <label class="form-label">{{ __('user.firstname') }}</label>
            <input class="form-control form-control-solid" id="firstname" name="firstname" value="@if($object->id){{ $object->firstname }}@else{{ old('firstname') }}@endif" type="text" required="">
          </div>
        </div>

        <div class="col-md-6 mb-3">
          <div class="form-group">
            <label class="form-label">{{ __('user.lastename') }}</label>
            <input class="form-control form-control-solid" id="lastename" name="lastename" value="@if($object->id){{ $object->lastename }}@else{{ old('lastename') }}@endif" type="text" required="">
          </div>
        </div>
        <div class="col-md-6 mb-3">
          <div class="form-group">
            <label class="form-label">{{ __('user.username') }}</label>
            <input class="form-control form-control-solid" id="username" name="username" value="@if($object->id){{ $object->username }}@else{{ old('username') }}@endif" type="text">
          </div>
        </div>
        <div class="col-md-6 mb-3">
          <div class="form-group">
            <label class="form-label">{{ __('user.email') }}</label>
            <input class="form-control form-control-solid" id="email" name="email" value="@if($object->id){{ $object->email }}@else{{ old('email') }}@endif" type="email" required="">
          </div>
        </div>
        <div class="col-md-6 mb-3">
          <div class="form-group">
            <label class="form-label">{{ __('user.password') }}</label>
            <input class="form-control form-control-solid" id="password" name="password" type="password" value="">
          </div>
        </div>
        <div class="col-md-6 mb-3">
          <div class="form-group">
            <label class="form-label">{{ __('user.phone') }}</label>
            <input class="form-control form-control-solid" id="phone" value="@if($object->id){{ $object->phone }}@else{{ old('phone') }}@endif" name="phone" type="text">
          </div>
        </div>
        <div class="col-md-6 mb-3">
          <div class="form-group">
            <label class="form-label">{{ __('user.cin') }}</label>
            <input class="form-control form-control-solid" id="cin" value="@if($object->id){{ $object->cin }}@else{{ old('cin') }}@endif" name="cin" type="text">
          </div>
        </div>
        <div class="col-md-6 mb-3">
          <div class="form-group">
            <label class="form-label">{{ __('user.avatar') }}</label>
            <div class="d-flex">
              @if($object->id){!! $object->getavatar("sm") !!}@endif
              <input class="form-control form-control-solid" id="avatar" name="avatar" type="file">
            </div>
          </div>
        </div>
        
        <div class="col-md-6 mb-3">
          <div class="form-group">
            <label class="form-label">{{ __('user.role') }}</label>
            @if($object->id)
              <input class="form-control form-control-solid" value="{{ $object->role }}" type="text" readonly="" disabled="">
            @else
            <select id="role" name="role" class="form-control form-control-solid select_with_filter">
              <option value="EMPLOYE" @if($object->id && $object->getrole() == "EMPLOYE" ) selected="selected" @endif >EMPLOYE</option>
              <option value="VENDOR" @if($object->id && $object->getrole() == "VENDOR" ) selected="selected" @endif >VENDEUR</option>
              <option value="ADMIN" @if($object->id && $object->getrole() == "ADMIN" ) selected="selected" @endif >ADMIN</option>
            </select>
            @endif
          </div>
        </div>
        <div class="col-md-6 mb-3">
          <div class="form-group">
            <label class="form-label">{{ __('user.groupes') }}</label>

            <select id="groupe" name="groupe[]" multiple="multiple" class="form-control form-control-solid">
            @php 
              $usergroupes = [];

              if($object and $object->groupes){
                foreach ($object->groupes as $ug) {
                  $usergroupes[$ug->id] = $ug->id;
                }
              }
            @endphp
            @foreach($groupes as $groupe)
              @php 
                if(in_array($groupe->id, $usergroupes))
                  $check_ = 'selected="selected"';
                else
                  $check_ = '';
              @endphp
              <option {{ $check_ }} value="{{$groupe->id}}">{{$groupe->name}}</option>
            @endforeach
            </select>
          </div>
        </div>


      </div>
    </div>
    <div class="card-footer text-right">
      {!! update_actions($object) !!}
    </div>
  </form>

</div>
@endsection

@section('js')
<script>
  $(document).ready(function(){
    $("select#groupe").selectize();
  });
</script>
@endsection