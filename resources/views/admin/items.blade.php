<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Inventories</title>
</head>

<body>
    <h1 class="display-5 text-center fw-bold">Inventory List</h1>
    <div class="container mt-5">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Display error message if it exists -->
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Name</th>
                    <th scope="col">Image</th>
                    <th scope="col">Model</th>
                    <th scope="col">Available</th>
                    <th scope="col">Action</th>
                    @if (Auth::user()->role_id != 1)
                        <th scope="col">Checkbox</th>
                        <th scope="col">Quantity</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $index => $item)
                    <tr>
                        <th scope="row">{{ $index + 1 }}</th>
                        <td>{{ $item->name }}</td>
                        <td><img src="{{ asset($item->image_path) }}" alt="Item Image"></td>

                        <td>{{ $item->model }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>

                            <a href="{{ route('items.edit', $item->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('items.destroy', $item->id) }}" method="post"
                                style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                        @if (Auth::user()->role_id != 1)
                            <td>
                                <input type="checkbox" class="item-checkbox" data-item-id="{{ $item->id }}">
                            </td>
                            <td>
                                <input type="number" class="item-quantity" value="1" min="1">
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if (Auth::user()->role_id != 1)
            <button type="button" class="btn btn-success" id="addToCartBtn">Add to Cart</button>
        @endif
    </div>

    <!-- Modal for displaying the cart -->
    <div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="cartModalLabel"
        aria-hidden="true">
        <div class="container mt-5">


            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cartModalLabel">Selected Items</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Cart content goes here -->


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="checkoutBtn">Submit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                var selectedItems = [];

                $('.item-checkbox').change(function() {
                    var itemId = $(this).data('item-id');
                    var itemName = $(this).closest('tr').find('td:eq(0)').text();
                    var itemModel = $(this).closest('tr').find('td:eq(3)').text();
                    var itemQuantity = $(this).closest('tr').find('.item-quantity').val();

                    if ($(this).prop('checked')) {
                        selectedItems.push({
                            id: itemId,
                            name: itemName,
                            model: itemModel,
                            quantity: itemQuantity
                        });
                    } else {
                        selectedItems = selectedItems.filter(item => item.id !== itemId);
                    }
                });

                $('#addToCartBtn').click(function() {
                    console.log('Selected Items:', selectedItems);

                    $('#cartModal .modal-body').empty();

                    if (selectedItems.length > 0) {
                        var cartContent = '<ul>';
                        selectedItems.forEach(function(item) {
                            cartContent += '<li>';
                            cartContent += 'Item Name: ' + item.name + '<br>';
                            cartContent += 'Item Model: ' + item.model + '<br>';
                            cartContent += 'Quantity: ' + item.quantity + '<br>';
                            cartContent += '</li>';
                        });
                        cartContent += '</ul>';
                        $('#cartModal .modal-body').html(cartContent);
                    } else {
                        $('#cartModal .modal-body').html('<p>No items selected.</p>');
                    }

                    $('#cartModal').modal('show');
                });


                $('#checkoutBtn').click(function() {
                    console.log('Selected Items for Checkout:', selectedItems);

                    $.ajax({
                        url: '/add-to-cart',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            user_id: {{ Auth::id() }},
                            items: selectedItems
                        },
                        success: function(response) {
                            $('.modal-body').empty();
                            $('.modal-body').append('Request submitted successfully');
                        },
                        error: function(xhr, status, error) {
                            console.error();
                            $('.modal-body').empty();
                            $('.modal-body').append('Error submitting request:', error);
                        }
                    });



                });
            });
        </script>


</body>

</html>
