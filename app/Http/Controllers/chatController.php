<?php

namespace App\Http\Controllers;

use App\UserChat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\User;
class chatController extends Controller
{
    public function messages($friend_id){
        // dd(Auth::user()->id);
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
        $conv_id = DB::table("conversations")->where(['sender_id'=>$friend_id ,'receiver_id'=>Auth::user()->id])
        ->orWhere(['sender_id'=>Auth::user()->id] ,['receiver_id'=>$friend_id])->first();
        $friend = DB::table('users')->where('id',$friend_id)->first();
        $updateStatus = DB::table('user_chats')->where(['resever_id'=>Auth::user()->id,'sender_id'=>$friend_id])
        ->update(['status'=>1]);
        $messages = DB::select("select * from `user_chats` where (`sender_id` = ".Auth::user()->id." and `resever_id` =".$friend_id.")
         or (`resever_id` = ".Auth::user()->id ." and `sender_id` =".$friend_id.")");

        return view('chats.chat' ,['messages'=>$messages,'friend'=>$friend,'conv_id'=>$conv_id]);
    }

    public function message(Request $request){
        $this->validate($request ,[
            'friend_id'=>'required',
            'message'=>'required'
        ]);
        $isFriend = DB::table('user_friends')->where(['user_friend'=>$request->friend_id ,'user_id'=>Auth::user()->id])
                        ->orWhere(['user_friend'=>Auth::user()->id] ,['user_id'=>$request->friend_id])->first();
            if(!$isFriend){
                toastr()->error("this user isn't in your friends list" , "Invalid User");
                return back();
            }
            $added = DB::table('user_chats')->insert([
                'sender_id'  =>Auth::user()->id,
                'resever_id' =>$request->friend_id,
                'message'    =>$request->message,
                'conv_id'    =>$request->conv_id,
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
                        ->where('users.type' , session()->get('type'))
                        ->select('users.first_name','users.last_name','users.image','group_chat.*')
                        ->orderBy('group_chat.created_at' , 'asc')
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
                        ->where('users.type' , session()->get('type'))
                        ->where('group_chat.status',0)->where('group_chat.sender_id','<>',Auth::user()->id)
                        ->select('users.first_name as fname','users.last_name as lname','users.image','group_chat.message','group_chat.type')
                        ->get();
                        // dd($messages);
        if(count($messages)>0){
            $updateStatus = DB::table('group_chat')->update(['status'=>1]);
            return response()->json(['status'=>'found','messages'=>$messages]);
        }
        
        return response()->json(['status'=>'failed']);
    
    }

    public function GroupFile(Request $request){
        $file = $request->file('file');
        $type  = explode('/' , $file->getMimeType())[0];
        // return response()->json($type);
        if ($type == "audio") {   
            $fileName = Auth::user()->first_name.'-'.time().'.wav';
        }else {
            $fileName = $file->getClientOriginalName();
        }
        $file->move(public_path('/chat/attachments/group/') ,$fileName);
        $fileUrl = '/chat/attachments/group/'.$fileName;

        $added = DB::table('group_chat')->insert([
            'sender_id'  => Auth::user()->id,
            'message'    => $fileUrl,
            'type'       => $type,
            'created_at' => date('y-m-d H:i:s' ,time())
        ]);
        if ($added){
            return response()->json(['status'=>'sent' , 'type'=>$type ,'url'=>$fileUrl]);
        }
    }

    public function chatFile(Request $request){
        $file = $request->file('file');
        $type  = explode('/' , $file->getMimeType())[0];
        // dd($type);
        if ($type == "audio") {   
            $fileName = Auth::user()->first_name.'-'.time().'.wav';
        }else {
            $fileName = $file->getClientOriginalName();
        }
        $file->move(public_path('/chat/attachments/single/') ,$fileName);
        $fileUrl = '/chat/attachments/single/'.$fileName;
    
        
        $added = DB::table('user_chats')->insert([
            'sender_id'  => Auth::user()->id,
            'resever_id' => $request->friend_id,
            'message'    => $fileUrl,
            'type'       => $type,
            'created_at' => date('y-m-d H:i:s' ,time()),
            'updated_at' => date('y-m-d H:i:s' ,time())
        ]);
        if ($added){
            return response()->json(['status'=>'sent' , 'type'=>$type ,'url'=>$fileUrl]);
        }
    }

    public function lastMessages(){
        $type = session()->get("type");
        $users = DB::select('select * from conversations inner join users 
                    on users.id = conversations.sender_id or users.id = conversations.receiver_id 
                    where users.id !='.'"'.Auth::user()->id.'"'.' and users.type = '.'"'.$type.'"');

        return view('chats.all',['users'=>$users]);    
    }


    public function deleteMessage($message_id){

        UserChat::find($message_id)->delete();
        return response()->json([
            'status' => 'success'
        ]);
    }
}

