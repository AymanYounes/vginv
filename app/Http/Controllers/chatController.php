<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\User;
class chatController extends Controller
{
    public function messages($friend_id){
        if($friend_id == Auth::user()->id){
            toastr()->warning("You can't message your self !" , "Invalid User");
            return back();
        }
        $isfriend = DB::table('user_friends')->where(['user_friend'=>$friend_id ,'user_id'=>Auth::user()->id])
        ->orWhere(['user_friend'=>Auth::user()->id] ,['user_id'=>$friend_id])->first();
        
        if(!$isfriend){
            toastr()->error("This user isn't in your friends list." , "Invalid User");
            return back();
        }
        $friend = DB::table('users')->where('id',$friend_id)->first();
        $updateStatus = DB::table('user_chats')->where(['resever_id'=>Auth::user()->id,'sender_id'=>$friend_id])
        ->update(['status'=>1]);
        $messages = DB::select("select * from `user_chats` where (`sender_id` = ".Auth::user()->id." and `resever_id` =".$friend_id.")
         or (`resever_id` = ".Auth::user()->id ." and `sender_id` =".$friend_id.")");
        return view('chats.chat' ,['messages'=>$messages,'friend'=>$friend]);
    }

    public function message(Request $request){
        $this->validate($request ,[
                'friend_id'=>'required',
                'message'=>'required'
            ]);
        $isFriend = DB::table('user_friends')->where('user_id',Auth::user()->id)->where("user_friend", $request->friend_id)->first();
        if(!$isFriend){
            toastr()->error("this user isn't in your friends list" , "Invalid User");
            return back();
        }
        $added = DB::table('user_chats')->insert([
            'sender_id'  =>Auth::user()->id,
            'resever_id' =>$request->friend_id,
            'message'    =>$request->message,
            'created_at'    =>date('y-m-d H:i:s' ,time())
        ]);
        if ($added) {
            $user = User::find($request->friend_id);
            return response()->json(['status'=>'sent','message'=>['content'=>$request->message,'time'=>date('y-m-d H:i:s' ,time())]]);
        }
        
          toastr()->error("Your Message is failed to send" , "Message Failure");

        return response()->json(['status'=>'failed']);

    }

    public function unreadMessages($friend_id){
        $messages = DB::table('user_chats')->where(['sender_id'=>$friend_id,'resever_id'=>Auth::user()->id,'status'=>0])->get();
        $updateStatus = DB::table('user_chats')->where(['sender_id'=>$friend_id,'resever_id'=>Auth::user()->id,'status'=>0])
                        ->update(['status'=>1]);
        return response()->json(['status'=>'found' ,'messages'=>$messages]);
    }


    public function Groupmessages(){
        $messages = DB::table("group_chat")
                        ->join('users','users.id' ,'=','group_chat.sender_id')
                        ->select('users.first_name','users.last_name','users.image','group_chat.*')
                        ->get();
        $updateStatus = DB::table('group_chat')->update(['status'=>1]);
        return view('chats.group',['messages'=>$messages]);
    }

    public function GroupMessage(Request $request){
        $this->validate($request,[
            'message'=>'required'
        ]);
        $added = DB::table('group_chat')->insert([
            'sender_id'  => Auth::user()->id,
            'message'    => $request->message,
            'created_at' => date('y-m-d H:i:s' ,time())
        ]);
        if ($added) {
            return response()->json(['status'=>'sent']);
        }
    }

    public function unreadGroupMessages(){
        $messages = DB::table("group_chat")
                        ->join('users','users.id' ,'=','group_chat.sender_id')
                        ->where('group_chat.status',0)->where('group_chat.sender_id','<>',Auth::user()->id)
                        ->get();
                        // dd($messages);
        if(count($messages)>0){
            $updateStatus = DB::table('group_chat')->update(['status'=>1]);
            return response()->json(['status'=>'found','messages'=>$messages]);
        }
        
        return response()->json(['status'=>'failed']);
    
    }

    public function GroupFile(Request $request){
        return response()->json($request->file('file')->getClientOriginalExtension());
    }
}
