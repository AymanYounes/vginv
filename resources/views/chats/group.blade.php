@extends('layout.master')
@section('styles')
<link rel="stylesheet" href="{{secure_asset('/css/chat.css')}}">
<style>
    {{-- .recever .bubble2{
        background: #007bff !important;
    } --}}
    
    .msg-container{
        //position: relative;
        margin-bottom: 5px;
       /* height:180px;*/
    }
    .sender{
        padding: 10px;
        margin-bottom: 0px;
    }
    .msg-time{
        /* position: absolute; */
        margin-top: 0px;
        left: 10px;  
        font-size: 12px;
        margin-left: 2%;
    }
    .sender .msg-time{
        /*left: 78%;*/
    margin-top: 20px;
    margin-left: 80%;
    display: inline-block
    }
    .message{
        background:#f5f5f5; 
        padding: 5px 10px;
        border-radius: 10px;   
       /* float: left;*/
        color:#000;
        margin-left: 10px;
        width: auto;
        margin-top: 5px;
        /* width: fit-content; */
        display: table;
    }
 
    .sender .message{
        background: #007bff; 
        color: #FFF;
        float: right !important;
        margin-top:8px
    }

    .sender .headline{
        text-align:right
    }
    #chatAvatar{
        border-raduis:50% !important;
    }
    .prepend{
        bottom: 5%
    }
</style>
@endsection


@section('content')
    
 <!-- chat -->
    <section class="mt-3">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-12 offset-md-2">
                    <div class="chat">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="chat1" role="tabpanel">
                                <div class="item">
                                    <div class="content">
                                        <div class="container">
                                            <div class="top">
                                                {{--  <div class="headline">
                                                    <img src="{{asset($friend->image)}}" alt="avatar">
                                                    <div class="content">
                                                        <h5>{{$friend->first_name ." ".$friend->last_name}}</h5>
                                                        <span>Away</span>
                                                    </div>
                                                </div>  --}}
                                                <ul>
                                                    <li><button type="button" class="btn" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false"><i
                                                                class="eva-hover"><svg
                                                                    xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24"
                                                                    class="eva eva-more-vertical eva-animation eva-icon-hover-pulse">
                                                                    <g data-name="Layer 2">
                                                                        <g data-name="more-vertical">
                                                                            <rect width="24" height="24"
                                                                                transform="rotate(-90 12 12)"
                                                                                opacity="0"></rect>
                                                                            <circle cx="12" cy="12" r="2"></circle>
                                                                            <circle cx="12" cy="5" r="2"></circle>
                                                                            <circle cx="12" cy="19" r="2"></circle>
                                                                        </g>
                                                                    </g>
                                                                </svg></i></button>
                                                        <div class="dropdown-menu">
                                                            <button type="button" class="dropdown-item choose">
                                                                <i class="choose fas fa-paperclip"></i>Attach File
                                                            </button>
                                                            <button type="button" class="dropdown-item choose">
                                                                <i class="choose fas fa-camera"></i> Image/Video
                                                            </button>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                    </div>
                                    <!-- containt -->
                                    <div id="messages" class="sent">
                                        @foreach ($messages as $message)    
                                            <div class="msg-container @if ($message->sender_id == Auth::user()->id)sender @endif">
                                                <div class="headline" style="margin-left:10px">
                                                   @if($message->sender_id == Auth::user()->id)
                                                        <span>{{$message->first_name." ".$message->last_name}}</span>
                                                        <img id="chatAvatar" width="35px" height="35px" src='{{secure_asset("$message->image")}}' alt="avatar">
                                                   @else
                                                   
                                                        <img width="35px" height="35px" src='{{secure_asset("$message->image")}}' alt="avatar">
                                                        <span>{{$message->first_name." ".$message->last_name}}</span>
                                                   @endif
                                                </div>
                                                @if ($message->type =="text")
                                                    <div class="message">
                                                        {{$message->message}}
                                                    </div>

                                                @elseif ($message->type == "image")
                                                    <div class="message" style="padding:0 !important">
                                                        <img width="150px" height="150px" src="{{secure_asset($message->message)}}">
                                                    </div>   
                                                
                                                @elseif ($message->type == "application")
                                                    <div class="message" style="background:none;padding:0 !important">
                                                        <a href="{{secure_asset($message->message)}}">Attachment</a>
                                                    </div>
                                                    
                                                @elseif ($message->type == "video")
                                                     <div class="message" style="background:none;padding:0 !important">
                                                        <video controls width="250px" height="250px" src="{{secure_asset($message->message)}}">

                                                        </video>
                                                    </div>
                                                @elseif ($message->type == "audio")
                                                    <div class="message" style="background:none;padding:0 !important">
                                                        <audio controls width="250px" height="250px" src="{{secure_asset($message->message)}}"></audio>
                                                    </div>
                                                @endif
                                             
                                                <p class="msg-time mt-2  " style="color: #bdbac2;"> {{date('j F h:i A',strtotime($message->created_at))}}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                    {{-- <div class="container">
                                            <div class="bottom">
                                                <form id="fmsg">
                                                    @csrf
                                                    <textarea class="form-control form-controls" name="message" id="message" placeholder="Type message..." rows="1"></textarea>
                                                    <button type="submit" class="btn prepend "><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="eva eva-paper-plane"><g data-name="Layer 2"><g data-name="paper-plane"><rect width="24" height="24" opacity="0"></rect><path d="M21 4a1.31 1.31 0 0 0-.06-.27v-.09a1 1 0 0 0-.2-.3 1 1 0 0 0-.29-.19h-.09a.86.86 0 0 0-.31-.15H20a1 1 0 0 0-.3 0l-18 6a1 1 0 0 0 0 1.9l8.53 2.84 2.84 8.53a1 1 0 0 0 1.9 0l6-18A1 1 0 0 0 21 4zm-4.7 2.29l-5.57 5.57L5.16 10zM14 18.84l-1.86-5.57 5.57-5.57z"></path></g></g></svg></button>
                                                </form>
                                            </div>
                                            <input id="attach" type="file" name="file" style="display: none">
                                            <i id="recordButton" class="fas fa-microphone"></i>
                                        </div> --}}



                                        <div class="container">
                                        
                                                <div class="row">
                                                     <div class="col-md-10 col-sm-12" style="    padding-right: 0px;
                                                     padding-left: 0px;">
                                                                     <textarea class="form-control form-controls" name="message" id="message" placeholder="Type message..." rows="1"></textarea>
                                                     </div>
                                                      <div class="col-md-2 col-sm-12" style="    padding-right: 0px;
                                                      padding-left: 0px; background: #f5f5f5;">
                                                 <div class="bottom">
                                                     <form id="fmsg">
                                                         @csrf
                                                         <!--<textarea class="form-control form-controls" name="message" id="message" placeholder="Type message..." rows="1"></textarea>-->
                                                        
                                                         <button type="submit" class="btn prepend ">
                                                             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="eva eva-paper-plane"><g data-name="Layer 2"><g data-name="paper-plane"><rect width="24" height="24" opacity="0"></rect><path d="M21 4a1.31 1.31 0 0 0-.06-.27v-.09a1 1 0 0 0-.2-.3 1 1 0 0 0-.29-.19h-.09a.86.86 0 0 0-.31-.15H20a1 1 0 0 0-.3 0l-18 6a1 1 0 0 0 0 1.9l8.53 2.84 2.84 8.53a1 1 0 0 0 1.9 0l6-18A1 1 0 0 0 21 4zm-4.7 2.29l-5.57 5.57L5.16 10zM14 18.84l-1.86-5.57 5.57-5.57z"></path></g></g></svg></button>
                                                   <input id="attach" type="file" name="file" style="display: none">
                                                 <i id="recordButton" class="fas fa-microphone microphonee"></i>
                                                     </form>
                                                 </div>
                                               
                                                 </div>
                                             </div>
                                         </div>
                                    </div>
                                </div>
                            </div>
                        </div>
         
                    </div>
                </div>
            </div>
        </div>
    </section>


@section('scripts')
<script>
$(".sent").scrollTop($(".sent")[0].scrollHeight);
$("html").scrollTop($("html")[0].scrollHeight);
</script>
<script src="{{asset('/js/groupChat.js')}}"></script>
@endsection
@endsection


