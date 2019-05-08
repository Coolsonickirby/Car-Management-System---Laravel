@extends('layouts.app')
@section('title')
<title>{{$car->carname}}</title>
@endsection

@section('css')
<style>

    p {
            font: normal 15px Arial;
            text-align: left;
        }

    /* Style the tab */
    .tab {
    overflow: hidden;
    border: 1px solid black;
    border-bottom: none;
    border-top-left-radius: 15px;
    border-top-right-radius: 15px;

    }

    /* Style the buttons that are used to open the tab content */
    .tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
    margin-left: 5px;
    margin-top: 2px;"
    }

    /* Change background color of buttons on hover */
    .tab button:hover {
    border: 3px solid black;
    border-radius: 20px;
    background-color: lightpink;
    }

    /* Create an active/current tablink class */
    .tab button.active {
    border: 3px solid black;
    border-radius: 20px;
    background: lightblue;
    }

    /* Style the tab content */
    .tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid black;
    border-top: none;
    border-bottom-left-radius: 15px;
    border-bottom-right-radius: 15px;
    }
    /* Fade in tabs */
    @-webkit-keyframes fadeEffect {
        from {opacity: 0;}
        to {opacity: 1;}
    }

    @keyframes fadeEffect {
        from {opacity: 0;}
        to {opacity: 1;}
    }

</style>
@endsection

@section('content')
<br>
<div class="container">
    <div class="container-fluid" style="border: 4px solid green; border-radius: 30px; padding: 10px; background-color: gainsboro; width: 80%;">
        <div class="row">
            <div class="col-md-12">
                <h3 style="text-transform: none;letter-spacing: normal;">
                    {{$car->carname}}
                </h3>
                <div class="tab">
                    <button class="tablinks" id="default" onclick="changeTab(event, 'description')">Description</button>
                    <button class="tablinks" onclick="changeTab(event, 'pictures')">Pictures</button>
                    <button class="tablinks" onclick="changeTab(event, 'info')">Extra Info</button>
                </div>
                <div id="description" class="tabcontent">
                        {!! $car->description !!}
                </div>
                        
                <div id="pictures" class="tabcontent">
                    @foreach (unserialize($car->photos) as $image)
                        <img src="{{asset($image)}}" style="max-width:200px; height: auto;">
                    @endforeach
                </div>

                <div id="info" class="tabcontent">
                    <h1>HOI</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

function changeTab(evt, info) {
  // Declare all variables
  var i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(info).style.display = "block";
  evt.currentTarget.className += " active";
} 

function onLoadFunctions() {
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById("description").style.display = "block";
    document.getElementById("default").className += " active";
}

window.onload = onLoadFunctions;
</script>
@endsection