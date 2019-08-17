<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Zipper;
class projectController extends Controller
{

    public function add(Request $request){
        $this->validate($request , [
            'title'=>"required",
            'study'=>"required",
            'investment'=>"required",
            'budget'=>"required",
            'images.*'=>"required|image|mimes:jpeg,jpg,png,svg|max:10000",
            'study.*'=>"required|mimes:docx,pdf,xls,txt",
            'country' => 'required|exists:countries,id',
            'city' => 'required|exists:cities,id',
            'category'=>"required",
            'description'=>"required",
            'category'=>"required",
        ]);

        try{

            $project_id = DB::table("projects")->insertGetId([
                'title'=>$request->title,
                'description'=>$request->description,
                'location'=>$request->city,
                'dep_id'=>$request->category,
                'budget'=>$request->budget,
                'investment'=>$request->investment,
                'created_at'=> date('y-m-d H:i:s' ,time()),
                'updated_at'=> date('y-m-d H:i:s' ,time()),
                'auth'=>Auth::user()->id
            ]);

            if($project_id){
                $assets=[];
                foreach ($request->file('images') as $image) {
                    $imgName    = $image->getClientOriginalName();
                    $image->move(public_path('/projects/'.$request->title.'/') ,$imgName);
                    $imgUrl     = '/projects/'.$request->title.'/'.$imgName;
                    $assets[] = ['path'=>$imgUrl ,'type'=>0,'project_id'=>$project_id, 'created_at'=>date('y-m-d H:i:s' ,time()), 'updated_at'=>date('y-m-d H:i:s' ,time())];
                }

                foreach ($request->file('study') as $study) {
                    $fileName    = $study->getClientOriginalName();
                    $study->move(public_path('/projects/'.$request->title.'/') ,$fileName);
                    $fileUrl     = '/projects/'.$request->title.'/'.$fileName;
                    $assets[] = ['path'=>$fileUrl ,'type'=>1,'project_id'=>$project_id, 'created_at'=>date('y-m-d H:i:s' ,time()), 'updated_at'=>date('y-m-d H:i:s' ,time())];
                }
                    $done = DB::table('asset_projects')->insert($assets);
                    if($done){
                        DB::table('projects')->where('project_id',$project_id)->update(['image'=>$assets[0]['path']]);
                        toastr()->success("Your project added successfully",'Add Project' );
                        return back();
                    }
            }else{
                toastr()->error("Something went wrong !",'Add Project' );
                return back();
            }

        }catch (\Throwable $th) {
            DB::rollback();
            toastr()->error("Something went wrong !",'Add Project' );
            return back();
        }
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
}
