<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scanner Home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>

<div class="container-fluid bg-light mt-5" style="height: 100vh;">
    <div class="container col-md-6 offset-md-3">
        <h4 class="text-center mb-4">Scan to Manage Inventories</h4>
        <div class="d-grid gap-3">
            <a href="{{ route('items.index') }}" class="btn btn-primary btn-lg btn-block">View Items</a>
            {{-- <a href="{{ route('items.create') }}" class="btn btn-primary btn-lg btn-block">Add New Item</a> --}}
            <a href="{{ route('items.addQuantityForm') }}" class="btn btn-primary btn-lg btn-block">Add Quantity to Item</a>
            <a href="{{ route('borrowings.create') }}" class="btn btn-primary btn-lg btn-block">Borrow Item</a>
            <a href="{{ route('borrowings.returnForm') }}" class="btn btn-primary btn-lg btn-block">Return Item</a>
            <a href="{{ route('borrowings.index') }}" class="btn btn-primary btn-lg btn-block">View Borrowing Records</a>
        </div>
    </div>
</div>

</body>
</html>
