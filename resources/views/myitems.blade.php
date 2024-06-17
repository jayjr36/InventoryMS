@extends('layout')

@section('content')
<div class="container-fluid" style="height: 100vh">
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>

</div>
@endsection