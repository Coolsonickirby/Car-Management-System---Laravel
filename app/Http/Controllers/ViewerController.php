<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FrontPageInfo;
use App\CarProduct;

class ViewerController extends Controller
{
    public function FrontPage(){
        $info = FrontPageInfo::find(1);

        return view('publicdisplay.frontpage')->with('info', $info);
    }

    public function Products(){
        $cars = CarProduct::all();
        return view('publicdisplay.products')->with('cars', $cars);
    }

    public function CarShowcase($id){
        $car = CarProduct::find($id);
        return view('publicdisplay.carshowcase')->with('car', $car);
    }

    public function AboutPage(){
        $info = FrontPageInfo::find(1);
        return view('publicdisplay.aboutpage')->with('info', $info);
    }

}
