<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CarProduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Hash;
use App\FrontpageInfo;
use App;
use PDF;
use App\User;


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


    public function AdminHome()
    {

        if (Auth::check()) {
            $cars = CarProduct::all();

            return view('adminpage.admin')->with('cars', $cars);
        } else {
            return redirect('login');
        }
    }

    public function AdminCars()
    {

        if (Auth::check()) {

            $cars = CarProduct::all();

            return view('adminpage.cars.CarManager')->with('cars', $cars);
        } else {

            return redirect('login');
        }
    }

    public function AdminCarAdder()
    {
        if (Auth::check()) {
            $user = User::find(Auth::id());

            if ($user->role == 'Admin' or $user->role == 'Manager') {
                return view('adminpage.cars.CarField');
            } else {
                return redirect()->back()->with("error", "Only the admin(s) or manager(s) can add cars.");
            }
        } else {
            return redirect('login');
        }
    }

    public function AdminNewCar(Request $newcar)
    {

        if (Auth::check()) {
            $this->validate($newcar, [
                'carname' => 'required',
                'price' => 'required'
            ]);

            $carnew = new CarProduct;

            $imagenames = [];

            if ($newcar->file('thumbnail') != null) {

                $newcar->file('thumbnail')->store('public');

                $carnew->thumbnail = Storage::url($newcar->file('thumbnail')->hashname());
            }

            if ($newcar->file('images') != null) {

                foreach ($newcar->file('images') as $image) {
                    $image->store('public');
                    $url = Storage::url($image->hashName());
                    array_push($imagenames, $url);
                }

                $carnew->photos = serialize($imagenames);
            }

            $carnew->carname = $newcar->input('carname');
            $carnew->price = $newcar->input('price');
            $carnew->vin = $newcar->input('vin');
            $carnew->description = $newcar->input('cardescription');
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
        } else {
            return redirect('login');
        }
    }

    public function AdminCarEditor($id)
    {

        if (Auth::check()) {

            $user = User::find(Auth::id());

            if ($user->role == 'Admin' or $user->role == 'Manager') {
                $car = CarProduct::where('id', $id)->first();

                return view('adminpage.cars.CarEditorField')->with('car', $car);
            } else {
                return redirect()->back()->with("error", "Only the admin(s) or manager(s) can edit cars.");
            }
        } else {
            return redirect('login');
        }
    }

    public function AdminCarPublishEdit($id, Request $oldcar)
    {
        if (Auth::check()) {

            $car = CarProduct::where('id', $id)->first();

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
        } else {
            return redirect('login');
        }
    }

    public function AdminCarRemover($id)
    {
        if (Auth::check()) {

            $user = User::find(Auth::id());

            if ($user->role == 'Admin' or $user->role == 'Manager') {
                $car = CarProduct::where('id', $id)->first();


                if ($car->photos != null) {
                    foreach (unserialize($car->photos) as $photo) {
                        $file_to_delete = str_replace("storage", "public", $photo);

                        Storage::delete($file_to_delete);
                    }
                }

                if ($car->thumbnail != null) {
                    $thumbnail = str_replace("storage", "public", $car->thumbnail);

                    Storage::delete($thumbnail);
                }

                $car->delete();
            } else {
                return redirect()->back()->with("error", "Only the admin(s) or manager(s) can delete cars.");
            }
        } else {
            return redirect('login');
        }
    }

    public function showChangePasswordForm()
    {
        if (Auth::check()) {
            return view('adminpage.settings.changepassword');
        } else {
            return redirect('/login');
        }
    }

    public function ChangePassword(Request $request)
    {

        if (Auth::check()) {
            if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
                // The passwords matches
                return redirect()->back()->with("error", "Your current password does not match with the password you provided. Please try again.");
            }
            if (strcmp($request->get('current-password'), $request->get('new-password')) == 0) {
                //Current password and new password are same
                return redirect()->back()->with("error", "New Password cannot be same as your current password. Please choose a different password.");
            }
            $validatedData = $request->validate([
                'current-password' => 'required',
                'new-password' => 'required|string|min:6|confirmed',
            ]);
            //Change Password
            $user = Auth::user();
            $user->password = bcrypt($request->get('new-password'));
            $user->save();
            return redirect()->back()->with("success", "Password changed successfully !");
        } else {
            return redirect('/login');
        }
    }

    public function FrontPageInfoEditor()
    {
        if (Auth::check()) {
            $user = User::find(Auth::id());

            if ($user->role == 'Admin' or $user->role == 'Manager') {
                return view('adminpage.settings.frontpageinfo');
            } else {
                return redirect()->back()->with("error", "Only the admin(s) or manager(s) can edit the public info.");
            }
        } else {
            return redirect('/login');
        }
    }

    public function FrontPageInfoSubmit(Request $request)
    {
        if (Auth::check()) {
            if (count(FrontPageInfo::all()) == 0) {
                $info = new FrontPageInfo;
                $info->name = $request->input('name');

                if ($request->file('frontimages') != null) {

                    $frontimagesnames = [];

                    foreach ($request->file('frontimages') as $image) {
                        $image->store('public');
                        $fronturl = Storage::url($image->hashName());
                        array_push($frontimagesnames, $fronturl);
                    }

                    $info->frontimages = serialize($frontimagesnames);
                }


                $info->frontdescription = $request->input('frontdescription');

                if ($request->file('aboutimages') != null) {

                    $aboutimagesnames = [];

                    foreach ($request->file('aboutimages') as $aboutimage) {
                        $aboutimage->store('public');
                        $abouturl = Storage::url($aboutimage->hashName());
                        array_push($aboutimagesnames, $abouturl);
                    }

                    $info->aboutimages = serialize($aboutimagesnames);
                }


                $info->aboutdescription = $request->input('aboutdescription');

                $info->contactemail = $request->input('contactemail');
                $info->contactphone = $request->input('contactphone');
                $info->contactaddress = $request->input('contactaddress');

                $info->Main = 'yes';


                $info->save();
                return redirect()->back()->with("success", "Aight");
            } else {
                $info = FrontPageInfo::where('Main', 'yes')->first();

                if ($info->frontimages != null) {
                    foreach (unserialize($info->frontimages) as $photo) {
                        $file_to_delete = str_replace("storage", "public", $photo);

                        Storage::delete($file_to_delete);
                    }
                }

                if ($info->aboutimages != null) {
                    foreach (unserialize($info->aboutimages) as $photo) {
                        $file_to_delete = str_replace("storage", "public", $photo);

                        Storage::delete($file_to_delete);
                    }
                }

                $info->name = $request->input('name');

                if ($request->file('frontimages') != null) {
                    $frontimagesnames = [];

                    foreach ($request->file('frontimages') as $image) {
                        $image->store('public');
                        $fronturl = Storage::url($image->hashName());
                        array_push($frontimagesnames, $fronturl);
                    }

                    $info->frontimages = serialize($frontimagesnames);
                }

                $info->frontdescription = $request->input('frontdescription');

                if ($request->file('aboutimages') != null) {

                    $aboutimagesnames = [];

                    foreach ($request->file('aboutimages') as $aboutimage) {
                        $aboutimage->store('public');
                        $abouturl = Storage::url($aboutimage->hashName());
                        array_push($aboutimagesnames, $abouturl);
                    }

                    $info->aboutimages = serialize($aboutimagesnames);
                }
                $info->aboutdescription = $request->input('aboutdescription');

                $info->contactemail = $request->input('contactemail');
                $info->contactphone = $request->input('contactphone');
                $info->contactaddress = $request->input('contactaddress');

                $info->save();
                return redirect()->back()->with("success", "Aight");
            }
        } else {
            return redirect('/login');
        }
    }

    public function CreateUser()
    {
        if (Auth::check()) {
            $user = User::find(Auth::id());

            if ($user->role == 'Admin') {
                return view('adminpage.settings.createuser');
            } else {
                return redirect()->back()->with("error", "Only the admin(s) can create users.");
            }
        } else {
            return redirect('/login');
        }
    }

    public function CreateUserNew(Request $newuser)
    {
        if (Auth::check()) {
            $this->validate($newuser, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'role' => 'required'
            ]);

            User::create([
                'name' => $newuser->name,
                'email' => $newuser->email,
                'password' => Hash::make($newuser->password),
                'role' => $newuser->role,
            ]);

            return redirect()->back()->with("success", "User created successfully!");
        } else {
            return redirect('/login');
        }
    }

    public function ViewUsers()
    {
        if (Auth::check()) {
            $user = User::find(Auth::id());

            if ($user->role == 'Admin' or $user->role == 'Manager') {
                $users = User::all();

                return view('adminpage.settings.viewusers')->with('users', $users);
            } else {
                return redirect()->back()->with("error", "Only the admin(s) or manager(s) can view the users.");
            }
        } else {
            return redirect('/login');
        }
    }

    public function RemoveUser($id)
    {
        if (Auth::check()) {
            $user = User::find($id);
            if (Auth::id() == $user->id) {
                return redirect()->back()->with("error", "Cannot delete yourself!");
            } else {
                $user->forceDelete();
                return redirect()->back()->with("success", "User removed successfully!");
            }
        } else {
            return redirect('/login');
        }
    }

    public function SellCar($id)
    {
        if (Auth::check()) {
            $car = CarProduct::where('id', $id)->first();

            return view('adminpage.cars.sellcar')->with('car', $car);
        } else {
            return redirect('/login');
        }
    }

    public function SellCarPDF(Request $car)
    {
        if (Auth::check()) {

            $userAdmin = User::where('role', 'Admin');
            $userManager = User::where('role', 'Manager');
            if (Hash::check($car->adminpassword, $userAdmin->password)) {
                /*return [
                    $car->carid,
                    $car->firstname,
                    $car->middlename,
                    $car->lastname,
                    $car->street,
                    $car->zipcode,
                    $car->city,
                    $car->state,
                    $car->phone,
                    $car->email,
                    $car->dateofsale,
                    $car->timeofsale,
                    $car->carname,
                    $car->vin,
                    $car->carprice,
                    $car->govfees,
                    $car->dealerservice,
                    $car->servicecontract,
                    $car->salestax,
                    $car->totalprice,
                    $car->salesrep,
                ];*/

                $info = FrontPageInfo::where('Main', 'yes');
                $pdf = PDF::loadView('adminpage.cars.invoice', compact('info', 'car'))->setOption('disable-smart-shrinking', true)->setOption('viewport-size', '999');
                //return view( 'adminpage.cars.invoice');



                $caritem = CarProduct::where('id', $car->carid)->first();


                if ($caritem->photos != null) {
                    foreach (unserialize($caritem->photos) as $photo) {
                        $file_to_delete = str_replace("storage", "public", $photo);

                        Storage::delete($file_to_delete);
                    }
                }

                if ($caritem->thumbnail != null) {
                    $thumbnail = str_replace("storage", "public", $caritem->thumbnail);

                    Storage::delete($thumbnail);
                }

                $caritem->delete();

                return $pdf->stream();
            }else if( Hash::check($car->adminpassword, $userManager->password)){

                $info = FrontPageInfo::where('Main', 'yes');
                $pdf = PDF::loadView('adminpage.cars.invoice', compact('info', 'car'))->setOption('disable-smart-shrinking', true)->setOption('viewport-size', '999');
                //return view( 'adminpage.cars.invoice');



                $caritem = CarProduct::where('id', $car->carid)->first();


                if ($caritem->photos != null) {
                    foreach (unserialize($caritem->photos) as $photo) {
                        $file_to_delete = str_replace("storage", "public", $photo);

                        Storage::delete($file_to_delete);
                    }
                }

                if ($caritem->thumbnail != null) {
                    $thumbnail = str_replace("storage", "public", $caritem->thumbnail);

                    Storage::delete($thumbnail);
                }

                $caritem->delete();

                return $pdf->stream();

            } 
            else {
                return redirect()->back()->with("error", "Admin password entered incorrectly!");
            }
        } else {
            return redirect('/login');
        }
    }
}