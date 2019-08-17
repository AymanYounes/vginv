<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
class postController extends Controller
{
    public function all(){
        return view('posts.all');
    }


    public function post(){
        return view('posts.post');
    }
}
