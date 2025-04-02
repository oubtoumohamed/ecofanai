@extends('layouts.app')

@section('content')
    <div class="row">
        <h3>History</h3>

        <ul class="list-group mt-3">
            @foreach( $actions as $action )
            <li class="list-group-item">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <div class="d-flex">
                            <div class="flex-shrink-0 avatar-xs">
                                <div class="avatar-title bg-info rounded">
                                    <i class="ri-medal-fill"></i>
                                </div>
                            </div>
                            <div class="flex-shrink-0 ms-2">
                                <h6 class="fs-14 mb-0">{{ $action->code }}</h6>
                                <small class="text-muted">{{ formatInterval($action->created_at) }}</small>
                            </div>
                        </div>
                    </div>
                    <div class="flex-shrink-0">
                        <span class="text-success">+{{ $action->note }} points</span>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
@endsection