@extends('adminlte::page')
@section('title', 'Cars')

@section('content')
<div class="container">
<a href="/admin/cars/add" class="btn btn-default">Add A Car</a>
</div>
<br>
    @if(count($cars) > 0)
        @foreach($cars as $car)
        <div class="container" style="border: 2px solid;border-radius: 15px;background: lightgray;padding-bottom: 15px;">
                <h1>{{$car->carname}}</h1>
                <h3>{{$car->price}}</h3>
                <h4>{{$car->vin}}</h4>
                <p>{{$car->description}}</p>
                <a href="/admin/cars/edit/{{$car->id}}" class="btn btn-warning">Edit Car</a>
                <a href="/admin/cars/remove/{{$car->id}}" class="btn btn-danger">Delete Car</a>
                <br>
        </div>
                <br>
        @endforeach
    @else
        <h1>Pretty empty fam</h1>
    @endif
@endsection