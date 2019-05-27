@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
<h1>Dashboard</h1>
@stop

@section('content')
@include('inc.status')

<div class="row">
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->

    <div class="small-box bg-green" style="border-radius: 15px;">
      <div class="inner">
        <h5>Current User: {{App\User::find(Auth::id())->name}}</h5>
        <h5>Role: {{App\User::find(Auth::id())->role}}</h5>
      </div>
    </div>
  </div>
</div>

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