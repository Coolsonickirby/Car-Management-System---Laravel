@extends('adminlte::page')
@section('title', 'Front Page Info')

@section('content')
<div class="container">
    
        <form method="post" action="/admin/settings/frontpageinfo/submit" enctype="multipart/form-data">
            <div class="box-body">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <label for="name">Busniess Name</label>
                    <input name="name" type="text" class="form-control" placeholder="">
                </div>
                
                <div class="form-group">
                    <label for="description">Front Page Description</label>
                    <textarea name="description" id="textarea" class="form-control" placeholder=""></textarea>
                </div>

                <script type="text/javascript">
                    CKEDITOR.replace( 'textarea' );
                </script>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

            </div>
        </form>
</div>

@endsection