<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Notifications\addFriend;

class userController extends Controller
{
    public function openSettings(){
        return view('users.settings.index');
    }

    public function editNotifications(){
        return view('users.settings.notifications');
    }

    public function notifications(){
        return view('users.notifications');
    }

    public function language(){
        return view('users.settings.language');
    }
    public function action($req_id , $sender_id,$action){
        try {
            if($action=="confirm"){

                DB::table('user_friends')->where(['user_id'=>$sender_id ,'user_friend'=>Auth::user()->id])
                ->update(['status'=>0]);
                toastr()->success("You are now a friends" , "Request Action");
            }
            elseif ($action =="cancel") {
                 DB::table('user_friends')->where(['user_id'=>$sender_id ,'user_friend'=>Auth::user()->id])
                ->delete();
                toastr()->info("The friend request is cancelled" , "Request Action");
            }
            DB::table('notifications')->where('id',$req_id)->delete();
            return back();
        } catch (\Throwable $th) {
             DB::rollback();
             toastr()->success("Something went wrong" , "Request Action");
             return back();
        }
    }
     

    public function password(){
        return view('users.settings.password');
    }
    
    public function changePassword(Request $request){
        $this->validate($request,[
            'current_password'=>'required',
            'password'=>'required|confirmed',
        ]);
        $user = User::where("id" ,Auth::user()->id)->first();
        if(!Hash::check($request->current_password , $user->password)){
            return back()->with('current_password',"Current password is invalid !");
        }
        $user->password =  Hash::make($request->password);
        if($user->update()){
            toastr()->success('Password has been updated successfully!',"Change Password");
            return back();
        }


        
        return view('users.settings.language');
    }

    public function friends(){
        $friends = DB::select("select * from `users`
                     where `users`.id in
                     (select `f`.user_id from `user_friends` as `f` where `f`.user_friend =".Auth::user()->id.") 
                     or `users`.id in 
                     (select `f`.user_friend from `user_friends` as `f` where `f`.user_id =".Auth::user()->id.")" );
        return view('friends.all',['friends'=>$friends]);
    }

     public function addFriend($id){
        $check = DB::table('user_friends')->where(['user_id'=>Auth::user()->id ,'user_friend'=>$id ])
                    ->orWhere(['user_id'=>$id],['user_friend'=>Auth::user()->id])
                    ->first();
        if ($check) {
             toastr()->warning('there is a request between you. ',"Add Friend");
            return back();
        }
        $added = DB::table('user_friends')->insert([
            'user_id'=>Auth::user()->id,
            'user_friend'=>$id,
            'status'=>1
        ]);
        if($added){
            $user = User::find($id);           
            $user->notify(new addFriend(Auth::user()->id,Auth::user()->first_name));
             toastr()->success('Request has been sent successfully!',"Add Friend");
            return back();
        }
        return view('friends.add');
    }
    
    public function chats(){
        return view('chats.all');
    }
    public function chat($id){
        return view('chats.chat');
    }

    // open profile form
    public function editProfile(){
        $deps = DB::table('departments')->get();
        $uFavs = DB::table('department_user')->where('user_id', Auth::user()->id)
        ->select('department_id')->get();
        $userFavs=[];
        foreach ($uFavs as $fav) {
            $userFavs[]=$fav->department_id;
        }
        return view('users.settings.profile.edit',['deps'=>$deps , 'userFavs'=>json_encode($userFavs)]);
    }

    public function updateProfile(Request $request){
        $this->validate($request , [
            'firstname'         => 'required|string|max:255',
            'lastname'          => 'required|string|max:255',
            'country'           => 'required|exists:countries,id',
            'city'              => 'required|exists:cities,id',
            'email'             => 'required|string|email|max:255',
            'phone'             => 'required',
            'position'          => 'required',
            'birth'             => 'required|date|date_format:Y-m-d',
            'description'       => 'required',
        ]);

        try {
            $imgUrl = Auth::user()->image;
            if(!empty($request->image)){
                    if(Auth::user()->image != "/img/avatars/male.png" && Auth::user()->gender=="male" || Auth::user()->image != "/img/avatars/female.png" && Auth::user()->gender=="female" ){
                        unlink(public_path() .Auth::user()->image);
                    }
                    $image      = $request->file('image');
                    $imgName    = $image->getClientOriginalName();
                    $image->move(public_path('/img/avatars/') ,$imgName);
                    $imgUrl     = '/img/avatars/'.$imgName;
             }
        
        $updated = DB::table('users')->where('id' ,Auth::user()->id)
        ->update([
            'first_name'    => $request->firstname,
            'last_name'     => $request->lastname,
            'email'         => $request->email,
            'city_id'       => $request->city,
            'phone'         => $request->phone,
            'image'         => $imgUrl,
            'description'   => $request->description,
            'position'      => $request->position,
            'date_of_barth' => $request->birth,
            'completed'   => 1,
            ]);
            
            if($updated){
                if(!empty($request->favs)){
                        $data =[];
                        foreach ($request->favs as $fav) {
                            $data[] = ['department_id'=>$fav ,'user_id'=>Auth::user()->id];
                        }
                        DB::table('department_user')->where('user_id',Auth::user()->id)->delete();
                        $done = DB::table('department_user')->insert($data);
                        if($done){
                            toastr()->success("Your Data updated successfully !" ,'Update Profile');
                            return back();
                        }else {
                            toastr()->error("Something went wrong !" ,'Update Profile');
                            return back();
                        }
                    }
            }else {
                toastr()->error("Something went wrong !" ,'Update Profile');
                return back();
            }
        } catch (\Throwable $th) {
            DB::rollback();
            toastr()->error("Something went wrong !" ,'Update Profile');
            return back();
        }
        
    }


    public function profile($userId){
        return view('users.profile');
    }

    public function showUsers(){
        
        $users = DB::select("SELECT * FROM `users`
         where `id` NOT IN 
         (select `user_friend` from `user_friends`
          where `user_id`= ".Auth::user()->id ." AND status !=0)
          and `id` != ".Auth::user()->id);

        return view('friends.add',['users'=>$users]);    
    }


}
