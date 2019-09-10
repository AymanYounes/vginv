<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Auth;
use Mail;
use App\Mail\NewCustomer;
use Illuminate\Support\Facades\DB;
use PHPMailer\PHPMailer\PHPMailer as sendMail;
use PHPMailer\PHPMailer\Exception;

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
        
        $penddingUser = DB::table('users_data')->where(['id'=>$user_id])->first();
        if(!$penddingUser && !$penddingUser->approved && !$penddingUser->hmg_approved ){
            return back();
        }
        $user = new User;
        $user->first_name   = $penddingUser->first_name;
        $user->last_name    = $penddingUser->last_name;
        $user->email        = $penddingUser->email;
        $user->phone        = $penddingUser->phone;
        $user->email        = $penddingUser->email;
        $user->type         = $penddingUser->user_type;
        $user->image        = "/img/avatars/male.png";
        $user->password = Hash::make($data->password);
        $user->save();
        Auth::login($user);
        return redirect("/");

    }


    public function signupFromOut(Request $request,$type){
        date_default_timezone_set('Asia/Riyadh');
        $date=date('Y-m-d H:i:s');
        
        // $this->validate($request,[
        //     'FirstName'     =>"required",
        //     'SecondName'    =>"required",
        //     'FamilyName'    =>"required",
        //     'country'       =>"required",
        //     'City'          =>"required",
        //     'email'         =>"required",
        //     'phone'         =>"required",
        // ]);
        
        $quick_deals=null;
        $experience=null;
        if($type == "hmg"){
            $isFound = DB::table('users_data')->where(['phone'=>$request->phone,'approved'=>1])->first();
            if($isFound){
                $updateType = DB::table('users_data')->where(["user_type"=>'vg','phone'=>$request->phone])
                                ->update([
                                    'user_type'     => "hmg",
                                    'quick_deals'   => $request->data['quick_deals'],
                                    'fav_invest'    => $request->data['fav_invest'],
                                    'daterecored'   => $date
                                    ]);
                $emailData=[
                    'الأسم الاول'=>$request->data['first_name'],
                    'الأسم الثاني'=> $request->data['middle_name'],
                    'ألأسم الأخير'=>$request->data['last_name'],
                    'الدولة'=> $request->data['country'] ,
                    'المدينة'=> $request->data['city'] ,
                    'الدرجه العلميه'=> $request->data['education'] ,
                    'البريد الإلكتروني'=> $request->data['email'] ,
                    'رقم الجوال'=> $request->data['phone'] ,
                    'المسمي الوظيفي الحالي'=> $request->data['job_position'] ,
                    'عدد سنوات الخبره'=> $experience,
                    'رأس المال المتوقع للاستثمار'=> $capital,
                    'الخيار المفضل للاستثمار'=> $fav_invest,
                    'كيف تعرفت علينا'=> $know_us,
                    'المجالات المفضله للاستثمار'=> $fav_dep,
                    'الكود'=> $request->data['invite_code'],
                    'فيس بوك'=> $request->data['facebook'],
                    'لينكد ان'=> $request->data['linkedin'],
                    'تويتر'=>  $request->data['twitter'],
                    'انستجرام'=>  $request->data['instagram'],
                    'هل شاركت في صفقات سريعه من قبل' => $request->data['quick_deals']
                ];                    

                $emailContext='<html><body>';
                $emailContext .='<table rules="all" style="border-color: #666;" cellpadding="10">';
                foreach($emailData as $key => $val){
                    //   $emailContext .="<tr><td>".$key."</td><td>".$val."</td></tr>";
                    $emailContext .="<tr style='background: #eee;'><td><strong>".$key." : </strong> </td><td> ".$val."</td></tr>\r\n";
                   }
                $emailContext .='</table></body></html>';
    
                $to = 'e.mamdouh3@gmail.com,mohamed7rabee@gmail.com';
                $from="VGinv info@vginv.com";
                $recipientEmail = $to;
                $emailSubject = "New Customer From ". strtoupper($type);
                $emailHeaders = "Cc: $to " . "\r\n";
                $emailHeaders .= "From: $from \r\n";
                $emailHeaders .= "MIME-Version: 1.0 \r\n";
               $emailHeaders .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    
    
                // mail($recipientEmail, $emailSubject, $emailContext, $emailHeaders);
                $endpoint = "https://vginv.com/mail/index.php";
                $client = new \GuzzleHttp\Client();

                $response = $client->request('get', $endpoint, ['query' => [
                    'mail'      =>  "send", 
                    'subject' => $emailSubject, 
                    'body'   => $$emailContext,
                    'to'    => $to
                ]]);

                $statusCode = $response->getStatusCode();
                
                // send request by Curl to send message to client number
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "https://vginv.com/wbsiteservisphp/towili/sendconvert.php");
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, ['truephonenum'=>$request->data['phone']]);
                $output = curl_exec($ch);
                curl_close($ch);
    
                return response()->json(["status"=>'success']);
                
            }

            $quick_deals = $request->data['quick_deals'];
            $capital     = $request->data['capital'];
            $fav_invest  = $request->data['fav_invest'];
            $know_us     = $request->data['know_us'];
            $fav_dep     = $request->data['fav_dep'];
            $experience  = null;

        }else{
            $quick_deals = null;
            $capital     = $request->data['capital'];
            $fav_invest  = $request->data['fav_invest'];
            $know_us     = $request->data['know_us'];
            $fav_dep     = $request->data['fav_dep'];
            $experience  = $request->data['experience_years'];
        }
        // dd($request);
        $data=[
            'first_name'            => $request->data['first_name'],
            'middle_name'           => $request->data['middle_name'],
            'last_name'             => $request->data['last_name'],
            'country'               => $request->data['country'] ,
            'city'                  => $request->data['city'] ,
            'education'             => $request->data['education'] ,
            'email'                 => $request->data['email'] ,
            'phone'                 => $request->data['phone'] ,
            'job_position'          => $request->data['job_position'] ,
            'experience_years'      => $experience ,
            'quick_deals'           => $quick_deals ,
            'capital'               => $capital ,
            'fav_invest'            => $fav_invest ,
            'know_us'               => $know_us ,
            'fav_dep'               => $fav_dep ,
            'invite_code'           => $request->data['invite_code'] ,
            'facebook'              => $request->data['facebook'] ,
            'linkedin'              => $request->data['linkedin'] ,
            'twitter'               => $request->data['twitter'] ,
            'instagram'             => $request->data['instagram'] ,
            'user_type'             => $type ,
            'daterecored'           =>$date,
        ];

        //dd($data);
        $id = DB::table("users_data")->insertGetId($data);
        if($id){
            
            // Mail::to("mohamed7rabee@gmail.com")->cc("e.mamdouh3@gmail.com")
            //         ->send(new NewCustomer($request->data['first_name'] ." ".$request->data['last_name'],$type));
           
               $emailData=[
                'الأسم الاول'=>$request->data['first_name'],
                'الأسم الثاني'=> $request->data['middle_name'],
                'ألأسم الأخير'=>$request->data['last_name'],
                'الدولة'=> $request->data['country'] ,
                'المدينة'=> $request->data['city'] ,
                'الدرجه العلميه'=> $request->data['education'] ,
                'البريد الإلكتروني'=> $request->data['email'] ,
                'رقم الجوال'=> $request->data['phone'] ,
                'المسمي الوظيفي الحالي'=> $request->data['job_position'] ,
                'عدد سنوات الخبره'=> $experience,
                'رأس المال المتوقع للاستثمار'=> $capital,
                'الخيار المفضل للاستثمار'=> $fav_invest,
                'كيف تعرفت علينا'=> $know_us,
                'المجالات المفضله للاستثمار'=> $fav_dep,
                'الكود'=> $request->data['invite_code'],
                'فيس بوك'=> $request->data['facebook'],
                'لينكد ان'=> $request->data['linkedin'],
                'تويتر'=>  $request->data['twitter'],
                'انستجرام'=>  $request->data['instagram']
                ];
                
                if($type == "hmg"){
                    $emailData['هل شاركت في صفقات سريعه من قبل']= $request->data['quick_deals'];
                }elseif($type == 'stocks'){
                    $emailData["المسمي الوظيفي الحالي"] =$request->data['job_position'];
                    $emailData["هل اسست,شاركت في اعمال تجاريه"]= $request->data['company-option'];
                    $emailData["الغرض من دخولك شريكا مساهما"]= $request->data['purpose'];
                    $emailData["كم عدد الاسهم المرغوبه"]= $request->data['stocks_num'];
                }
                 if($type == "stocks"){
                     
                   $emaildata2=[
                       'الأسم الاول'=>$request->data['first_name'],
                'الأسم الثاني'=> $request->data['middle_name'],
                'ألأسم الأخير'=>$request->data['last_name'],
                'الدولة'=> $request->data['country'] ,
                'المدينة'=> $request->data['city'] ,
                'الدرجه العلميه'=> $request->data['education'] ,
                'البريد الإلكتروني'=> $request->data['email'] ,
                'رقم الجوال'=> $request->data['phone'] ,
                'المسمي الوظيفي الحالي'=> $request->data['job_position'] ,
                'عدد سنوات الخبره'=> $experience,
                'فيس بوك'=> $request->data['facebook'],
                'لينكد ان'=> $request->data['linkedin'],
                'تويتر'=>  $request->data['twitter'],
                'انستجرام'=>  $request->data['instagram']
                       ] ;
                       $emaildata2["هل اسست,شاركت في اعمال تجاريه"]= $request->data['company-option'];
                    $emaildata2["الغرض من دخولك شريكا مساهما"]= $request->data['purpose'];
                    $emaildata2["كم عدد الاسهم المرغوبه"]= $request->data['stocks_num'];
                }
        //   $emailContext="<html><body><table><tr><th>الحقل</th><th>القيمه</th></tr>";
           $emailContext='<html><body>';
            $emailContext .='<table rules="all" style="border-color: #666;" cellpadding="10">';
           if($type == "stocks"){
               foreach($emaildata2 as $key => $val){
                //   $emailContext .="<tr><td>".$key."</td><td>".$val."</td></tr>";
                $emailContext .="<tr style='background: #eee;'><td><strong>".$key." : </strong> </td><td> ".$val."</td></tr>\r\n";
               }
               $emailContext .='</table>';
             $emailContext .="<input checked='checked'  type='checkbox' ><label style='color:red !important;font-size: 18px!important;
    font-weight: 500;' for='checkbox'>
        إن استلامنا لطلبك للحصول علي اسهم تأسيس،لا يعني بالضرورة الموافقة عليه.
         </label>";
           }else{
              
               foreach($emailData as $key => $val){
                //   $emailContext .="<tr><td>".$key."</td><td>".$val."</td></tr>";
                $emailContext .="<tr style='background: #eee;'><td><strong>".$key." : </strong> </td><td> ".$val."</td></tr>\r\n";
               }
                $emailContext .='</table>';
           }
            $emailContext .='</body></html>';
        //   $emailContext .="</table></body></html>";

            $to = 'e.mamdouh3@gmail.com,mohamed7rabee@gmail.com';
            $from="VGinv info@vginv.com";
            $recipientEmail = $to;
            $emailSubject = "New Customer From ". strtoupper($type);
            $emailHeaders = "Cc: $to " . "\r\n";
            $emailHeaders .= "From: $from \r\n";
            $emailHeaders .= "MIME-Version: 1.0 \r\n";
           $emailHeaders .= "Content-Type: text/html; charset=ISO-8859-1\r\n";


            mail($recipientEmail, $emailSubject, $emailContext, $emailHeaders);
            
            // send request by Curl to send message to client number
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://vginv.com/wbsiteservisphp/towili/sendconvert.php");
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, ['truephonenum'=>$request->data['phone']]);
            $output = curl_exec($ch);
            curl_close($ch);

            return response()->json(["status"=>'success']);
        }
        return response()->json(["status"=>'failed']);
    
    }
    
     public function signupFromOutAcc(Request $request , $type){
       
        // 
         $data=[
                'first_name' => $request->data['first_name'],
                'last_name' => $request->data['last_name'],
                'country' => $request->data['country'] ,
                'email'  => $request->data['email'] ,
                'phone'  => $request->data['phone'],
                'type'                  => $type
            ];
             
           
             $id = DB::table("accelators")->insertGetId($data);
            if($id){
                if($type == 'franchise'){
                   //  dd($data);
                     $emailData=[
                'الأسم الاول'=>$request->data['first_name'],
                
               'الاسم الثانى'=> $request->data['last_name'],
                
                'الدولة'=> $request->data['country'] ,
                 'البريد الإلكتروني'=> $request->data['email'] ,
                'رقم الجوال'=> $request->data['phone']
                ];
                
                   $emailContext='<html><body>';
            $emailContext='<table rules="all" style="border-color: #666;" cellpadding="10">';
                   foreach($emailData as $key => $val){
                //   $emailContext .="<tr><td>".$key."</td><td>".$val."</td></tr>";
                $emailContext .="<tr style='background: #eee;'><td><strong>".$key." : </strong> </td><td> ".$val."</td></tr>\r\n";
               }
                    $to = 'Salemgrp@gmail.com,mohamed7rabee@gmail.com';
            $from="VGinvinfo@vginv.com";
            $recipientEmail = $to;
            $emailSubject = "New Customer From ". strtoupper($type);
            $emailHeaders = "Cc: $to " . "\r\n";
            $emailHeaders .= "From: $from \r\n";
            $emailHeaders .= "MIME-Version: 1.0 \r\n";
           $emailHeaders .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
           
            mail($recipientEmail, $emailSubject, $emailContext, $emailHeaders);
                }
             return response()->json(["status"=>'success']);
            }
        return response()->json(["status"=>'failed']);
     }
}
