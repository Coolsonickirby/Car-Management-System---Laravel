<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CarProduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function AdminHome(){

        if (Auth::check()) {
            $cars = CarProduct::all();

            return view('admin') -> with('cars', $cars);
        } else {
            return redirect('login');
        }
        
    }

    public function AdminCars(){

        if (Auth::check()) {

            $cars = CarProduct::all();

            return view('CarManager') -> with('cars', $cars);

        } else {

            return redirect('login');

        }
        
    }
        
    public function AdminCarAdder(){
        if (Auth::check()) {
            return view('CarField');
        } else {
            return redirect('login');
        }
        
        
    }

    public function AdminNewCar(Request $newcar){

        if (Auth::check()) {
        $this->validate($newcar, [
            'carname' => 'required',
            'price' => 'required'
        ]);


        $imagename = $newcar->image->getClientOriginalName();
        


        $newcar->image->storeAs('public', $imagename);

        $url = Storage::url($imagename);

        $carnew = new CarProduct;
        $carnew->carname = $newcar->input('carname');
        $carnew->price = $newcar->input('price');
        $carnew->vin = $newcar->input('vin');
        $carnew->description = $newcar->input('cardescription');
        $carnew->photos = $url;
        $carnew->model = $newcar->input('model');
        $carnew->make = $newcar->input('make');
        $carnew->year = $newcar->input('modelyear');
        $carnew->manufacturer = $newcar->input('manufacturer');
        $carnew->type = $newcar->input('vehicletype');
        $carnew->engine = $newcar->input('engine');
        $carnew->transmission = $newcar->input('transmission');
        $carnew->body = $newcar->input('bodyclass');
        $carnew->miles = $newcar->input('miles');
        $carnew->fueltype = $newcar->input('fueltype');
        $carnew->interiorcolor = $newcar->input('intcolor');
        $carnew->exteriorcolor = $newcar->input('extcolor');
        $carnew->drivetrain = $newcar->input('drivetype');
        $carnew->steeringlocation = $newcar->input('steeringlocation');
        $carnew->save();
        
        return redirect('/admin/cars');
        } else{
            return redirect('login');
        }
    }

    public function AdminCarEditor($id){

        if (Auth::check()) {

        $car = CarProduct::find($id);

        return view('CarEditorField') -> with('car', $car);

        } else{
            return redirect('login');
        }
    }

    public function AdminCarPublishEdit($id, Request $oldcar){
        if (Auth::check()) {

        $car = CarProduct::find($id);

        $car->carname = $oldcar->input('carname');
        $car->price = $oldcar->input('price');
        $car->vin = $oldcar->input('vin');
        $car->description = $oldcar->input('cardescription');
        $car->photos = $oldcar->input('photos');
        $car->model = $oldcar->input('model');
        $car->make = $oldcar->input('make');
        $car->year = $oldcar->input('modelyear');
        $car->manufacturer = $oldcar->input('manufacturer');
        $car->type = $oldcar->input('vehicletype');
        $car->engine = $oldcar->input('engine');
        $car->transmission = $oldcar->input('transmission');
        $car->body = $oldcar->input('bodyclass');
        $car->miles = $oldcar->input('miles');
        $car->fueltype = $oldcar->input('fueltype');
        $car->interiorcolor = $oldcar->input('intcolor');
        $car->exteriorcolor = $oldcar->input('extcolor');
        $car->drivetrain = $oldcar->input('drivetype');
        $car->steeringlocation = $oldcar->input('steeringlocation');

        $car->save();

        return redirect('/admin/cars');
        } else{
            return redirect('login');
        }
        
    }

    public function AdminCarRemover($id){
        if (Auth::check()) {

        $car = CarProduct::find($id);
        Storage::delete($car->photos);
        $car->delete();

        return redirect('/admin/cars');
        } else{
            return redirect('login');
        }
    }

}
