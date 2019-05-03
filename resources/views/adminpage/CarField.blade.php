@extends('adminlte::page')
@section('title', 'Cars')
@section('content')
<body>
    <div id="app" class="container">
    <form method="post" action="/admin/cars/add/new" enctype="multipart/form-data">

            {{ csrf_field() }}
            <div class="box box-primary">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                      <li class="active"><a href="#tab_1" data-toggle="tab">General Info</a></li>
                      <li><a href="#tab_2" data-toggle="tab">Tab 2</a></li>
                      <li><a href="#tab_3" data-toggle="tab">Tab 3</a></li>                            
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <div class="box-header with-border">
                                <h3 class="box-title">Car Form</h3>
                            </div>
                            <div class="box-body">
                                <carform></carform>
                            </div>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_2">
                            <h1>put something here owo</h1>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_3">
                            <h1><_< owo</h1>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
            </div>
    </form>
    </div>
    <script src="{{ asset('js/app.js')}}"></script>
</body>
@endsection