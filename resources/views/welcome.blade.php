<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Website</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>window.Laravel = { csrfToken: '{{ csrf_token() }}' }</script>
    <link rel="stylesheet" href="{{ asset('css/app.css')}}">
</head>
<body>
    <div id="app" class="container">
        <form method="post" action="addcar/new" enctype="multipart/form-data">

            {{ csrf_field() }}

            <carform></carform>

        </form>
    </div>
    <script src="{{ asset('js/app.js')}}"></script>

</body>
</html>