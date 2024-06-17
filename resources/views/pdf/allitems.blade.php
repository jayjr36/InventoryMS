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
    <h1 class="display-5 text-center fw-bold">All Inventories</h1>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Model</th>
                <th>Quantity</th>
                <!-- Add more columns as needed -->
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->model }}</td>
                <td>{{ $item->quantity }}</td>
                <!-- Add more columns as needed -->
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
