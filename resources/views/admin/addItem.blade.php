<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>

    <title>AddItems</title>
</head>

<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h3 class="display-5 text-center fw-bold">Add new items</h3>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('item.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="row g-3">
                    <div class="col">
                        <label for="itemName" class="form-label">Item Name</label>
                        <input type="text" class="form-control" id="itemName" placeholder="Enter item name"
                            name="itemName">
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="text" class="form-control" id="quantity" placeholder="Enter quantity"
                            name="quantity">
                    </div>
                    <div class="col">
                        <label for="model" class="form-label">Model</label>
                        <input type="text" class="form-control" id="model" placeholder="Enter model"
                            name="model">
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="px-2 text-center">
                            <label for="image" class="form-label">Upload Image:</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*">
                        </div>
                    </div>
                </div>

                <div class="d-grid gap-2 col-6 mx-auto mt-4">
                    <button class="btn btn-primary" type="submit">ADD ITEM</button>
                </div>
            </form>

            @if ($errors->any())
                <div class="alert alert-danger mt-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
</div>

</body>

</html>
