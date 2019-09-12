<?php

namespace App\Http\Controllers;

use App\UserChat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Notifications\addFriend;

class userController extends Controller
{

    public function type(){
        $type = session()->get('type');
        if($type == "vg"){
            session()->put('type',"hmg");
        }else {
            session()->put('type',"vg");            
        }

        return redirect('/');
    }



    public function getUserAddress(){

        $address = DB::table('countries')
            ->join('cities','countries.id','=','cities.country_id')
            ->where('cities.id',Auth::user()->city_id)->first();


        return $address;
    }



    public function myProfile(){
        $type = session()->get('type');

        $address = $this->getUserAddress();

        $projects = DB::select('SELECT projects.* , (SELECT COUNT(id) FROM comment_projects
                     WHERE comment_projects.project_id = projects.id) AS comments,
                     (SELECT COUNT(id) FROM like_projects WHERE like_projects.project_id = projects.id) AS likes
                     FROM projects 
                        INNER JOIN `invest_projects` ON invest_projects.project_id = projects.id
                      WHERE projects.approved = "1" AND projects.type = '.'"'.$type.'" AND invest_projects.user_id = '.'"'.Auth::user()->id.'"');
       $total_investments = DB::table('invest_projects')
                            ->where('user_id',Auth::user()->id)->sum('total_invest');
       $favs = DB::table('departments')
                ->join('department_user' , 'departments.id','=','department_user.department_id')
                ->where('department_user.user_id',Auth::user()->id)
                ->select('departments.dep_en' , 'departments.dep_ar')->get();
       return view('users.profile',['address'=>$address,'projects'=>$projects,'favs'=>$favs,'total_investments'=>$total_investments]);
    }

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
        $type = session()->get('type');
        $friends = DB::select('select * from `users`
                     where `users`.type = '.'"'.$type.'"'.'
                     AND `users`.id in
                     (select `f`.user_id from `user_friends` as `f` where `f`.user_friend ='.Auth::user()->id.') 
                     or `users`.id in 
                     (select `f`.user_friend from `user_friends` as `f` where `f`.user_id ='.Auth::user()->id.')' );
        return view('friends.all',['friends'=>$friends]);
    }

     public function addFriend($id){
        $check = DB::table('user_friends')->where(['user_id'=>Auth::user()->id ,'user_friend'=>$id ])
                    ->orWhere(['user_id'=>$id],['user_friend'=>Auth::user()->id])
                    ->where('status',0)
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

        $type = session()->get('type');
        $users = UserChat::where('sender_id', Auth::user()->id)
            ->orWhere('resever_id', Auth::user()->id)
            ->get();

        $usersArr = [];
        foreach($users as $user){

            $user_status_id = '';

            if($user->sender_id == Auth::user()->id){
                if(!array_key_exists($user->resever_id,$usersArr)){
                    $user_status = 'resever_id';
                }else{
                    $user_status = '';
                }
            }else{
                if(!array_key_exists($user->sender_id,$usersArr)){
                    $user_status = 'sender_id';
                }else{
                    $user_status = '';
                }
            }

            if($user_status != ''){
                $user_info = User::find($user->$user_status);
                if($user_status == 'sender_id') {
                    $auth_status = 'resever_id';
                }else {
                    $auth_status = 'sender_id';
                }

                $user_id = $user_info->id;
                $user_message = UserChat::where($user_status, $user_id)
                    ->where($auth_status, Auth::user()->id)
                    ->orderBy('id', 'DESC')
                    ->first();
//dd($user_message,$user_id);
                $usersArr[$user->$user_status]['info'] = $user_info;
                $usersArr[$user->$user_status]['last_message'] = $user_message;
                $usersArr[$user->$user_status]['read'] = $user_message->status;
                $usersArr[$user->$user_status]['status'] = $user_status;
                $usersArr[$user->$user_status]['lastUpdated'] = $user_message->created_at;
            }


        }


        //sort array


        usort($usersArr, function ($a, $b) {
            return $a['lastUpdated'] <=> $b['lastUpdated'];
        });

        $usersArr = array_reverse($usersArr);
//dd($usersArr);

        return view('chats.all',['users'=>$usersArr]);
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


        $address = $this->getUserAddress();

        return view('users.settings.profile.edit',['address'=>$address ,'deps'=>$deps , 'userFavs'=>json_encode($userFavs)]);
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
        

        $data = [
            'first_name'    => $request->firstname,
            'last_name'     => $request->lastname,
            'email'         => $request->email,
            'city_id'       => $request->city,
            'phone'         => $request->phone,
            'image'         => $imgUrl,
            'description'   => $request->description,
            'position'      => $request->position,
            'date_of_barth' => $request->birth,
            'completed'     => 1,
        ];

        $updated = DB::table('users')->where('id' ,Auth::user()->id)
        ->update($data);
            
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
                toastr()->info("You don't make any changes !" ,'Update Profile');
                return back();
            }
        } catch (\Throwable $th) {
            DB::rollback();
            toastr()->error("Something went wrong !" ,'Update Profile');
            return back();
        }
        
    }


    public function profile($userId){
        $user = DB::table('users')->where('id', $userId)->first();
        $type = session()->get('type');
        $address = DB::table('countries')
                    ->join('cities','countries.id','=','cities.country_id')
                    ->where('cities.id',$user->city_id)->first();

        $projects = DB::select('SELECT projects.* , (SELECT COUNT(id) FROM comment_projects
                     WHERE comment_projects.project_id = projects.id) AS comments,
                     (SELECT COUNT(id) FROM like_projects WHERE like_projects.project_id = projects.id) AS likes
                     FROM projects 
                        INNER JOIN `invest_projects` ON invest_projects.project_id = projects.id
                      WHERE projects.approved = "1" AND projects.type = '.'"'.$type.'" AND invest_projects.user_id = '.'"'.$userId.'"');
       
        $total_investments = DB::table('invest_projects')
                            ->where('user_id',$userId)->sum('total_invest');
       
        $favs = DB::table('departments')
                ->join('department_user' , 'departments.id','=','department_user.department_id')
                ->where('department_user.user_id',$userId)
                ->select('departments.dep_en' , 'departments.dep_ar')->get();
                
       return view('users.userProfile',['user'=>$user,'address'=>$address,'projects'=>$projects,'favs'=>$favs,'total_investments'=>$total_investments]);        

    }

    public function showUsers(){
        $type = session()->get("type");
        $condition="";
        if($type == "vg"){
            $condition ='`type`="vg" OR (`type`="hmg" and `condition`=1)';
        }else {
            $condition = '`type`="hmg"';
        }
        $users = DB::select('SELECT * FROM `users`
         where `completed` = 1 and '.$condition.'  
         AND `id` NOT IN 
         (select `user_friend` from `user_friends`
          where  `user_id`= '.Auth::user()->id .' AND `status` !=0)
          and `id` != '.Auth::user()->id);

        return view('friends.add',['users'=>$users]);    
    }


    public function condition(){
        $updated = DB::table('users')->where("id", Auth::user()->id)
                    ->update(['condition'=>1]);
        if($updated){
            return redirect('/type/toggle');
        }
    }


}
