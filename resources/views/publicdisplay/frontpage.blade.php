@extends('layouts.app')
@section('title')
    <title>Home Page</title>
@endsection

@section('css')
    <style>
    
        p {
            font: normal 15px Arial;
            text-align: left;
        }

    </style>
@endsection

@section('content')
    <br>
    <div class="container">
        <div class="container-fluid" style="border: 4px solid green; border-radius: 30px; padding: 10px;">
            <div class="row">
                <div class="col-xl-6"><img src="https://privaterubikscubetimer.000webhostapp.com/holdmeback.gif" alt="hoi" style="border-radius: 50px;width: 100%;height: 100%;"></div>
                                    
            <div class="col-xl-6" style="text-align: center;"><h1>Welcome</h1>{!! $info->description !!}</div>
            </div>
        </div>
    </div>
@endsection