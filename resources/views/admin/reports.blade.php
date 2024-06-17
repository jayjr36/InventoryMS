@extends('layouts.app')

@section('content')

    <center>
        <h3>Select the report you need to generate using buttons below</h3>
   
        <div class="d-grid gap-2 d-md-block">
        <button onclick="window.open('{{ route('usersList') }}', '_blank')" type="button" class="btn btn-info">All Users</button>
        <button onclick="window.open('{{ route('itemsList') }}', '_blank')" type="button" class="btn btn-info">All Inventories</button>
        <button onclick="window.open('{{ route('debtsList') }}', '_blank')" type="button" class="btn btn-info">Borrowed Items</button>
        <button onclick="window.open('{{ route('pendingRequest') }}', '_blank')" type="button" class="btn btn-info">Item Requests</button>
        <button onclick="window.open('{{ route('clearedDebts') }}', '_blank')" type="button" class="btn btn-info">Debts Cleared</button>
        
           </div>
    </center>
@endsection