@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <a href="/admin/cars" class="small-box bg-aqua" style="border-radius: 15px;">
            <div class="inner">
              <h3>{{count($cars)}}</h3>

              <h3>Cars</h3>
            </div>
            <div class="icon">
              <i class="fa fa-car"></i>
            </div>
          </div>
    </div>
@stop