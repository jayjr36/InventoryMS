@extends('layout')

@section('content')
<div class="container-fluid" style="height: 100vh">
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>

</div>

@endsection