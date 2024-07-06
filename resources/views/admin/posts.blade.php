<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Posts</title>
</head>
<body>
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
  <div class="container mt-5">
    <div class="col">
      @foreach ($posts as $post)
      <div class="col-9 mb-4">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-secondary text-white">
                <h5 class="card-title font-weight-bold">{{ $post->title }}</h5>
            </div>
            <div class="card-body">
                <p class="card-text">{{ $post->body }}</p>
            </div>
            <div class="card-footer">
                <div class="row align-items-center">
                    <div class="col-sm-6 mb-2 mb-sm-0">
                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary btn-sm btn-block">Edit</a>
                    </div>
                    <div class="col-sm-6">
                        <form id="deleteForm{{ $post->id }}" action="{{ route('posts.destroy', $post->id) }}" method="post" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger btn-sm btn-block" onclick="confirmDelete('{{ $post->id }}')">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- JavaScript Function for Confirmation -->
    <script>
        function confirmDelete(postId) {
            if (confirm('Are you sure you want to delete this post?')) {
                document.getElementById('deleteForm' + postId).submit();
            }
        }
    </script>
    
      @endforeach
    </div>
  </div>


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