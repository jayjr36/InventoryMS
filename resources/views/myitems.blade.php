@extends('layout')

@section('content')
    <div class="container">
        <a href="{{route('borrowings.personal')}}" class="btn btn-info">BORROWING HISTORY</a>
        <p class="display-5 text-center fw-bold">Items Requested</p>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Name</th>
                        <th>Model</th>
                        <th>Quantity</th>
                        <th>Request Status</th>
                        <th>Name</th>
                        <th>Email</th>
                        @if($user->role_id == 1)
                            <th>Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $item)
                        <tr>
                            <td>{{ $item->item_name }}</td>
                            <td>{{ $item->item_model }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->status }}</td>
                            <td>{{ $item->user_name }}</td>
                            <td>{{ $item->user_email }}</td>
                            @if($user->role_id == 1)
                                <td>
                                    <button class="btn btn-primary approve-btn" data-item-id="{{ $item->id }}">Approve</button>
                                    <button class="btn btn-secondary comment-btn" data-item-id="{{ $item->id }}">Reject</button>
                                    <button class="btn btn-success clear-btn" data-item-id="{{ $item->id }}">Cleared</button>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Event listener for approve button
            document.querySelectorAll('.approve-btn').forEach(function (button) {
                button.addEventListener('click', function () {
                    updateStatus(this.dataset.itemId, 'approve');
                });
            });

            // Event listener for comment button
            document.querySelectorAll('.comment-btn').forEach(function (button) {
                button.addEventListener('click', function () {
                    updateStatus(this.dataset.itemId, 'comment');
                });
            });

            // Event listener for clear button
            document.querySelectorAll('.clear-btn').forEach(function (button) {
                button.addEventListener('click', function () {
                    updateStatus(this.dataset.itemId, 'clear');
                });
            });

            // Function to update status via AJAX
            function updateStatus(itemId, action) {
                fetch('{{ route('updateStatus') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        item_id: itemId,
                        action: action
                    })
                }).then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Status updated successfully');
                        location.reload();
                    } else {
                        alert('Error updating status');
                    }
                }).catch(error => {
                    console.error('Error:', error);
                });
            }
        });
    </script>


{{-- @extends('layout')

@section('content')
<div class="container-fluid" style="height: 100vh">
    <section id="my-items">
        <script>
            function displayCartItems() {
                $.ajax({
                    url: '/fetch-cart-items',
                    method: 'GET',
                    success: function(response) {
                        $('#my-items').html(response.html);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching cart items:', error);
                    }
                });
            }

            $(document).ready(function() {
                displayCartItems();
            });
        </script>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>

</div>
@endsection --}}