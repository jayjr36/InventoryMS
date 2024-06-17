@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>All Messages</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Message</th>
                    <th>User Name</th>
                    <th>User Email</th>
                    <th>Timestamp</th>
                </tr>
            </thead>
            <tbody>
                @foreach($messages as $message)
                    <tr>
                        <td>{{ $message->id }}</td>
                        <td>{{ $message->message }}</td>
                        <td>{{ $message->user_name }}</td>
                        <td>{{ $message->user_email }}</td>
                        <td>{{ $message->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
    </div>
    
    @endsection
