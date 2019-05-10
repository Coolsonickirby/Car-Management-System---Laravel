@extends('adminlte::page')
@section('title', 'Front Page Info')

@section('content')
<div class="container">
    @if (session('error'))
        <div class="callout callout-danger">
            {{ session('error') }}
        </div>
    @endif
    @if (session('success'))
        <div class="callout callout-success">
            {{ session('success') }}
        </div>
    @endif
        <form method="post" action="/admin/settings/publicinfo/submit" enctype="multipart/form-data">
            <div class="box-body">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <label for="name">Busniess Name</label>
                    <input name="name" type="text" class="form-control" placeholder="">
                </div>
                
                <div class="form-group">
                    <label for="frontimages">Front Page Images</label>
                    <input name="frontimages[]" type="file" class="form-control" placeholder="" style="height: 100%;" multiple>
                </div>

                <div class="form-group">
                    <label for="frontdescription">Front Page Description</label>
                    <textarea name="frontdescription" id="textarea1" class="form-control" placeholder=""></textarea>
                </div>

                <div class="form-group">
                    <label for="aboutimages">About Page Images</label>
                    <input name="aboutimages[]" type="file" class="form-control" placeholder="" style="height: 100%;" multiple>
                </div>

                <div class="form-group">
                    <label for="aboutdescription">About Page Description</label>
                    <textarea name="aboutdescription" id="textarea2" class="form-control" placeholder=""></textarea>
                </div>

                <div class="form-group">
                    <label for="contactemail">Busniess E-Mail</label>
                    <input name="contactemail" type="text" class="form-control" placeholder="">
                </div>

                <div class="form-group">
                    <label for="contacteaddress">Busniess Address</label>
                    <input name="contactaddress" type="text" class="form-control" placeholder="">
                </div>
                
                <div class="form-group">
                    <label for="contactphone">Busniess Phone Number</label>
                    <input name="contactphone" type="text" class="form-control" placeholder="">
                </div>

                <script type="text/javascript">
                    CKEDITOR.replace( 'textarea1' );
                    CKEDITOR.replace( 'textarea2' );
                </script>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

            </div>
        </form>
</div>

@endsection