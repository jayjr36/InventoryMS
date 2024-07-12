<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrowing Records</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Borrowing Records</h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Item</th>
                    <th>User</th>
                    <th>Quantity</th>
                    <th>Borrowed At</th>
                    <th>Returned At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($borrowings as $borrowing)
                    <tr>
                        <td>{{ $borrowing->item->name }}</td>
                        <td>{{ $borrowing->user_name }}</td>
                        <td>{{ $borrowing->quantity }}</td>
                        <td>{{ $borrowing->borrowed_at }}</td>
                        <td>{{ $borrowing->returned_at ?? 'Not Returned' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
