@extends('adminlte::page')
@section('title', 'Create User')

@section('content')

<div class="container">
    <form class="form-horizontal" method="POST" action="/admin/settings/createuser/new">
        {{ csrf_field() }}

        @if ($errors->has('name'))
        <div class="form-group">
            <label for="" class="col-md-4 control-label"></label>

            <div class="col-md-6">
                <span class="callout callout-danger">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            </div>
        </div>
        <br>
        @endif

        @if ($errors->has('email'))
        <div class="form-group">
            <label for="" class="col-md-4 control-label"></label>

            <div class="col-md-6">
                <span class="callout callout-danger">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            </div>
        </div>
        <br>
        @endif


        @if ($errors->has('password'))
        <div class="form-group">
            <label for="" class="col-md-4 control-label"></label>
        
            <div class="col-md-6">
                <span class="callout callout-danger">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            </div>
        </div>
        <br>
        @endif

        @if ($errors->has('password_confirmation'))
        <div class="form-group">
            <label for="" class="col-md-4 control-label"></label>
        
            <div class="col-md-6">
                <span class="callout callout-danger">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
            </div>
        </div>
        <br>
        @endif

        @if (session('success'))
        <div class="form-group">
            <label for="" class="col-md-4 control-label"></label>
        
            <div class="col-md-6">
                <span class="alert alert-success">
                    <strong>{{ session('success') }}</strong>
                </span>
            </div>
        </div>
        <br>
        @endif

        <div class="form-group">
            <label for="name" class="col-md-4 control-label">Name</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control" name="name" required>
            </div>
        </div>

        <div class="form-group">
            <label for="email" class="col-md-4 control-label">E-Mail</label>

            <div class="col-md-6">
                <input id="email" type="text" class="form-control" name="email" required>
            </div>
        </div>

        <div class="form-group">
            <label for="password" class="col-md-4 control-label">Password</label>

            <div class="col-md-6">
                <input id="password" type="password" class="form-control" name="password" required>
            </div>
        </div>

        <div class="form-group">
            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

            <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
            </div>
        </div>

        <div class="form-group">
            <label for="password-confirm" class="col-md-4 control-label">Role</label>
            <div class="col-md-6">
                <select id="role-list" class="form-control">
                    <option value="admin" name="Admin">Admin</option>
                    <option value="manager" name="Manager">Manager</option>
                    <option value="employee" name="Employee">Employee</option>
                </select>
            </div>
            <input type='hidden' id="role" name="role" value="Admin">
        </div>

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-success">
                    Create User
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

@section('js')
<script type="text/javascript" language="javascript">
    $(function() {
            $("#role-list").change(function(){
            var roleselect= $('option:selected', this).attr('name');
            $('#role').val(roleselect);
        });
    });
</script>
@endsection