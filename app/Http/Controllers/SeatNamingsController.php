<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Seatnaming;
use App\Vehicle;
use App\Organization;
use Illuminate\Support\Facades\Auth;

class SeatNamingsController extends Controller
{
    //
    public function index()
    {
    	$organization=Organization::where('id','=',Auth::User()->organization_id)->first();
    	$seats=Seatnaming::where('organization_id','=',Auth::User()->organization_id)->get();
    	$vehicles=Vehicle::where('organization_id','=',Auth::User()->organization_id)->get();
        return view('sgr.seats.index',compact('seats','vehicles','organization'));
    }
    
    public function update(Request $request){
    	$count=Seatnaming::where('vehicle_id',$request->vehicle)->count();
    	//return $request->vip;
    	if($count == 0){
    	for($i=0;$i<$request->capacity;$i++){
        $seat=new Seatnaming;
    	$seat->vehicle_id=$request->vehicle;
    	$seat->seatno="seat ".($i+1);
    	$seat->vip=$request->vip[$i];
    	$seat->economy=$request->normal[$i];
    	$seat->business=0;
    	if($request->apply_to_all != null){
    	$seat->apply_to_all=1;
        }else{
        $seat->apply_to_all=0;
        }
    	$seat->organization_id=Auth::user()->organization_id;
    	$seat->save(); 
        }
    	}else{      
    	$seats=Seatnaming::where('vehicle_id',$request->vehicle)->get();
        for($i=0;$i<count($seats);$i++){
        $seat=$seats[$i];
    	$seat->vip=$request->vip[$i];
    	$seat->economy=$request->normal[$i];
    	if($request->apply != null){
    	$seat->apply_to_all=1;
        }else{
        $seat->apply_to_all=0;
        }
    	$seat->update(); 
        }
        }
    	return 1;
    }
	
}
