<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function AdminHome(){
        return view('home');
    }

    public function AdminCars(){
        return view('CarField');
    }
}
