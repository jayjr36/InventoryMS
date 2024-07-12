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
                <div class="form-group row mb-3">
                    <label for="itemName" class="col-sm-2 col-form-label">Item Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="itemName" placeholder="Enter item name" name="itemName" value="{{ old('itemName') }}">
                    </div>
                </div>
                
                <div class="form-group row mb-3">
                    <label for="quantity" class="col-sm-2 col-form-label">Quantity</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="quantity" placeholder="Enter quantity" name="quantity" value="{{ old('quantity') }}">
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="model" class="col-sm-2 col-form-label">Model</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="model" placeholder="Enter model" name="model" value="{{ old('model') }}">
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="image" class="col-sm-2 col-form-label">Upload Image</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control-file" id="image" name="image" accept="image/*">
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="barcode" class="col-sm-2 col-form-label">Barcode</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="barcode" placeholder="Enter barcode" name="barcode" value="{{ old('barcode') }}">
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">ADD ITEM</button>
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
