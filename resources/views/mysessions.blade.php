@extends('layout')

@section('content')
    <div class="container-fluid" style="height: 100vh">
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
@endsection
