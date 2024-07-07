///////////////////pending 
@extends('layouts.app')

@section('content')
    <h2 class="display-5 text-center fw-bold">Pending Requests</h2>

    @foreach ($pendingItems as $item)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $item->name }}</h5>
                <p class="card-text">Quantity: {{ $item->quantity }}</p>
                <p class="card-text">Status: {{ $item->status }}</p>
                
                <div class="btn-group" role="group">
                    <button class="btn btn-primary btn-sm approve-btn" data-item-id="{{ $item->id }}">Approve</button>
                    <button class="btn btn-danger btn-sm reject-btn" data-item-id="{{ $item->id }}">Reject</button>
                </div>
            </div>
        </div>
    @endforeach
@endsection



///////////////////////////////approved
@extends('layouts.app')

@section('content')
    <h2 class="display-5 text-center fw-bold">Approved Requests</h2>

    @foreach ($approvedItems as $item)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $item->name }}</h5>
                <p class="card-text">Quantity: {{ $item->quantity }}</p>
                <p class="card-text">Status: {{ $item->status }}</p>
                
                <button class="btn btn-success btn-sm">Cleared</button>
            </div>
        </div>
    @endforeach
@endsection


/////////////////////rejected

@extends('layouts.app')

@section('content')
    <h2 class="display-5 text-center fw-bold">Rejected Requests</h2>

    @foreach ($rejectedItems as $item)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $item->name }}</h5>
                <p class="card-text">Quantity: {{ $item->quantity }}</p>
                <p class="card-text">Status: {{ $item->status }}</p>
            </div>
        </div>
    @endforeach
@endsection
