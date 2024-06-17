<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Inventory Management System') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

   <style>
        body {
            /* padding-top: 56px; */
            background-color: rgb(172, 158, 158);
        }

        #home {
            color: rgb(240, 216, 79);
            padding-top: 50px;
            height: 500px;
            background-image: url({{ asset('images/sas.jpg') }});
            background-size: cover;
            background-position: center;
            position: relative;
        }

        #home::before {
            content: "";
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background-color: rgba(0, 0, 0, 0.8);
        }





        #inventory {
            /* padding-top: 50px; */
            height: 500px;
        }

        #my-items {
            /* padding-top: 50px; */
            padding-bottom: 200px;

        }

        #sessions {
            /* padding-top: 50px; */
         padding-bottom: 200px;   
        }

        .hometop {
            width: 100%;
            display: flex;
            position: relative;
            z-index: 2;
        }

        .homeleft {
            width: 60%;
        }

        .homeright {
            background-color: red;
            width: 30%;
            float: right;
            display: grid;
            grid-template-columns: 1fr;
            height: 300px;
        }

        .chocolate-circle {
            width: 200px;
            height: 200px;
            background-color: chocolate;
            border-radius: 50%;
            overflow: hidden;
            margin: 10px;
            /* Optional spacing between images */
        }

        .homeright img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: relative;
            z-index: 2;
        }

        .section {
    margin-bottom: 20px; 
    padding: 20px; 
}


        #profile {
            /* padding-top: 50px; */
            height: 500px;
        }

        @media (min-width: 768px) {
            body {
                padding-top: 72px;
            }
        }
    </style>


</head>
<body>
    <div id="app">

       
            @yield('content')
        
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>

</body>
</html>
