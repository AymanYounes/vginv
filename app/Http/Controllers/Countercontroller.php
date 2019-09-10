<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Countercontroller extends Controller
{
    //
    public function index (){
        $counter=DB::table('users_data')
        ->join("users" ,'users.email','=','users_data.email')
        ->where(["users.completed"=>1,'users_data.approved'=>1])
        ->Sum('users_data.capital');
        return $counter;
    }
}
