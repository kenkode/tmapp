<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/login/{success}', function ($success) {
	$success = "Successfully registered organization! Please wait for confirmation from the admin";
    return view('auth.login',compact('success'));
});

Route::post('/create','Auth\RegisterController@create');

Auth::routes();

Route::get('/', function () {
	if(Auth::user() && Auth::user()->status == 1){
	if(Auth::user()->type == 'Travel'){
	$bookings = App\Booking::where('organization_id',Auth::user()->organization_id)->count();
    $organization = App\Organization::find(Auth::user()->organization_id);
	$schedules = App\Schedule::where('organization_id',Auth::user()->organization_id)->count();
	$vehicles = App\Vehicle::where('organization_id',Auth::user()->organization_id)->count();
	$destinations = App\Route::where('organization_id',Auth::user()->organization_id)->count();
	$customers = DB::table('bookings')
                     ->select(DB::raw('DISTINCT(CONCAT(firstname, id_number))'))
                     ->where('organization_id',Auth::user()->organization_id)
                     ->count();
    $payments = DB::table('bookings')
                     ->where('organization_id',Auth::user()->organization_id)
                     ->sum('amount');

    return view('travel.dashboard',compact('bookings','organization','schedules','vehicles','destinations','customers','payments'));
	}else if(Auth::user()->type == 'Taxi'){
    $bookings = App\Booking::where('organization_id',Auth::user()->organization_id)->where('status','approved')->count();
    $organization = App\Organization::find(Auth::user()->organization_id);
    $vehicles = App\Vehicle::where('organization_id',Auth::user()->organization_id)->count();
    $destinations = App\Route::where('organization_id',Auth::user()->organization_id)->count();
    $customers = DB::table('bookings')
                     ->select(DB::raw('DISTINCT(CONCAT(firstname, id_number))'))
                     ->where('organization_id',Auth::user()->organization_id)
                     ->count();
    $payments = DB::table('bookings')
                     ->where('organization_id',Auth::user()->organization_id)
                     ->where('status','approved')
                     ->sum('amount');

    return view('taxi.dashboard',compact('bookings','organization','vehicles','destinations','customers','payments'));
    }else if(Auth::user()->type == 'SGR'){
    $bookings = App\Booking::where('organization_id',Auth::user()->organization_id)->where('status','approved')->count();
    $organization = App\Organization::find(Auth::user()->organization_id);
    $trains = App\Vehicle::where('organization_id',Auth::user()->organization_id)->count();
    $destinations = App\Route::where('organization_id',Auth::user()->organization_id)->count();
    $schedules = App\Schedule::where('organization_id',Auth::user()->organization_id)->count();
    $customers = DB::table('bookings')
                     ->select(DB::raw('DISTINCT(CONCAT(firstname, id_number))'))
                     ->where('organization_id',Auth::user()->organization_id)
                     ->count();
    $payments = DB::table('bookings')
                     ->where('organization_id',Auth::user()->organization_id)
                     ->where('status','approved')
                     ->sum('amount');

    return view('sgr.dashboard',compact('bookings','organization','schedules','trains','destinations','customers','payments'));
    }else if(Auth::user()->type == 'Airline'){
    $bookings = App\Booking::where('organization_id',Auth::user()->organization_id)->where('status','approved')->count();
    $organization = App\Organization::find(Auth::user()->organization_id);
    $vehicles = App\Vehicle::where('organization_id',Auth::user()->organization_id)->count();
    $destinations = App\Route::where('organization_id',Auth::user()->organization_id)->count();
    $schedules = App\Schedule::where('organization_id',Auth::user()->organization_id)->count();
    $customers = DB::table('bookings')
                     ->select(DB::raw('DISTINCT(CONCAT(firstname, id_number))'))
                     ->where('organization_id',Auth::user()->organization_id)
                     ->count();
    $payments = DB::table('bookings')
                     ->where('organization_id',Auth::user()->organization_id)
                     ->where('status','approved')
                     ->sum('amount');

    return view('airlines.dashboard',compact('bookings','schedules','organization','vehicles','destinations','customers','payments'));
    }
    }else{
    return view('auth.login');
    }
});

Route::get('/userconfirmation/{name}', 'Auth\RegisterController@confirmation');

Route::group(['middleware'=>'auth'],function(){
Route::get('/dashboard', function () {
	if(Auth::user()->type == 'Travel'){
    $bookings = App\Booking::where('organization_id',Auth::user()->organization_id)->where('status','approved')->count();
    $organization = App\Organization::find(Auth::user()->organization_id);
	$schedules = App\Schedule::where('organization_id',Auth::user()->organization_id)->count();
	$vehicles = App\Vehicle::where('organization_id',Auth::user()->organization_id)->count();
	$destinations = App\Route::where('organization_id',Auth::user()->organization_id)->count();
	$customers = DB::table('bookings')
                     ->select(DB::raw('DISTINCT(CONCAT(firstname, id_number))'))
                     ->where('organization_id',Auth::user()->organization_id)
                     ->count();
    $payments = DB::table('bookings')
                     ->where('organization_id',Auth::user()->organization_id)
                     ->where('status','approved')
                     ->sum('amount');

    return view('travel.dashboard',compact('bookings','organization','schedules','vehicles','destinations','customers','payments'));
	}else if(Auth::user()->type == 'Taxi'){
    $bookings = App\Booking::where('organization_id',Auth::user()->organization_id)->where('status','approved')->count();
    $organization = App\Organization::find(Auth::user()->organization_id);
    $vehicles = App\Vehicle::where('organization_id',Auth::user()->organization_id)->count();
    $destinations = App\Route::where('organization_id',Auth::user()->organization_id)->count();
    $customers = DB::table('bookings')
                     ->select(DB::raw('DISTINCT(CONCAT(firstname, id_number))'))
                     ->where('organization_id',Auth::user()->organization_id)
                     ->count();
    $payments = DB::table('bookings')
                     ->where('organization_id',Auth::user()->organization_id)
                     ->where('status','approved')
                     ->sum('amount');

    return view('taxi.dashboard',compact('bookings','organization','vehicles','destinations','customers','payments'));
    }else if(Auth::user()->type == 'SGR'){
    $bookings = App\Booking::where('organization_id',Auth::user()->organization_id)->where('status','approved')->count();
    $organization = App\Organization::find(Auth::user()->organization_id);
    $trains = App\Vehicle::where('organization_id',Auth::user()->organization_id)->count();
    $destinations = App\Route::where('organization_id',Auth::user()->organization_id)->count();
    $schedules = App\Schedule::where('organization_id',Auth::user()->organization_id)->count();
    $customers = DB::table('bookings')
                     ->select(DB::raw('DISTINCT(CONCAT(firstname, id_number))'))
                     ->where('organization_id',Auth::user()->organization_id)
                     ->count();
    $payments = DB::table('bookings')
                     ->where('organization_id',Auth::user()->organization_id)
                     ->where('status','approved')
                     ->sum('amount');

    return view('sgr.dashboard',compact('bookings','schedules','organization','trains','destinations','customers','payments'));
    }else if(Auth::user()->type == 'Airline'){
    $bookings = App\Booking::where('organization_id',Auth::user()->organization_id)->where('status','approved')->count();
    $organization = App\Organization::find(Auth::user()->organization_id);
    $vehicles = App\Vehicle::where('organization_id',Auth::user()->organization_id)->count();
    $destinations = App\Route::where('organization_id',Auth::user()->organization_id)->count();
    $schedules = App\Schedule::where('organization_id',Auth::user()->organization_id)->count();
    $customers = DB::table('bookings')
                     ->select(DB::raw('DISTINCT(CONCAT(firstname, id_number))'))
                     ->where('organization_id',Auth::user()->organization_id)
                     ->count();
    $payments = DB::table('bookings')
                     ->where('organization_id',Auth::user()->organization_id)
                     ->where('status','approved')
                     ->sum('amount');

    return view('airlines.dashboard',compact('bookings','schedules','organization','vehicles','destinations','customers','payments'));
    }    
});

/*Travel Routes*/

Route::get('vehiclenames', 'VehiclenamesController@index');
Route::get('vehiclenames/showrecord', 'VehiclenamesController@showrecord');
Route::post('vehiclenames/store', 'VehiclenamesController@store');
Route::post('vehiclenames/update', 'VehiclenamesController@update');
Route::post('vehiclenames/delete', 'VehiclenamesController@delete');
Route::post('report/vehiclenames', 'ReportsController@vehiclenames');

Route::get('destinations', 'DestinationsController@index');
Route::get('destinations/showrecord', 'DestinationsController@showrecord');
Route::post('destinations/store', 'DestinationsController@store');
Route::post('destinations/update', 'DestinationsController@update');
Route::post('destinations/delete', 'DestinationsController@delete');
Route::post('report/destinations', 'ReportsController@destinations');

Route::get('vehicles', 'VehicleController@index');
Route::get('vehicles/showrecord', 'VehicleController@showrecord');
Route::post('vehicles/store', 'VehicleController@store');
Route::post('vehicles/update', 'VehicleController@update');
Route::post('vehicles/delete', 'VehicleController@delete');
Route::post('vehicles/deactivate', 'VehicleController@deactivate');
Route::post('vehicles/activate', 'VehicleController@doactivate');
Route::get('vehicles/activate', 'VehicleController@activate');
Route::post('report/vehicles', 'ReportsController@vehicles');

Route::get('schedules', 'SchedulesController@index');
Route::get('schedules/showrecord', 'SchedulesController@showrecord');
Route::post('schedules/store', 'SchedulesController@store');
Route::post('schedules/update', 'SchedulesController@update');
Route::post('schedules/delete', 'SchedulesController@delete');
Route::post('report/schedules', 'ReportsController@schedules');

Route::get('paymentoptions', 'PaymentsController@index');
Route::get('paymentoptions/showrecord', 'PaymentsController@showrecord');
Route::post('paymentoptions/store', 'PaymentsController@store');
Route::post('paymentoptions/update', 'PaymentsController@update');
Route::post('paymentoptions/delete', 'PaymentsController@delete');
Route::post('report/paymentoptions', 'ReportsController@paymentoptions');

Route::get('currencies', 'CurrenciesController@index');
Route::get('currencies/showrecord', 'CurrenciesController@showrecord');
Route::post('currencies/store', 'CurrenciesController@store');
Route::post('currencies/update', 'CurrenciesController@update');
Route::post('currencies/delete', 'CurrenciesController@delete');
Route::post('report/currencies', 'ReportsController@currencies');

Route::get('organizations', 'OrganizationsController@index');
Route::get('organizations/showrecord', 'OrganizationsController@showrecord');
Route::post('organizations/update', 'OrganizationsController@update');
Route::get('report/organization', 'ReportsController@organization');
Route::post('report/payments', 'ReportsController@payments');
Route::get('mails', 'OrganizationsController@mails');
Route::post('mails/update', 'OrganizationsController@mailupdate');
Route::get('mails/showrecord', 'OrganizationsController@mailsettings');

Route::get('profile', 'UsersController@profile');
Route::post('user/update', 'UsersController@update');
Route::post('user/password', 'UsersController@password');
Route::post('user/checkpassword', 'UsersController@checkpassword');

Route::get('bookings', 'BookingsController@index');
Route::post('report/bookings', 'ReportsController@bookings');
Route::get('customers', 'BookingsController@customers');
Route::post('report/customers', 'ReportsController@customers');
Route::get('payments', 'BookingsController@payments');
Route::post('report/payments', 'ReportsController@payments');

Route::get('graphdata', function () {
   $arr = array();
    for ($i=1; $i <= 12; $i++) {   
    $amount = App\Booking::where('organization_id',Auth::user()->organization_id)->where('status','approved')->whereMonth('date', '=', $i)->whereYear('date', '=', date('Y'))->sum('amount');
    array_push($arr, number_format($amount,2));
    }

    echo json_encode($arr);
});

Route::get('reports/test', 'ReportsController@test');
Route::get('reports/excel', 'ReportsController@excel');
});

Route::get('/login/{success}', function ($success) {
    $success = "Successfully registered organization! Please wait for confirmation from the admin";
    return view('auth.login',compact('success'));
});