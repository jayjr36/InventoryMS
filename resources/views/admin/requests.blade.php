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

    <title>Requests</title>
</head>

<body>
    <section id="requests">
        <script>
            function displayRequests() {
                $.ajax({
                    url: '/fetch-requests',
                    method: 'GET',
                    success: function(response) {
                        $('#requests').html(response.html);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching requests:', error);
                    }
                });
            }

            $(document).ready(function() {
                displayRequests();

                $(document).on('click', '.approve-btn', function() {
                    var itemId = $(this).data('item-id');
                   // var itemQuantity = $(this).data('item-id');
                    updateStatus(itemId, 'approve');
                });

                $(document).on('click', '.comment-btn', function() {
                    var itemId = $(this).data('item-id');
                    updateStatus(itemId, 'comment');
                });

                $(document).on('click', '.clear-btn', function() {
                    var itemId = $(this).data('item-id');
                    updateStatus(itemId, 'clear');
                });

                function updateStatus(itemId, action) {
                    var token = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url: '/update-status',
                        type: 'POST',
                        data: {
                            item_id: itemId,
                            action: action
                        },
                        headers: {
                            'X-CSRF-TOKEN': token
                        },
                        success: function(response) {
                            if (response.success) {

                                console.log('Status updated successfully');

                                displayRequests();
                            } else {
                                console.error('Error updating status');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error updating status: ' + error);
                        }
                    });
                }
            });
        </script>
    </section>
</body>

</html>
