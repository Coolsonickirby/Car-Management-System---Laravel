@extends('adminlte::page')
@section('title', 'Cars')

@section('content')
<form method="post" action="/admin/cars/edit/modify/{{$car->id}}" enctype="multipart/form-data">

        {{ csrf_field() }}
        <div class="container">
                <div class="box box-primary">
                        <div class="box-header with-border">
                                <h3 class="box-title">Car Form</h3>
                        </div>
                        <div class="box-body">
                                <div class="form-group">
                                        <label for="carname">Name</label>
                                        <input name="carname" type="text" class="form-control" id="carname"
                                                placeholder="" value="{{$car->carname}}">
                                </div>

                                <div class="form-group">
                                        <label for="price">Price</label>
                                        <input name="price" type="text" class="form-control" id="price" placeholder=""
                                                value="{{$car->price}}">
                                </div>

                                <div class="form-group">
                                        <label for="images">Pictures</label>
                                        <input type="file" class="form-control" style="height: 100%;" name="images[]"
                                                multiple>
                                </div>

                                <div class="form-group">
                                        <label for="vin">Vin #</label>
                                        <input name="vin" type="text" class="form-control" id="vin" placeholder=""
                                                value="{{$car->vin}}">
                                        <br>
                                </div>

                                <div class="form-group">
                                        <label for="modelyear">Year</label>
                                        <input name="modelyear" type="text" class="form-control" :id="modelyear"
                                                placeholder="" value="{{$car->year}}">
                                </div>

                                <div class="form-group">
                                        <label for="extcolor">Exterior Color</label>
                                        <input name="extcolor" type="text" class="form-control" id="extcolor"
                                                placeholder="" value="{{$car->exteriorcolor}}">
                                </div>

                                <div class="form-group">
                                        <label for="intcolor">Interior Color</label>
                                        <input name="intcolor" type="text" class="form-control" id="intcolor"
                                                placeholder="" value="{{$car->interiorcolor}}">
                                </div>

                                <div class="form-group">
                                        <label for="miles">Miles</label>
                                        <input name="miles" type="text" class="form-control" id="miles" placeholder=""
                                                value="{{$car->miles}}">
                                </div>

                                <div class="form-group">
                                        <label for="cardescription">Description</label>
                                        <textarea name="cardescription" class="form-control" id="cardescription"
                                                placeholder="">{{$car->description}}</textarea>
                                </div>

                                <div class="form-group">
                                        <label for="make">Make</label>
                                        <input name="make" type="text" class="form-control" id="make" placeholder=""
                                                value="{{$car->make}}">
                                </div>

                                <div class="form-group">
                                        <label for="model">Model</label>
                                        <input name="model" type="text" class="form-control" id="model" placeholder=""
                                                value="{{$car->model}}">
                                </div>

                                <div class="form-group">
                                        <label for="manufacturer">Manufacturer</label>
                                        <input name="manufacturer" type="text" class="form-control" id="manufacturer"
                                                placeholder="" value="{{$car->manufacturer}}">
                                </div>

                                <div class="form-group">
                                        <label for="drivetype">Drive Type</label>
                                        <input name="drivetype" type="text" class="form-control" id="drivetype"
                                                placeholder="" value="{{$car->drivetrain}}">
                                </div>

                                <div class="form-group">
                                        <label for="engine">Engine Model</label>
                                        <input name="engine" type="text" class="form-control" id="engine" placeholder=""
                                                value="{{$car->engine}}">
                                </div>

                                <div class="form-group">
                                        <label for="transmission">Transmission</label>
                                        <input name="transmission" type="text" class="form-control" id="transmission"
                                                placeholder="" value="{{$car->transmission}}">
                                </div>

                                <div class="form-group">
                                        <label for="vehicletype">Vehicle Type</label>
                                        <input name="vehicletype" type="text" class="form-control" id="vehicletype"
                                                placeholder="" value="{{$car->type}}">
                                </div>

                                <div class="form-group">
                                        <label for="bodyclass">Body Class</label>
                                        <input name="bodyclass" type="text" class="form-control" id="bodyclass"
                                                placeholder="" value="{{$car->body}}">
                                </div>

                                <div class="form-group">
                                        <label for="steeringlocation">Steering Location</label>
                                        <input type="text" class="form-control" name="steeringlocation"
                                                id="steeringlocation" placeholder="" value="{{$car->steeringlocation}}">
                                </div>

                                <div class="form-group">
                                        <label for="fueltype">Fuel Type</label>
                                        <input type="text" class="form-control" name="fueltype" id="fueltype"
                                                placeholder="" value="{{$car->fueltype}}">
                                </div>

                                <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                        </div>
                </div>
        </div>
</form>
@endsection

@section('js')
    <script type="text/javascript" src="{{asset('ckeditor/ckeditor.js')}}"></script>
    <script type="text/javascript">
        CKEDITOR.replace( 'cardescription' );
        </script>
@endsection