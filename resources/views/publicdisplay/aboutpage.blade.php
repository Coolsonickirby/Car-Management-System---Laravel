@extends('layouts.app') @section('title')
<title>Home Page</title>
@endsection @section('css')
<style>
    p {
        font: normal 15px Arial;
        text-align: left;
    }
</style>
@endsection @section('content')
<br>
<div class="container">
    <div class="container-fluid" style="border: 4px solid green; border-radius: 30px; padding: 10px;">
        <div class="row">
            <div class="col-xl-6">
                @if (count((array)unserialize($info->aboutimages)) > 1)
                <div id="slideshowabout" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        
                            @foreach (unserialize($info->aboutimages) as $image)
                                @if ($loop->first)
                                    <div class="carousel-item active">
                                    <img class="d-block w-100" src="{{asset($image)}}" alt="hoi" style="border-radius: 50px;width: 100%;height: 100%;max-width: 500px;max-height:500px;">
                                    </div>
                                @else
                                    <div class="carousel-item">
                                        <img class="d-block w-100" src="{{asset($image)}}" alt="hoi" style="border-radius: 50px;width: 100%;height: 100%;max-width: 500px;max-height:500px;">
                                    </div>
                                @endif
                            @endforeach
                            <a class="carousel-control-prev" href="#slideshowabout" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#slideshowabout" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                    </div>
                    
                </div>
                @else
                    @foreach (unserialize($info->aboutimages) as $image)
                    @if ($loop->first)
                        <img class="d-block w-100" src="{{asset($image)}}" alt="hoi" style="border-radius: 50px;width: 100%;height: 100%;max-width: 500px;max-height:500px;">
                    @endif
                    @endforeach
                @endif
            </div>
            <div class="col-xl-6" style="text-align: center;">
                <h1>{{$info->name}}</h1>
                <div style="word-break: break-all;">
                    {!! $info->aboutdescription !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection