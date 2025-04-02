@extends('layouts.app')

@section('content')
  {!! 
    main_list([
      'title'=>true,
      'data'=>$results,
      'module'=>'groupe',
      'fields'=>[
        'name'=>[
          'type'=>'text',
        ],
      ],
    ]);

  !!}
@endsection