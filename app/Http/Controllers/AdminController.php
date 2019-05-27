<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CarProduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Hash;
use App\FrontpageInfo;
use Str;
use PDF;
use App\User;
use App\Invoices;


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
            $cars = CarProduct::all();

            return view('adminpage.admin')->with('cars', $cars);
    }

    public function AdminCars()
    {
            $cars = CarProduct::paginate(20);

            return view('adminpage.cars.CarManager')->with('cars', $cars);
    }

    public function AdminCarAdder()
    {
            $user = User::find(Auth::id());

            if ($user->role == 'Admin' or $user->role == 'Manager') {
                return view('adminpage.cars.CarField');
            } else {
                return redirect()->back()->with("error", "Only the admin(s) or manager(s) can add cars.");
            }
    }

    public function AdminNewCar(Request $newcar)
    {

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

            return redirect('/admin/cars')->with('success', 'Car created successfully!');
    }

    public function AdminCarEditor($id)
    {


            $user = User::find(Auth::id());

            if ($user->role == 'Admin' or $user->role == 'Manager') {
                $car = CarProduct::where('id', $id)->first();

                return view('adminpage.cars.CarEditorField')->with('car', $car);
            } else {
                return redirect()->back()->with("error", "Only the admin(s) or manager(s) can edit cars.");
            }
    }

    public function AdminCarPublishEdit($id, Request $oldcar)
    {

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

            return redirect('/admin/cars')->with('success', 'Car successfully edited!');
    }

    public function AdminCarRemover($id)
    {

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

                return redirect()->back()->with("success", "Car sucessfully deleted!");
            } else {
                return redirect()->back()->with("error", "Only the admin(s) or manager(s) can delete cars.");
            }
        
    }

    public function showChangePasswordForm()
    {
            return view('adminpage.settings.changepassword');
        
    }

    public function ChangePassword(Request $request)
    {

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
    }

    public function FrontPageInfoEditor()
    {
            $user = User::find(Auth::id());

            if ($user->role == 'Admin' or $user->role == 'Manager') {
                return view('adminpage.settings.frontpageinfo');
            } else {
                return redirect()->back()->with("error", "Only the admin(s) or manager(s) can edit the public info.");
            }
    }

    public function FrontPageInfoSubmit(Request $request)
    {
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
                return redirect()->back()->with("success", "Public Info sucessfully updated!");
            }
    }

    public function CreateUser()
    {
            $user = User::find(Auth::id());

            if ($user->role == 'Admin') {
                return view('adminpage.settings.createuser');
            } else {
                return redirect()->back()->with("error", "Only the admin(s) can create users.");
            }
    }

    public function CreateUserNew(Request $newuser)
    {
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
    }

    public function ViewUsers()
    {
            $user = User::find(Auth::id());

            if ($user->role == 'Admin' or $user->role == 'Manager') {
                $users = User::paginate(20);

                return view('adminpage.settings.viewusers')->with('users', $users);
            } else {
                return redirect()->back()->with("error", "Only the admin(s) or manager(s) can view the users.");
            }
    }

    public function RemoveUser($id)
    {
            $user = User::find($id);
            if (Auth::id() == $user->id) {
                return redirect()->back()->with("error", "Cannot delete yourself!");
            } else {
                $user->forceDelete();
                return redirect()->back()->with("success", "User removed successfully!");
            }
    }

    public function SellCar($id)
    {
            $car = CarProduct::where('id', $id)->first();

            return view('adminpage.cars.sellcar')->with('car', $car);
    }

    public function SellCarPDF(Request $car)
    {
            if (Hash::check($car->adminpassword, User::find(Auth::id())->password)) {
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
                $info = FrontPageInfo::where('Main', 'yes')->first();
                $caritem = CarProduct::where('id', $car->carid)->first();
                $pdf = PDF::loadView('adminpage.cars.invoice', compact('info', 'car'))->setOption('disable-smart-shrinking', true)->setOption('viewport-size', '999');
                //return view( 'adminpage.cars.invoice');

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

                $invoice = new Invoices;

                $invoice->sellername = $car->salesrep;

                $invoice->selleremail = User::find(Auth::id())->email;

                $invoice->buyername = $car->firstname . " " . $car->middlename . " " . $car->lastname;

                $invoice->buyeremail = $car->email;

                $invoice->carname = $car->carname;

                $invoice->vin = $car->vin;

                $invoice->price = $car->totalprice;

                $invoice->carid = $car->carid;

                date_default_timezone_set("America/New_York");

                $randint = rand(1, 10);

                $pdfname = date("m.d.y.H.i.s") . $car->firstname . $car->middlename . $car->lastname . $car->salesrep . $car->carname . $car->vin . $randint . '.pdf';

                $pdfname = preg_replace('/\s+/', '', $pdfname);

                $pdfpath = Storage::url('app\invoices/' . date("m.d.y.H.i.s") . $car->firstname . $car->middlename . $car->lastname . $car->salesrep . $car->carname . $car->vin . $randint . '.pdf');

                $pdfpath = preg_replace('/\s+/', '', $pdfpath);

                $pdf->save(storage_path('app\invoices/'.$pdfname));

                $invoice->pdf = $pdfpath;

                $invoice->save();

                return $pdf->stream();
            } else {
                return redirect()->back()->with("error", "Password entered incorrectly!");
            }
    }

    public function RandomCars()
    {
        $i = 0;

        while ($i < 30) {
            $car = new CarProduct;

            $car->carname = Str::random(5);
            $car->price = '$'.rand(1000, 500000);
            $car->vin = Str::random(17);
            $car->description = Str::random(5);
            $car->model = Str::random(5);
            $car->make = Str::random(5);
            $car->year = rand(1000, 9999);
            $car->manufacturer = Str::random(5);
            $car->type = Str::random(5);
            $car->engine = Str::random(5);
            $car->transmission = Str::random(5);
            $car->body = Str::random(5);
            $car->miles = Str::random(5);
            $car->fueltype = Str::random(5);
            $car->interiorcolor = Str::random(5);
            $car->exteriorcolor = Str::random(5);
            $car->drivetrain = Str::random(5);
            $car->steeringlocation = Str::random(5);

            $car->save();

            $i++;
        }

        return redirect()->back()->with("success", "Cars everywhere.");
    }

    public function InvoicesList(){
        $invoices = Invoices::paginate(20);

        return view('adminpage.settings.invoices')->with('invoices', $invoices);
    }

    public function InvoiceView($id){

        $invoice = Invoices::where('id', $id)->first();
        
        return response()->download(base_path($invoice->pdf), null, [], null);

        //return response()->download( 'C:\laragon\www\CarProject\storage\app\invoices\05.22.19.14.39.22AliNasrHussainAdminRyhEcmFqlWRZDsaKMPYetk3.pdf', null, [], null);

    }
}