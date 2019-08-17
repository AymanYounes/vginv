<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'country' => ['required' ,'exists:countries,id'],
            'city' => ['required', 'exists:cities,id'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'terms' => ['required'],
            'gender' => ['required'],
        ]);
    }

    public function showForm($user_id){

        $user = DB::table('users_data')->where('id',$user_id)->first();
        if(!$user){
            return redirect('/login');
        }elseif($user){
            $check = DB::table("users")->where('email',$user->email)->first();
            if($check){
                toastr()->info("This Account Aleardy exists , You Can login.","Exists User",['timeOut'=>30000]);
                return redirect('/login');            
            }
        }
        toastr()->success("Welcome ".$user->first_name." ".$user->last_name." Please Create your password","Create Password",['timeOut'=>30000]);
        return view('auth.register',['user_id'=>$user_id,'email'=>$user->email]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function signup(Request $data,$user_id)
    {
        $this->validate($data ,[
            'password' => 'required|string|confirmed|min:8',
        ]);
        
        $penddingUser = DB::table('users_data')->where('id',$user_id)->first();
        if(!$penddingUser){
            return back();
        }

        $user = new User;
        $user->first_name   = $penddingUser->first_name;
        $user->last_name    = $penddingUser->last_name;
        $user->email        = $penddingUser->email;
        $user->phone        = $penddingUser->phone;
        $user->email        = $penddingUser->email;
        $user->image        = "/img/avatars/male.png";
        $user->password = Hash::make($data->password);
        $user->save();
        Auth::login($user);
        return redirect("/");

    }


    public function signupFromOut(Request $request,$type){
        
        $this->validate($request,[
            'firstName'     =>"required",
            'secondName'    =>"required",
            'familyName'    =>"required",
            'country'       =>"required",
            'city'          =>"required",
            'email'         =>"required",
            'phone'         =>"required",
        ]);

        if($type == "hmg"){
            $quick_deals = $request->inputState;
            $capital     = $request->inputState1;
            $fav_invest  = $request->inputState2;
            $know_us     = $request->inputState3;
            $fav_dep     = $request->inputState4;
            $experience  = null;

        }else{
            $quick_deals = null;
            $capital     = $request->inputState;
            $fav_invest  = $request->inputState1;
            $know_us     = $request->inputState2;
            $fav_dep     = $request->inputState3;

        }



        $data=[
            'first_name'            => $request->firstName,
            'middle_name'           => $request->secondName,
            'last_name'             => $request->familyName,
            'country'               => $request->country ,
            'city'                  => $request->city ,
            'education'             => $request->Education ,
            'email'                 => $request->email ,
            'phone'                 => $request->phone ,
            'job_position'          => $request->jop ,
            'experience_years'      => $experience ,
            'quick_deals'           => $quick_deals ,
            'capital'               => $capital ,
            'fav_invest'            => $fav_invest ,
            'know_us'               => $know_us ,
            'fav_dep'               => $fav_dep ,
            'invite_code'           => $request->code ,
            'facebook'              => $request->facebook ,
            'linkedin'              => $request->linkedin ,
            'twitter'               => $request->twitter ,
            'instagram'             => $request->instagram ,
            'user_type'             => $type ,
        ];

        $id = DB::table("users_data")->insertGetId($data);
        if($id){
            return response()->json(["status"=>'success']);
        }
    }
}
