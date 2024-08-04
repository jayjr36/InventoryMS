<!-- resources/views/borrowings/index.blade.php -->

@extends('layout')

@section('content')
    <div class="container">
        <h2 class="display-5 text-center fw-bold">Borrowing History</h2>
        @if($borrowingRecords->isEmpty())
            <p class="text-center">No borrowing records found.</p>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>Item Name</th>
                            <th>Quantity</th>
                            <th>Borrowed At</th>
                            <th>Returned At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($borrowingRecords as $record)
                            <tr>
                                <td>{{ $record->item->name }}</td>
                                <td>{{ $record->quantity }}</td>
                                <td>{{ $record->borrowed_at }}</td>
                                <td>{{ $record->returned_at ?? 'Not yet returned' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
