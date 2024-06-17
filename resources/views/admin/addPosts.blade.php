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


    <title>addPost</title>
</head>
<body>
    <h2 class="display-5 text-center fw-bold">Post an update</h2>

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
    <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
    @csrf

      <div class="row g-3 mx-auto p-2">
        <div class="col mx-auto p-2">
          <input type="text" class="form-control" placeholder="Title" aria-label="Title" name="title">
        </div>
      </div>
      
      <div class="form-floating">
        <textarea class="form-control mx-auto p-2" placeholder="New post" id="body" name="body" style="height: 100px"></textarea>
        <label for="body">New post</label>
      </div>
          <div class="d-grid gap-2 col-6 mx-auto mt-5">
            <button class="btn btn-primary" type="submit">CREATE POST</button>
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