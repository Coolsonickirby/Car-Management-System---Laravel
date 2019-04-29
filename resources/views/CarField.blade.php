@extends('layouts.app')
@extends('adminlte::page')
@section('title', 'Cars')

@section('content')
<body>
    <div id="app" class="container">
        <form method="post" action="addcar/new" enctype="multipart/form-data">

            {{ csrf_field() }}

            <carform></carform>

        </form>
    </div>
    <script src="{{ asset('js/app.js')}}"></script>
</body>
@endsection