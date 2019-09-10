<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use PHPMailer\PHPMailer\PHPMailer as sendMail;
use PHPMailer\PHPMailer\Exception;

Route::get("/mail",function(){
        $mail = new sendMail(true);

        try {
            //Server settings
            $mail->IsSMTP(); // telling the class to use SMTP
            $mail->SMTPAuth = true; // enable SMTP authentication
            //$mail->SMTPSecure = "ssl"; // sets the prefix to the servier
            $mail->Host = "mail.akwanmedia-erp.com"; // sets GMAIL as the SMTP server
            $mail->Port = 587; // set the SMTP port for the GMAIL server
            $mail->Username = "sendmail@akwanmedia-erp.com"; // GMAIL username
            $mail->Password = "B!*v!+bkKkxq"; // GMAIL password
            $mail->SMTPAutoTLS = false;
           $mail->SMTPSecure = false;                                  // TCP port to connect to
        
            //Recipients
            $mail->setFrom('support@vginv.com', 'Vginv');
            $mail->addAddress('e.mamdouh3@gmail.com', 'Eslam Mamdouh');     // Add a recipient
    
           
            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'VGINV';
            $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
            $mail->send();
            echo 'Message has been sent';
            die();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
});
Route::get('lang/{locale}', 'LocalizationController@index');

// Authentication Routes...
Route::get('/login', [
    'as' => 'login',
    'uses' => 'Auth\LoginController@showLoginForm'
  ]);
  Route::post('/login', [
    'as' => '',
    'uses' => 'Auth\LoginController@login'
  ]);
  Route::get('logout', [
    'as' => 'logout',
    'uses' => 'Auth\LoginController@logout'
  ]);

   // Registration Routes...
   Route::get('/user/{id}/register', [
    'as' => 'register',
    'uses' => 'Auth\RegisterController@showForm'
  ]);
  Route::post('/user/{id}/register', [
    'as' => '',
    'uses' => 'Auth\RegisterController@signup'
  ]);

  // Password Reset Routes...
Route::post('password/email', [
  'as' => 'password.email',
  'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail'
]);
Route::get('password/reset', [
  'as' => 'password.request',
  'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm'
]);
Route::post('password/reset', [
  'as' => 'password.update',
  'uses' => 'Auth\ResetPasswordController@reset'
]);
Route::get('password/reset/{token}', [
  'as' => 'password.reset',
  'uses' => 'Auth\ResetPasswordController@showResetForm'
]);
  


  /////////////////////////// middleware that requires login ///////////////////

Route::get('/user/settings/profile/edit', 'userController@editProfile')->middleware("auth");
Route::post('/user/settings/profile/update', 'userController@updateProfile')->middleware("auth");
Route::get('/projects/{id}/assets/download', 'projectController@download');

Route::group(['middleware' => ['auth','profile']], function () {

                //////////////// User ///////////////////

    Route::get('/user/settings', 'userController@openSettings');
    Route::get('/type/toggle', 'userController@type');
    Route::get('/user/{id}/profile/', 'userController@profile');
    Route::get('/myProfile/', 'userController@myProfile');
    Route::get('/user/settings/password', 'userController@password');
    Route::get('/user/settings/language', 'userController@language');
    Route::get('/user/settings/notifications', 'userController@editNotifications');
    Route::get('/user/notifications', 'userController@notifications');
    Route::post('/user/settings/password', 'userController@changePassword');
    Route::get('/user/friends', 'userController@friends');
    Route::get('/user/friends/{id}/add', 'userController@addFriend');
    Route::get('/user/friends/add/', 'userController@showUsers');
    Route::get('/user/chats/', 'userController@chats');
    Route::get('/vg/condition/', 'userController@condition');
    Route::get('/request/{req_id}/{sender_id}/{action}', 'userController@action');

    //////////////////////// Chat /////////////////
    Route::get('/user/chats/{friend_id}/', 'chatController@messages');
    Route::post('/user/chats/send/message', 'chatController@message');
    Route::get('/user/chats/{friend_id}/unread', 'chatController@unreadMessages');
    Route::get('/user/chats/', 'chatController@lastMessages');
    Route::get('/group/chat', 'chatController@Groupmessages');
    Route::post('/group/chat/send/message', 'chatController@GroupMessage');
    Route::post('/group/chat/send/file', 'chatController@GroupFile');
    Route::post('/single/chat/send/file', 'chatController@chatFile');
    Route::get('/group/chat/unread', 'chatController@unreadGroupMessages');


    //////////////////////// Chat /////////////////
                //////////////// User /////////////////////


                //////////////// Projects /////////////////////
    Route::post('/user/add/project','projectController@add');
    Route::get('/projects/{id}','projectController@show');
    Route::post('/project/add/comment','projectController@addComment');
    Route::post('/project/{id}/like','projectController@like');
    Route::post('/project/invest','projectController@invest');
    Route::get('/projects/dep/all','projectController@all');
    Route::get('/projects/dep/{id}','projectController@depProjects');

                //////////////// Projects /////////////////////

                //////////////// Posts /////////////////////
    Route::get('/posts/all','postController@all');
    Route::get('/posts/{id}','postController@show');
    Route::post('/posts/add/comment','postController@addComment');

                //////////////// Posts /////////////////////



    Route::get('/', 'HomeController@index');
    Route::get('/home', 'HomeController@index');
    Route::post('/poll/{QId}/answer', 'HomeController@poll');

});

/////////////////////////// middleware that requires login ///////////////////
Route::get('/departments', 'projectController@departments');
Route::get('/countries', 'countryController@countries');
Route::get('/countries/{id}/cities', 'countryController@cities');
Route::get('/cities/{id}/country', 'countryController@country');
Route::post('/users/from/{type}','Auth\RegisterController@signupFromOut');



