@extends('layout')

@section('content')
<div class="hometop container-fluid" style="height: 100vh;  background-image: url({{ asset('images/sas.jpg') }});
            background-size: cover;
            background-position: center;
            position: relative;color: rgb(240, 216, 79);">
    <div class="homeleft">
        <p class="fs-1">WELCOME</p>
        <p class="fs-3">Greetings, workshop enthusiast! Your dashboard awaits – a hub for managing
            borrowed items,
            exploring available tools, and staying informed with the latest updates. Enjoy your time in the
            workshop!</p>

    </div>
</div>
@endsection
