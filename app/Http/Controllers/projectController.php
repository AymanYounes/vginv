<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Notification;
use App\Notifications\projectComment;
use Auth;
use Illuminate\Support\Facades\Validator;
use Zipper;
use App\User;
class projectController extends Controller
{

    public function add(Request $request){

        $validator = Validator::make($request->all(), [
            'title'=>"required",
            'provider'=>"required",
            'investment'=>"required",
            'budget'=>"required",
            'images.*'=>"required|image|mimes:jpeg,jpg,webp,png,svg|max:10000",
            'studies.*'=>"required|mimes:docx,pdf,xls,txt",
            'country' => 'required|exists:countries,id',
            'city' => 'required|exists:cities,id',
            'category'=>"required",
            'description'=>"required",
            'category'=>"required",
        ]);

        if ($validator->fails()) {
            foreach($validator->messages() as $message){
                echo $message;
            }
//            dd($validator);
            return redirect('/')
                ->withErrors($validator)
                ->withInput();
        }

//        dd($request->all());

//        $this->validate($request , [
//            'title'=>"required",
//            'investment'=>"required",
//            'budget'=>"required",
//            'images.*'=>"required|image|mimes:jpeg,jpg,png,svg|max:10000",
//            'studies.*'=>"required|mimes:docx,pdf,xls,txt",
//            'country' => 'required|exists:countries,id',
//            'city' => 'required|exists:cities,id',
//            'category'=>"required",
//            'description'=>"required",
//            'category'=>"required",
//        ]);
        

        // try{
        $period = '';
        if($request->period){
            $period = $request->period;
        }

            $project_id = DB::table("projects")->insertGetId([
                'title'=>$request->title,
                'provider'=>$request->provider,
                'description'=>$request->description,
                'location'=>$request->city,
                'dep_id'=>$request->category,
                'budget'=>$request->budget,
                'investment'=>$request->investment,
                'type' => session('type'),
                'period' => $period,
                'created_at'=> date('y-m-d H:i:s' ,time()),
                'updated_at'=> date('y-m-d H:i:s' ,time()),
                'auth'=>Auth::user()->id
            ]);

            if($project_id){
                // dd($project_id);
                $assets=[];
                foreach ($request->file('images') as $image) {
                    $imgName    = $image->getClientOriginalName();
                    $image->move(public_path('/projects/'.$request->title.'/') ,$imgName);
                    $imgUrl     = '/projects/'.$request->title.'/'.$imgName;
                    $assets[] = ['path'=>$imgUrl ,'type'=>0,'project_id'=>$project_id, 'created_at'=>date('y-m-d H:i:s' ,time()), 'updated_at'=>date('y-m-d H:i:s' ,time())];
                }


                foreach ($request->file('studies') as $study) {
                    $fileName    = $study->getClientOriginalName();
                    $study->move(public_path('/projects/'.$request->title.'/') ,$fileName);
                    $fileUrl     = '/projects/'.$request->title.'/'.$fileName;
                    $assets[] = ['path'=>$fileUrl ,'type'=>1,'project_id'=>$project_id, 'created_at'=>date('y-m-d H:i:s' ,time()), 'updated_at'=>date('y-m-d H:i:s' ,time())];
                }
                    $done = DB::table('asset_projects')->insert($assets);
                    if($done){
                        DB::table('projects')->where('id',$project_id)->update(['image'=>$assets[0]['path']]);
                        DB::table('invest_projects')->insert([
                            'user_id'   => Auth::user()->id,
                            'project_id'=> $project_id,
                            'total_invest'=> $request->investment,
                            'created_at'=> date('y-m-d H:i:s' ,time()),
                            'updated_at'=> date('y-m-d H:i:s' ,time()),
                        ]);
                        toastr()->success("Your project added successfully",'Add Project' );
                        return back();
                    }
            }else{
                toastr()->error("Something went wrong !",'Add Project' );
                return back();
            }

        // }catch (\Throwable $th) {
        //     DB::rollback();
        //     toastr()->error("Something went wrong !",'Add Project' );
        //     return back();
        // }
    }


    public function show($id){


        $project = DB::select("select `projects`.*,
                    (SELECT SUM(`invest_projects`.total_invest) from `invest_projects`
                    where `invest_projects`.`project_id` = ".$id.") AS `totalInvest`,
                    (SELECT COUNT(id) FROM like_projects WHERE like_projects.project_id =".$id.") as likes
                    from `projects` where `projects`.`id` =".$id)[0];
        $assets = DB::table("asset_projects")->where('project_id',$id)->get();
        if(!$project){
            toastr()->error("This Project doesn't exist !","Show Project");
            return back();
        }
        $comments = DB::table('comment_projects')
                        ->join('users' , 'comment_projects.user_id','=','users.id')
                        ->select('users.first_name as ufirst','users.last_name as ulast','users.id as uid','users.image as uimage','comment_projects.comment','comment_projects.id as cid','comment_projects.created_at')
                        ->where('project_id',$id)->get();
        // dd($comments);
        return view('projects.project',['project'=>$project,'assets'=>$assets,'comments'=>$comments]);

    }

    public function download($project_id){
        try {
            
            $project = DB::table('projects')->where('id',$project_id)->first();
            $assets = public_path().'/Assets.zip';
            
            $projectFiles = glob(public_path().'/projects/'.$project->title.'/*');
            Zipper::make($assets)->add($projectFiles)->close();
            $zipName = 'Assets-'.date('y-m-d H:i:s' ,time()).'.zip';
            
            return response()->download($assets , $zipName)->deleteFileAfterSend(true);
        } catch (\Throwable $th) {
            toastr()->error("Something went wrong ! " , "Download Assets");
            return back();
        }

    }

    public function departments(){
        $departments = DB::table('departments')->get();
        if($departments){
            return response()->json($departments);
        }
    }

    public function addComment(Request $request){
        $this->validate($request ,[
            'comment'=>'required',
            'project_id'=>'required'
        ]);
        
        $comment =[
            'project_id'=>$request->project_id,
            'user_id'   =>Auth::user()->id,
            'comment'   =>$request->comment,
            'created_at'=>date('y-m-d H:i:s' ,time()),
            'updated_at'=>date('y-m-d H:i:s' ,time())
        ];
        $added = DB::table('comment_projects')->insert($comment);

        if($added){
            $users_ids = DB::select('SELECT `user_id` FROM `invest_projects` 
                            WHERE `user_id` != '.Auth::user()->id.' AND `project_id`='.$request->project_id);
            $ids=[];
            foreach ($users_ids as $item) {
                $ids[]= $item->user_id;
            }
            
            $investedUsers = User::whereIn('id' ,$ids)->get();
            Notification::send($investedUsers ,new projectComment(Auth::user()->id,Auth::user()->first_name,$request->project_id));
            return response()->json(['status'=>"added",'comment'=>$comment]);
        }
        
    }

    public function like($id){

        $check = DB::table("like_projects")->where(['user_id'=>Auth::user()->id,'project_id'=>$id])->first();
        if($check){
            return response()->json(['status'=>"found"]);            
        }
        $liked = DB::table('like_projects')->insert([
            'project_id' => $id,
            'user_id'   => Auth::user()->id,
            'created_at'=>date('y-m-d H:i:s' ,time()),
            'updated_at'=>date('y-m-d H:i:s' ,time())
        ]);

        if($liked){
            return response()->json(['status'=>"done"]);
        }
    }

    public function invest(Request $request){

        $check = DB::table('invest_projects')
                    ->where(['project_id'=>$request->project_id ,'user_id'=>Auth::user()->id])
                    ->first();
        if($check){
            return response()->json(['status'=>'exists']);
        }

        $this->validate($request , [
            'project_id' => 'required',
            'amount'     => 'required'
        ]);

        $invested = DB::table("invest_projects")->insert([
            'user_id'   => Auth::user()->id,
            'project_id'=> $request->project_id,
            'total_invest' => $request->amount,
            'created_at'=>date('y-m-d H:i:s' ,time()),
            'updated_at'=>date('y-m-d H:i:s' ,time())
        ]);
        
        if($invested){            
            return response()->json(['status'=>'done']);
        }
            return response()->json(['status'=>'fail']);

    }

    public function all(){
        $departments = DB::table('departments')->get();
        $status = Input::get('status');

        if(!session()->get('type')){
            session()->put('type',Auth::user()->type);
        }
        $type = session()->get('type');

        if($status != '') {
            $status_sql = 'AND `status` ='.'"'.$status.'"';
        }else{
            $status_sql = '';
        }
        $projects = DB::select('SELECT projects.* , (SELECT COUNT(id) FROM comment_projects
                     WHERE comment_projects.project_id = projects.id) AS comments,
                     (SELECT COUNT(id) FROM like_projects WHERE like_projects.project_id = projects.id) AS likes
                     FROM projects 
                     WHERE `approved` = "1" 
                     AND `type` = ' . '"' . $type . '" '.$status_sql.' 
                     order by `created_at` DESC' );


        return view('projects.departments',['status'=> $status,'departments'=>$departments,'projects'=>$projects]);
    }

    public function depProjects($id){

        $status = Input::get('status');
        $departments = DB::table('departments')->get();
        $type = session()->get('type');
        if($status != '') {
            $status_sql = 'AND `status` ='.'"'.$status.'"';
        }else{
            $status_sql = '';
        }
            $projects = DB::select('SELECT projects.* , (SELECT COUNT(id) FROM comment_projects
                     WHERE comment_projects.project_id = projects.id) AS comments,
                     (SELECT COUNT(id) FROM like_projects WHERE like_projects.project_id = projects.id) AS likes
                     FROM projects 
                     WHERE `approved` = "1" 
                     AND `type` = '.'"'.$type.'" 
                     AND `dep_id` = '.'"'.$id.'"'. $status_sql.' 
                     order by `created_at` DESC');


        return view('projects.departments',['department_id'=> $id,'status'=> $status,'departments'=>$departments,'projects'=>$projects]);
    }
}
