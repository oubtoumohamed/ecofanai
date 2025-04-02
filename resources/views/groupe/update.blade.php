@extends('layouts.app')

@section('content')

  <div class="container-fluid">
    
  <form class="card" method="POST" enctype="multipart/form-data" action="@if($object->id){{ route('groupe_update',$object->id) }}@else{{ route('groupe_store') }}@endif">
    {{ csrf_field() }}
    <div class="card-header">
      <h3 class="card-title">
        @if($object->id)
          {{ __('groupe.groupe_edit') }}
        @else
          {{ __('groupe.groupe_create') }}
        @endif
      </h3>
    </div>
    <div class="card-body">
      <div class="row">
        <div class=" mb-10">
          <div class="form-group">
            <label class="form-label">{{ __('groupe.name') }}</label>
            <input class="form-control" id="name" name="name" value="@if($object->id){{ $object->name }}@else{{ old('name') }}@endif" type="text" required="">
          </div>
        </div>
        <div class="">
        <br>
          <div class="form-group">
            <!--label class="form-label">{{ __('groupe.roles') }}</label>
            <input type="text" class="form-control" id="search"/-->

            <div class="row" id="groupe_roles">
            @foreach($object->get__roles() as $k=>$role)

            <!--begin::Accordion-->
            <div class="accordion col-md-2 mt-3 mb-3">
              <div class="accordion-item">
                <div class="accordion-header" id="">
                  <button class="accordion-button fs-6 fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#kt_accordion{{ $k }}" aria-expanded="true" aria-controls="kt_accordion{{ $k }}">
                    {{ $role['name'] }}
                  </button>
                </div>
                <div id="kt_accordion{{ $k }}" class="accordion-collapse collapse show">
                  <div class="accordion-body">
                    @foreach( $role['actions'] as $av=>$anm )
                    <div class="item form-check form-check-custom form-check-solid mb-3" data-name="{{ $anm.' '.$role['name'] }}">
                      <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" value="{{ $k.'_'.$av }}" name="roles[]" class="switch role_ module_{{ $k }}" data-module="{{ $k }}" @if( strpos( $object->roles.',' , $k.'_'.$av.',' ) > -1 ) checked="checked" @endif/>
                      &nbsp;&nbsp;&nbsp;{{ $anm }}
                      </label>
                    </div>
                    @endforeach
                  </div>
                </div>
              </div>
            </div>
            <!--end::Accordion-->

            @endforeach
            </div>
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
    $("select#roles").selectize();

    $('#search').on('keyup', function(){
      if($(this).val()==""){
        $('#groupe_roles .all_check').show();
        $('#groupe_roles .accordion').show()
        $('#groupe_roles .item').show()
        return
      }else{
        $('#groupe_roles .all_check').hide();
      }

      var value = $('#search').val().toLowerCase();

      $('#groupe_roles .item').show().filter(function(){
        return $(this).data('name').toLowerCase().indexOf(value) === -1;
      })
      .hide()
      .closest('.accordion')
      .show()
      .end()
      .each(function(){
          let card = $(this).closest('.accordion');
          if(card.find('.item:visible').length === 0)
            card.hide();
      })
    });
  });
</script>
@endsection