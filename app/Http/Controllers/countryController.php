<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class countryController extends Controller
{
    public function countries(){
        $countries = DB::table('countries')->get();
        return response()->json($countries);
    }

    public function cities($country_id){
        $cities = DB::table('cities')->where('country_id',$country_id)->get();
        return response()->json($cities);
    }

    public function country($city_id){
        $country = DB::table('countries')
        ->join('cities' , 'cities.country_id','=','countries.id')
        ->where('cities.id' , $city_id)->first();
        return response()->json($country);
    }

    
}
