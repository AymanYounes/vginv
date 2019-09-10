<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        

        if(!session('type')){
            session()->put('type',Auth::user()->type);
        }
        $type = session()->get('type');
        $posts = DB::table("posts")->get();

        $projects = DB::select('SELECT projects.* , (SELECT COUNT(id) FROM comment_projects
                     WHERE comment_projects.project_id = projects.id) AS comments,
                     (SELECT COUNT(id) FROM like_projects WHERE like_projects.project_id = projects.id) AS likes
                     FROM projects WHERE `approved` = "1" AND `type` = '.'"'.$type.'"');
//dd($projects);
        $proposed = DB::select("SELECT * FROM `projects` WHERE `type` ="."'".$type."'"."AND  `dep_id` IN 
                        (SELECT `department_id` FROM `department_user`
                         where `user_id`= ".Auth::user()->id.") LIMIT 3");


        $poll = DB::table('poll_questions') 
                    ->join('poll_question_answers','poll_question_answers.question_id','=','poll_questions.id')
                    ->where('poll_questions.type',$type)
                    ->where('poll_questions.status',1)->get();
        if(count($poll) >0){    
            $pollVotes = DB::select('SELECT `answer_id` , COUNT(`id`) as count , (SELECT COUNT(`id`) FROM `poll_answers` WHERE `question_id`='.'"'. $poll[0]->question_id.'"'.') as total FROM `poll_answers` WHERE `question_id`='.'"'.$poll[0]->question_id.'"'.' GROUP BY `answer_id`');
        }else {
            $pollVotes=null;
        }
        // dd($pollVotes);

        return view('home', [
                'posts'=>$posts ,
                'projects'=>$projects,
                'proposed'=>$proposed,
                'poll'=>$poll ,
                'pollVotes'=>$pollVotes
            ]);
    }

    public function poll(Request $request,$ques_id)
    {
       if (!$request->answer) {
            toastr()->error("Please choose one answer at least.","Poll");
            return back();
       }
        
        $polled = DB::table('poll_answers')->where(['user_id'=>Auth::user()->id,'question_id'=>$ques_id])->first();
        if($polled){
            // dd($polled);
             $id = DB::table('poll_answers')
                ->where([
                    'user_id'=>Auth::user()->id,
                    'question_id'=>$ques_id,
                ])
                ->update([
                    'answer_id'=>$request->answer
                ]);
                if($id){
                    // dd($id);
                toastr()->success("Your Answer is Updated Successfully.","Update Poll");
                return back();
            }
        }
        $id = DB::table('poll_answers')->insertGetId([
            'user_id'=>Auth::user()->id,
            'question_id'=>$ques_id,
            'answer_id'=>$request->answer
        ]);
        if($id){
            toastr()->success("Thanks for your answer","Poll");
            return back();
        }

    }
}
