@extends('adminlte::page')
@section('title', 'Cars')
@section('content')
<body>
    <div id="app" class="container">
    <form method="post" action="/admin/cars/add/new" enctype="multipart/form-data">

            {{ csrf_field() }}
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Car Form</h3>
                </div>
                <div class="box-body">
                    <carform></carform>
                </div>
            </div>
    </form>
    </div>
    <script src="{{ asset('js/app.js')}}"></script>
</body>
@endsection