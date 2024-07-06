<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>


    <title>addPost</title>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="display-5 text-center fw-bold">Post an update</h2>
    
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
    
                <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
    
                    <div class="row g-3">
                        <div class="col">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" placeholder="Enter title"
                                aria-label="Title" name="title">
                        </div>
                    </div>
    
                    <div class="form-floating mt-3">
                        <textarea class="form-control" placeholder="New post" id="body" name="body"
                            style="height: 100px"></textarea>
                        <label for="body">New post</label>
                    </div>
    
                    <div class="d-grid gap-2 col-6 mx-auto mt-4">
                        <button class="btn btn-primary" type="submit">CREATE POST</button>
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
