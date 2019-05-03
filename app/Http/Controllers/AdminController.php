<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CarProduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Hash;

class AdminController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function AdminHome(){

        if (Auth::check()) {
            $cars = CarProduct::all();

            return view('adminpage.admin') -> with('cars', $cars);
        } else {
            return redirect('login');
        }
        
    }

    public function AdminCars(){

        if (Auth::check()) {

            $cars = CarProduct::all();

            return view('adminpage.CarManager') -> with('cars', $cars);

        } else {

            return redirect('login');

        }
        
    }
        
    public function AdminCarAdder(){
        $cars = CarProduct::all();

        if (Auth::check()) {
            return view('adminpage.CarField') -> with('cars', $cars);
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


        $imagenames = [];

        foreach($newcar->file('images') as $image)
        {
            $image->store('public');   
            $url = Storage::url($image->hashName());       
            array_push($imagenames, $url);
        }

        $newcar->file('thumbnail')->store('public');

        $carnew = new CarProduct;
        $carnew->carname = $newcar->input('carname');
        $carnew->price = $newcar->input('price');
        $carnew->vin = $newcar->input('vin');
        $carnew->description = $newcar->input('cardescription');
        $carnew->thumbnail = Storage::url($newcar->file('thumbnail')->hashname());
        $carnew->photos = serialize($imagenames);
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
        
        foreach(unserialize($car->photos) as $photo){
            $file_to_delete = str_replace("storage","public",$photo);

            Storage::delete($file_to_delete);
        }

        $thumbnail = str_replace("storage","public",$car->thumbnail);

        Storage::delete($thumbnail);

        $car->delete();

        return redirect('/admin/cars');
        } else{
            return redirect('login');
        }
    }

    public function showChangePasswordForm(){
        $cars = CarProduct::all();

        return view('auth.passwords.changepassword') -> with('cars', $cars);
    }

    public function ChangePassword(Request $request){
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not match with the password you provided. Please try again.");
        }
        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }
        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);
        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
        return redirect()->back()->with("success","Password changed successfully !");
    }

}
