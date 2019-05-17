@extends('adminlte::page')
@section('title', 'Cars')
@section('css')
<style>
    @media(max-width:949px){
        .table{
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

    .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
        border-top: 2px solid black;
    }

    .table > thead > tr > th {
        border-bottom: 0px;
    }
</style>
@endsection

@section('content')

@include('inc.status')
<a href="/admin/cars/add" class="btn btn-default">Add A Car</a>
    @if(count($cars) > 0)
    <br>

    <table id="" class="table table-hover" style="border: 2px solid black;border-radius: 20px;background: lightskyblue;border-collapse: separate;">
                <thead>
                <tr>
                    <th>Car Name</th>
                    <th>Price</th>
                    <th>Vin #</th>
                    <th>Year</th>
                    <th>Model</th>
                    <th>Sell</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
        @foreach($cars as $car)
                    <tr>
                        <td>{{$car->carname}}</td>
                        <td>{{$car->price}}</td>
                        <td>{{$car->vin}}</td>
                        <td>{{$car->year}}</td>
                        <td>{{$car->model}}</td>
                        <td><a href="/admin/cars/sell/{{$car->id}}" class="btn btn-success">Sell Car</a></td>
                        <td><a href="/admin/cars/edit/{{$car->id}}" class="btn btn-warning">Edit Car</a></td>
                        <td><a href="/admin/cars/remove/{{$car->id}}" class="btn btn-danger">Delete Car</a></td>
                    </tr>
        @endforeach
    </tbody>
</table>
</div>
    @else
        <div class="container">
            <h1>Pretty empty fam</h1>
        </div>
    @endif
@endsection