@extends('adminlte::page')
@section('title', 'Cars')

@section('css')
<style>
    .nav-tabs-custom>.nav-tabs>li.active {
        border-top-color: limegreen
    }
</style>
@endsection

@section('content')
<form method="post" action="/admin/cars/sell/invoice/{{$car->id}}" enctype="multipart/form-data">

    {{ csrf_field() }}

    <div class="container" id="app1">
        <div id="myModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- dialog body -->
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3>Are you sure that the information is correct?<br><strong>(You cannot change it later as it will be deleted.)</strong></h3>
                    </div>
                    <!-- dialog buttons -->
                    <div class="modal-footer"><button type="submit" class="btn btn-danger">Yes</button><button type="button" class="btn btn-warning" data-dismiss="modal">No</button></div>
                </div>
            </div>
        </div>
        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
        <div class="box box-primary" style="border-top: 0px;">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab">Customer</a></li>
                    <li><a href="#tab_2" data-toggle="tab">Car</a></li>
                    <li><a href="#tab_3" data-toggle="tab">Sales Rep</a></li>
                    <li class="pull-right"><button type="button" class="btn btn-success" onclick="showWarning()">Sell Car</button></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <div class="box-header with-border">
                            <h3 class="box-title">Customer Information</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="firstname">First Name</label>
                                <input name="firstname" type="text" class="form-control" id="firstname" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="middlename">Middle Name</label>
                                <input name="middlename" type="text" class="form-control" id="middlename"
                                    placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="lastname">Last Name</label>
                                <input name="lastname" type="text" class="form-control" id="lastname" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="street">Street</label>
                                <input name="street" type="text" class="form-control" id="street" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="zipcode">Zip Code</label>
                                <input name="zipcode" type="text" class="form-control" id="zipcode" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="city">City</label>
                                <input name="city" type="text" class="form-control" id="city" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="state">State</label>
                                <input name="state" type="text" class="form-control" id="state" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone #</label>
                                <input name="phone" type="text" class="form-control" id="phone" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="email">E-Mail Address #</label>
                                <input name="email" type="text" class="form-control" id="email" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="birthday">Birthday</label>
                                <input name="birthday" type="text" class="form-control" id="birthday" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab_2">
                        <div class="box-header with-border">
                            <h3 class="box-title">Car Information</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="dateofsale">Date of Sale</label>
                                <input name="dateofsale" type="text" class="form-control" id="dateofsale" placeholder=""
                                    :value=date readonly="readonly">
                            </div>
                            <div class="form-group">
                                <label for="timeofsale">Time of Sale</label>
                                <input name="timeofsale" type="text" class="form-control" id="timeofsale" placeholder=""
                                    :value=time readonly="readonly">
                            </div>
                            <div class="form-group">
                                <label for="carid">Car Id</label>
                                <input name="carid" type="text" class="form-control" id="carid" placeholder="" value="{{$car->id}}"
                                    readonly="readonly">
                            </div>
                            <div class="form-group">
                                <label for="carname">Car Name</label>
                                <input name="carname" type="text" class="form-control" id="carname" placeholder=""
                                    value="{{$car->carname}}" readonly="readonly">
                            </div>
                            <div class="form-group">
                                <label for="vin">Vin #</label>
                                <input name="vin" type="text" class="form-control" id="vin" placeholder="" value="{{$car->vin}}"
                                    readonly="readonly">
                            </div>
                            <div class="form-group">
                                <label for="carprice">Price</label>
                                <input v-model="carprice" name="carprice" type="text" class="form-control" id="carprice" placeholder="" value="{{$car->price}}">
                            </div>
                            <div class="form-group">
                                <label for="govfees">Goverment Fees</label>
                                <input v-model="govfees" name="govfees" type="text" class="form-control" id="govfees" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="dealerservice">Dealer Service Fees</label>
                                <input v-model="dealerservice" name="dealerservice" type="text" class="form-control" id="dealerservice" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="servicecontract">Service Contract</label>
                                <input v-model="servicecontract" name="servicecontract" type="text" class="form-control" id="servicecontract" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="salestax">Sales Tax</label>
                                <input v-model="salestax" name="salestax" type="text" class="form-control" id="salestax" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="totalprice">Total Price</label>
                                <input v-model="totalprice" name="totalprice" type="text" class="form-control" id="totalprice" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab_3">
                        <div class="box-header with-border">
                            <h3 class="box-title">Sales Representative Information</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="salesrep">Sales Representative Name</label>
                                <input name="salesrep" type="text" class="form-control" id="salesrep" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="adminpassword">Admin/Manager Password</label>
                                <input name="adminpassword" type="password" class="form-control" id="adminpassword" placeholder="">
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
@section('js')
<script src="{{asset('js/app.js')}}"></script>
    <script>

        function showWarning(){
            $("#myModal").on("show", function() { // wire up the OK button to dismiss the modal when shown
                $("#myModal a.btn").on("click", function(e) {
                    console.log("button pressed"); // just as an example...
                    $("#myModal").modal('hide'); // dismiss the dialog
                });
            });
            
            $("#myModal").on("hide", function() { // remove the event listeners when the dialog is dismissed
                $("#myModal a.btn").off("click");
            });
            
            $("#myModal").on("hidden", function() { // remove the actual elements from the DOM when fully hidden
                $("#myModal").remove();
            });
            
            $("#myModal").modal({ // wire up the actual modal functionality and show the dialog
                "backdrop" : "static",
                "keyboard" : true,
                "show" : true // ensure the modal is shown immediately
            });
        };

        $(document).ready(function() {
        $(window).keydown(function(event){
        if(event.keyCode == 13) {
        event.preventDefault();
        return false;
        }
        });
        });
        
        var app = new Vue({
            el: "#app1",
            data: {
                date:  new Date().getUTCMonth() + 1 + "/" + new Date().getUTCDate() + "/" + new Date().getUTCFullYear(),
                time: new Date().getHours() + ":" + new Date().getMinutes(),
                carprice: document.getElementById('carprice').value,
                govfees: '$0',
                dealerservice: '$0',
                servicecontract: '$0',
                salestax: '$0',
                totalprice: document.getElementById('carprice').value,
            },
            
            watch: {
                carprice: function(){
                    this.calculatetotalprice();
                },
                govfees: function(){
                    this.calculatetotalprice();
                },
                dealerservice: function(){
                    this.calculatetotalprice();
                },
                servicecontract: function(){
                    this.calculatetotalprice();
                },
                salestax: function(){
                    this.calculatetotalprice();
                },
            },
    
            methods:{
                calculatetotalprice: function(){
                    var carpriceint = parseFloat(this.carprice.replace('$', '').replace(',', ''));
                    var govfeesint = parseFloat(this.govfees.replace('$', '').replace(',', ''));
                    var dealerserviceint = parseFloat(this.dealerservice.replace('$', '').replace(',', ''));
                    var servicecontractint = parseFloat(this.servicecontract.replace('$', '').replace(',', ''));
                    var salestaxint = parseFloat(this.salestax.replace('$', '').replace(',', ''));
                    this.totalprice = carpriceint + govfeesint + dealerserviceint + servicecontractint + salestaxint;

                    var c = isNaN(c = Math.abs(c)) ? 2 : c,
                    d = d == undefined ? "." : d,
                    t = t == undefined ? "," : t,
                    s = this.totalprice < 0 ? "-" : "" , i=String(parseInt(n=Math.abs(Number(this.totalprice) || 0).toFixed(c))), j=(j=i.length)> 3 ? j % 3 : 0;
                    
                    this.totalprice = "$" + s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(this.totalprice -
                    i).toFixed(c).slice(2) : "");
                },
                    
            }
        });
    </script>
    <script src="{{asset('js/bootbox.all.js')}}"></script>
@endsection