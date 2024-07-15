<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

{{--     
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> --}}


    <title>Admin panel</title>

    <style>
        .topcontainer{
            width: 100%;
            display: flex;
        }

        .leftcontainer{
            width: 30%
        }
        .rightcontainer{
            width: 65%
        }
    </style>
</head>
<body>

<div class="container-fluid">

    <h1 class="display-1 text-center fw-bold">DASHBOARD</h1>
  </div>
<div class="topcontainer">
<div class="leftcontaineer">`
    <div class="d-grid gap-2">

        @if (Auth::user()->role_id == 1)
        <button class="btn btn-primary" type="button" onclick="loadContent('{{ route('item.create') }}')">Add Inventories</button>
        <button class="btn btn-primary" type="button" onclick="loadContent('{{ route('session.create') }}')">Add sessions</button>
        <button class="btn btn-primary" type="button" onclick="loadContent('{{ route('scanner-home') }}')">Scanner</button>
        
        @endif
        <button class="btn btn-primary" type="button" onclick="loadContent('{{ route('admin-sessions') }}')">All sessions</button>
        @if (Auth::user()->role_id == 1)
        <button class="btn btn-primary" type="button" onclick="loadContent('{{ route('requests.index') }}')">Item Requests</button>
{{-- 
        <div class="btn-group">
            <button class="btn btn-primary" >
                Approve Requests
            </button> --}}
            {{-- <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#" onclick="loadContent('{{ route('requests.index') }}')">Pending Requests</a></li>
                <li><a class="dropdown-item" href="#" onclick="loadContent('{{ route('approved-items') }}')">Approved Requests</a></li>
                <li><a class="dropdown-item" href="#" onclick="loadContent('{{ route('rejected-items') }}')">Rejected Requests</a></li>
            </ul> --}}
        {{-- </div>
         --}}
        @endif
        {{-- <a class="dropdown-item" href="#" onclick="loadContent('{{ route('requests.index') }}')">Pending Requests</a>
        <a class="dropdown-item" href="#" onclick="loadContent('{{ route('approved-items') }}')">Approved Requests</a>
        <a class="dropdown-item" href="#" onclick="loadContent('{{ route('rejected-items') }}')">Rejected Requests</a> --}}

        <button class="btn btn-primary" type="button" onclick="loadContent('{{ route('post.create') }}')">Post updates</button>
        <button class="btn btn-primary" type="button" onclick="loadContent('{{ route('posts.index') }}')">Manage Posts</button>
        <button class="btn btn-primary" type="button" onclick="loadContent('{{ route('users.index') }}')">Manage users</button>
        <button class="btn btn-primary" type="button" onclick="loadContent('{{ route('items.index') }}')">Manage Inventories</button>
        <button class="btn btn-primary" type="button" onclick="loadContent('{{ route('messages') }}')">Messages</button>
        <button class="btn btn-primary" type="button" onclick="loadContent('{{ route('reportsPage') }}')" >Report generation</button>
       
        <button class="btn btn-primary" type="button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
        </button>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>    
    </div>
</div>    

<div class="rightcontainer">
    <div id="welcomeMessage">
        <h2 class="display-5 text-center fw-bold">Manage all inventories in the <br>workshop easily.</h2>
        <p class="text-center">Navigate buttons on the left to get started.</p>
    </div>  
    <iframe id="contentIframe" frameborder="10" width="110%" height="120%">
    </iframe>
</div>

<script>
    function loadContent(route) {
        document.getElementById('welcomeMessage').style.display = 'none';
      
        document.getElementById('contentIframe').src = route;
    }
</script>
 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
 <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>