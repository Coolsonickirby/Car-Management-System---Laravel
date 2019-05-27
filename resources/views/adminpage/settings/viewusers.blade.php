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
        background: skyblue;
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

    .pagination {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        padding-left: 0;
        list-style: none;
        border-radius: 0;
        -webkit-box-pack: center !important;
        -ms-flex-pack: center !important;
        justify-content: center !important;
    }

    .pagination>.active>a,
    .pagination>.active>a:focus,
    .pagination>.active>a:hover,
    .pagination>.active>span,
    .pagination>.active>span:focus,
    .pagination>.active>span:hover {

        z-index: 3;
        color: #fff;
        cursor: default;
        background-color: mediumseagreen;
        border-color: #222d32;

    }

    .pagination>li>a,
    .pagination>li>span {
        border: 1px solid #222d32;
    }

    .pagination>li>a:focus,
    .pagination>li>a:hover,
    .pagination>li>span:focus,
    .pagination>li>span:hover {
        color: purple;
        background-color: lightgray;
        border-color: #222d32;
    }
</style>
@endsection

@section('content')

@include('inc.status')

@if (count($users) > 0)
<br>
<table id="" class="table table-hover"
    style="border: 2px solid black;border-radius: 20px;background: lightgreen;border-collapse: separate;">
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
<div>
    {{$users->links()}}
</div>
@else
<h1>If the system is glitched, then call <strong>NUMBER</strong></h1>
@endif
@endsection