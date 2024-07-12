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

    <title>AddSession</title>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h2 class="display-5 text-center fw-bold">Add Session</h2>
    
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
    
                <form action="{{ route('session.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
    
                    <div class="mb-3">
                        <label for="sessionDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="sessionDescription" name="sessionDescription" rows="2" placeholder="Enter session description"></textarea>
                    </div>
    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="className" class="form-label">Class</label>
                            <input type="text" class="form-control" id="className" name="className" placeholder="Enter class name">
                        </div>
                        <div class="col-md-6">
                            <label for="sessionDate" class="form-label">Date</label>
                            <input type="date" class="form-control" id="sessionDate" name="sessionDate">
                        </div>
                                          </div>
    
                    <div class="row g-3 mt-3">
                        <div class="col-md-6">
                            <label for="sessionTime" class="form-label">Start Time</label>
                            <input type="time" class="form-control" id="sessionTime" name="sessionTime">
                        </div>

                        <div class="col-md-6">
                            <label for="endtime" class="form-label">End Time</label>
                            <input type="time" class="form-control" id="endtime" name="endtime">
                        </div>
                    </div>
    
                    <div class="d-grid gap-2 col-6 mx-auto mt-4">
                        <button class="btn btn-primary" type="submit">ADD SESSION</button>
                    </div>
                </form>
            </div>
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
