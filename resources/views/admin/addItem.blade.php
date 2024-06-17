<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>

    <title>AddItems</title>
</head>
<body>
    <h2 class="display-5 text-center fw-bold">Add new items</h2>
    
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<!-- Display error message if it exists -->
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
    <form action="{{ route('item.store') }}" method="post" enctype="multipart/form-data">
    @csrf

      <div class="row g-3 mx-auto p-2">
        <div class="col mx-auto p-2">
          <input type="text" class="form-control" placeholder="Item Name" aria-label="Item name" name="itemName">
        </div>
      </div>
    
      <div class="row g-3 mx-auto p-2">
        <div class="col mx-auto p-2">
          <input type="text" class="form-control" placeholder="Quantity" aria-label="Quantity" name="quantity">
        </div>
        <div class="col mx-auto p-2">
          <input type="text" class="form-control" placeholder="Model" aria-label="Model" name="model">
        </div>
      </div>
    
      <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="px-2 text-center">
                    <label for="image">Upload Image:</label>
                    <input type="file" class="form-control" name="image" id="image" accept="image/*" />
                </div>
            </div>
        </div>
    </div>
      
    </div>
          <div class="d-grid gap-2 col-6 mx-auto mt-5">
            <button class="btn btn-primary" type="submit">ADD ITEM</button>
          </div>
       </form> 

       @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

</body>
</html>