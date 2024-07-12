<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Items</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Items</h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="mb-3 text-center">
            <a href="{{ route('items.addQuantityForm') }}" class="btn btn-primary">Add Quantity to Item</a>
        </div>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Name</th>
                    <th>Barcode</th>
                    <th>Model</th>
                    <th>Quantity</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->barcode }}</td>
                        <td>{{ $item->model }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td><img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->name }}" class="img-fluid" width="100"></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
