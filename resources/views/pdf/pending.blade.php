<!DOCTYPE html>
<html>
<head>
    <title>Inventories</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1 class="display-5 text-center fw-bold">Pending Requests</h1>
    <table>
        <thead>
            <tr>
                <th>ItemID</th>
                <th>Item</th>
                <th>Model</th>
                <th>Quantity</th>
                <th>UserID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Date</th>
                <!-- Add more columns as needed -->
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr>
                <td>{{ $item->item_id }}</td>
                <td>{{ $item->item_name }}</td>
                <td>{{ $item->item_model }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->user_id }}</td>
                <td>{{ $item->user_name }}</td>
                <td>{{ $item->user_email }}</td>
                <td>{{ $item->created_at }}</td>
                
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
