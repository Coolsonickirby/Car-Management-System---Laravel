@extends('adminlte::page')
@section('title', 'View Users')

@section('css')
<style>
    @media(max-width:949px) {
        .table {
            overflow-x: auto;
            display: block;
        }
    }

    .table-hover tbody tr:hover td {
        background: lightgreen;
    }

    .table-hover tbody tr td {
        border-top: 2px solid black;
        border-right: 2px solid black;
    }

    .table-hover thead tr th {
        border-right: 2px solid black;
    }

    .table-hover thead tr th:last-child {
        border-right: 0px solid black;
    }

    .table-hover tbody tr td:last-child {
        border-top: 2px solid black;
        border-right: 0px;

    }

    table tr:last-child td:first-child {
        border-bottom-left-radius: 14px;
    }

    table tr:last-child td:last-child {
        border-bottom-right-radius: 14px;
    }

    .table>thead>tr>th,
    .table>tbody>tr>th,
    .table>tfoot>tr>th,
    .table>thead>tr>td,
    .table>tbody>tr>td,
    .table>tfoot>tr>td {
        border-top: 2px solid black;
    }

    .table>thead>tr>th {
        border-bottom: 0px;
    }
</style>
@endsection

@section('content')

@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if (count($users) > 0)
<br>
<table id="" class="table table-hover"
    style="border: 2px solid black;border-radius: 20px;background: lightskyblue;border-collapse: separate;">
    <thead>
        <tr>
            <th>Name</th>
            <th>E-Mail</th>
            <th>Role</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->role}}</td>
            <td><a href="/admin/settings/removeuser/{{$user->id}}" class="btn btn-danger">Delete User</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
@else

@endif
@endsection