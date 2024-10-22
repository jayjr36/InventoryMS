<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Users</title>
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
  <table class="table">
      <thead>
          <tr>
              <th scope="col">UserID</th>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Role ID</th>
              <th scope="col">Action</th>
          </tr>
      </thead>
      <tbody>
          @foreach ($users as $user)
          <tr>
              <th scope="row">{{ $user->id }}</th>
              <td>{{ $user->name }}</td>
              <td>{{ $user->email }}</td>
              <td>{{ $user->role_id }}</td>
              <td>
                  <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm">Edit</a>
                  <form id="deleteForm{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}" method="post" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $user->id }}')">Delete</button>
                </form>
                
                <script>
                    function confirmDelete(userId) {
                        if (confirm('Are you sure you want to delete this user?')) {
                            document.getElementById('deleteForm' + userId).submit();
                        }
                    }
                </script>
                
              </td>
          </tr>
          @endforeach
      </tbody>
  </table>
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