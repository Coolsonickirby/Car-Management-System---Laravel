@extends('layouts.app')
@section('title')
<title>Products</title>
@endsection

@section('css')
<style>
    p {
        font: normal 15px Arial;
        text-align: left;
        color: black;
        letter-spacing: normal;
    }
    .moreinfo{
        border: 2px solid lightblue;
        border-radius: 20px;
        background: lightblue;
        color: black;
    }
    
    .moreinfo:hover{
        border: 2px solid lightgreen;
        border-radius: 20px;
        background: lightgreen;
        color: black;
    }
</style>
@endsection

@section('content')
<div class="container">
    <br>
    @foreach ($cars as $car)
    <div class="container-fluid"
        style="border: 4px solid green; border-radius: 30px; padding: 10px; background-color: gainsboro; width: 80%;">
        <div class="row">
            <div class="col-xl-4"><img src="{{asset($car->thumbnail)}}" alt="Image"
                    style="border-radius: 3px; max-width: 100%; width: 100%;"></div>

            <div class="col-xl-8" style="text-align: center;">
                <h4 style="text-decoration: underline; letter-spacing: normal; text-transform: none;">{{$car->carname}}</h4>
                <div class="row">
                    <div class="col-xl-8">
                        <div class="row">
                                <div class="col-xl-4">
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <p>Year: {{$car->year}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <p>Model: {{$car->model}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <p>Miles: {{$car->miles}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <p>Engine: {{$car->engine}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-8">
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <p>Vin: {{$car->vin}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <p>Exterior Color: {{$car->exteriorcolor}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <p>Interior Color: {{$car->interiorcolor}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <p>Make: {{$car->make}}</p>
                                            </div>
                                        </div>
                                    </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div style="border: 2px solid gray;border-radius: 20px;background: gray;color: black;">{{$car->price}}</div>
                        <br>
                        <a style="text-decoration:none;" href="/products/{{$car->id}}">
                            <div class="moreinfo">More Info</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    @endforeach
</div>
@endsection