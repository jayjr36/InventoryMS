<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Inventory Management System</title>
    <style>
        body {
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
            padding-top: 50px;
            height: 500px;
        }

        #my-items {
            padding-top: 50px;
            padding-bottom: 200px;

        }

        #sessions {
            padding-top: 50px;
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

    <div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <a class="navbar-brand" href="#">Inventory Management System</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse navbar-right" id="navbarNav">
                <ul class="navbar-nav navbar-right">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route('userhome')}}" target="iframe">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('items.index') }}" target="iframe">Inventory</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('useritems')}}" target="iframe">My Items</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('usersessions')}}" target="iframe">Sessions</a>
                    </li>
                   <li class="nav-item">
                        <a class="nav-link" href="{{route('userannouncement')}}" target="iframe">Announcements</a>
                    </li>
                    <li>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf

                        </form>


                        <button onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </button>

                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <div class="container-fluid" style="height: 100vh;">
        <iframe name="iframe" src="{{route('userhome')}}" frameborder="0" style="width: 100%; height: 100vh;"></iframe>
    </div>
    <!-- Page Content -->
    {{-- <div class="container-fluid">
        <!-- Home Section -->
        <section id="home">
            <div class="hometop">
                <div class="homeleft">
                    <p class="fs-1">WELCOME</p>
                    <p class="fs-3">Greetings, workshop enthusiast! Your dashboard awaits – a hub for managing
                        borrowed items,
                        exploring available tools, and staying informed with the latest updates. Enjoy your time in the
                        workshop!</p>

                </div>


            </div>

            <!-- Add your home content here -->
        </section>
       
        <div id="my-items-container">
            <section id="my-items">
                <script>
                    function displayCartItems() {
                        $.ajax({
                            url: '/fetch-cart-items',
                            method: 'GET',
                            success: function(response) {
                                $('#my-items').html(response.html);
                            },
                            error: function(xhr, status, error) {
                                console.error('Error fetching cart items:', error);
                            }
                        });
                    }
        
                    $(document).ready(function() {
                        displayCartItems();
                    });
                </script>
            </section>
        </div>
        
        <div id="sessions-container">
            <!-- Button to trigger modal -->
<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#messageModal">Request Session</button>

<!-- Modal -->
<div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="messageModalLabel">Message Admin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="messageForm">
                    <div class="mb-3">
                        <label for="messageText" class="form-label">Message:</label>
                        <textarea class="form-control" id="messageText" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
      $(document).ready(function() {
                displaySession();

                $('#messageForm').submit(function(event) {
                    event.preventDefault();
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
        
                    var message = $('#messageText').val();
                    var userId = <?php echo Auth::id(); ?>;
                    var userName = '<?php echo Auth::user()->name; ?>';
                    var userEmail = '<?php echo Auth::user()->email; ?>';
                    
                    $.ajax({
                        url: '/send-message-to-admin',
                        method: 'POST',
                        data: {
                            _token: csrfToken,
                            message: message,
                            userId: userId,
                            userName: userName,
                            userEmail: userEmail
                        },
                        success: function(response) {
                            // Handle success response
                            $('#messageModal').modal('hide');
                            // Optionally, update UI to reflect the message sent
                        },
                        error: function(xhr, status, error) {
                            console.error('Error sending message to admin:', error);
                            // Optionally, display an error message to the user
                        }
                    });
                });
            });
</script>
            
            <section id='sessions'>
                <script>
                    function displaySession() {
                        $.ajax({
                            url: '/fetch-sessions',
                            method: 'GET',
                            success: function(response) {
                                $('#sessions').html(response.html);
                            },
                            error: function(xhr, status, error) {
                                console.error('Error fetching sessions timetable:', error);
                            }
                        });
                    }
                    $(document).ready(function() {
                        displaySession();
                    });
                </script>
            </section>
        </div>
        
        

    <section id="announcements">
    
        <section id="announcement">
            <script>
                function displayAnnouncements() {
                    $.ajax({
                        url: '/fetch-announcements',
                        method: 'GET',
                        success: function(response) {
                            
                            $('#announcement').html(response.html);
                        },
                        error: function(xhr, status, error) {
                            console.error('Error fetching announcements:', error);
                        }
                    });
                }
                $(document).ready(function() {
                    displayAnnouncements();
                });
            </script>

        </section>
    </section>
    </div>
 --}}
    <!-- Include Bootstrap JS and any additional JS scripts if needed -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>

</body>

</html>
