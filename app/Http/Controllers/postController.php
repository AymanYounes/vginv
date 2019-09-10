<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
class postController extends Controller
{
    public function all(){
        $posts = DB::select('SELECT posts.* , (SELECT COUNT(id) FROM post_comments
                     WHERE post_comments.post_id = posts.id) AS comments
                     FROM posts');
                    //  dd($posts);
        return view('posts.all' , ['posts'=>$posts]);
    }


    public function show($id){


        $post = DB::table('posts')->where("id", $id)->first();
        if(!$post){
            toastr()->error("This Post doesn't exist !","Show Post");
            return back();
        }
        $comments = DB::table('post_comments')
                        ->join('users' , 'post_comments.user_id','=','users.id')
                        ->select('users.first_name as ufirst','users.last_name as ulast','users.id as uid','users.image as uimage','post_comments.comment','post_comments.id as cid','post_comments.created_at')
                        ->where('post_id',$id)->get();
        // dd($comments);
        return view('posts.post',['post'=>$post , 'comments'=>$comments]);

    }

    public function addComment(Request $request){
        $this->validate($request ,[
            'comment'=>'required',
            'post_id'=>'required'
        ]);
        
        $comment =[
            'post_id'   =>$request->post_id,
            'user_id'   =>Auth::user()->id,
            'comment'   =>$request->comment,
            'created_at'=>date('y-m-d H:i:s' ,time()),
            'updated_at'=>date('y-m-d H:i:s' ,time())
        ];
        $added = DB::table('post_comments')->insert($comment);

            return response()->json(['status'=>"added",'comment'=>$comment]);
        }
        
}
