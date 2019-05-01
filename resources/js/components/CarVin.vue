<template>
<div>
        <div class="form-group">
            <label for="carname">Name</label>
            <input name="carname" type="text" class="form-control" id="carname" placeholder="">
        </div>

        <div class="form-group">
            <label for="price">Price</label>
            <input name="price" type="text" class="form-control" id="price" placeholder="">
        </div>

        <div class="form-group">
            <label for="images">Pictures</label>
            <input type="file"  class="form-control" style="height: 100%;" name="image">
        </div>

        <div class="form-group">
            <label for="vin">Vin #</label>
            <input v-model="vin" name="vin" type="text" class="form-control" :id="vin" placeholder="">
            <br>
            <button v-on:click="randomvin" type="button" class="btn btn-secondary">Random</button>
        </div>

        <div class="form-group">
                <label for="modelyear">Year</label>
                <input v-model="modelyear" name="modelyear" type="text" class="form-control" :id="modelyear" placeholder="">
        </div>

        <div class="form-group">
                <label for="extcolor">Exterior Color</label>
                <input name="extcolor" type="text" class="form-control" id="extcolor" placeholder="">
        </div>

        <div class="form-group">
                <label for="intcolor">Interior Color</label>
                <input name="intcolor" type="text" class="form-control" id="intcolor" placeholder="">
        </div>

        <div class="form-group">
                <label for="miles">Miles</label>
                <input name="miles" type="text" class="form-control" id="miles" placeholder="">
        </div>

        <div class="form-group">
            <label for="cardescription">Description</label>
            <textarea name="cardescription" class="form-control" id="cardescription" placeholder=""></textarea>
        </div>

        <div class="form-group">
                <label for="make">Make</label>
                <input v-model="make" name="make" type="text" class="form-control" id="make" placeholder="">
        </div>

        <div class="form-group">
                <label for="model">Model</label>
                <input v-model="model" name="model" type="text" class="form-control" id="model" placeholder="">
        </div>

        <div class="form-group">
                <label for="manufacturer">Manufacturer</label>
                <input v-model="manufacturer" name="manufacturer" type="text" class="form-control" id="manufacturer" placeholder="">
        </div>

        <div class="form-group">
                <label for="drivetype">Drive Type</label>
                <input v-model="drivetype" name="drivetype" type="text" class="form-control" id="drivetype" placeholder="">
        </div>

        <div class="form-group">
                <label for="engine">Engine Model</label>
                <input v-model="engine" name="engine" type="text" class="form-control" id="engine" placeholder="">
        </div>

        <div class="form-group">
                <label for="transmission">Transmission</label>
                <input v-model="transmission" name="transmission" type="text" class="form-control" id="transmission" placeholder="">
        </div>

        <div class="form-group">
                <label for="vehicletype">Vehicle Type</label>
                <input v-model="vehicletype" name="vehicletype" type="text" class="form-control" id="vehicletype" placeholder="">
        </div>

        <div class="form-group">
                <label for="bodyclass">Body Class</label>
                <input v-model="bodyclass" name="bodyclass" type="text" class="form-control" id="bodyclass" placeholder="">
        </div>

        <div class="form-group">
            <label for="steeringlocation">Steering Location</label>
            <input v-model="bodyclass" name="steeringlocation" id="steeringlocation" type="text" class="form-control" placeholder="">
        </div>
                
        <div class="form-group">
            <label for="fueltype">Fuel Type</label>
            <input v-model="fueltype" name="fueltype" type="text" class="form-control" id="fueltype" placeholder="">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
</div>
</template>

<script>
export default {
    data: function(){
        return {
            CarVin:[],
            vin: '',
            modelyear: '',
            make: '',
            model: '',
            manufacturer: '',
            drivetype: '',
            engine: '',
            transmission: '',
            vehicletype: '',
            bodyclass: '',
            steeringlocation: '',
            fueltype: ''
        }
    },

    watch: {
        vin: function () {
            this.fetchVinInfo()
        },
        modelyear: function () {
            this.fetchVinInfo()
        }
    },

    methods:{

        randomvin: function () {
            
            var self = this;

            if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
                var xmlhttp=new XMLHttpRequest();
            } else {// code for IE6, IE5
                var xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }


            
            xmlhttp.onreadystatechange=function() {
                if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                    self.vin = xmlhttp.responseText;
                    console.log(self.vin);
                    this.fetchVinInfo;
                }
            }

            xmlhttp.open("GET", "/randomvin");
            xmlhttp.send();

        },

        fetchVinInfo: function(){
            
            var VinNumber = this.vin;

            if(VinNumber == null){
                return
            } else {

                var Year = "&modelyear=" + this.modelyear;

                if(Year.length < 10){
                    this.$http.get("https://vpic.nhtsa.dot.gov/api/vehicles/decodevinvalues/" + VinNumber + "?format=json").then(function(data){
                        this.CarVin = data.body;
                        this.make = this.CarVin.Results[0].Make;
                        this.model = this.CarVin.Results[0].Model;
                        this.manufacturer = this.CarVin.Results[0].Manufacturer;
                        this.drivetype = this.CarVin.Results[0].DriveType;
                        this.engine = this.CarVin.Results[0].EngineModel;
                        this.transmission = this.CarVin.Results[0].Transmission;
                        this.vehicletype = this.CarVin.Results[0].VehicleType;
                        this.bodyclass = this.CarVin.Results[0].BodyClass;
                        this.steeringlocation = this.CarVin.Results[0].SteeringLocation;
                        this.fueltype = this.CarVin.Results[0].FuelTypePrimary;
                    })
                } else{
                    this.$http.get("https://vpic.nhtsa.dot.gov/api/vehicles/decodevinvalues/" + VinNumber + "?format=json" + Year).then(function(data){
                        this.CarVin = data.body;
                        this.make = this.CarVin.Results[0].Make;
                        this.model = this.CarVin.Results[0].Model;
                        this.modelyear = this.CarVin.Results[0].ModelYear;
                        this.manufacturer = this.CarVin.Results[0].Manufacturer;
                        this.drivetype = this.CarVin.Results[0].DriveType;
                        this.engine = this.CarVin.Results[0].EngineModel;
                        this.transmission = this.CarVin.Results[0].Transmission;
                        this.vehicletype = this.CarVin.Results[0].VehicleType;
                        this.bodyclass = this.CarVin.Results[0].BodyClass;
                        this.steeringlocation = this.CarVin.Results[0].SteeringLocation;
                        this.fueltype = this.CarVin.Results[0].FuelTypePrimary;
                    })
                }

            }
        }
    }
}
</script>
