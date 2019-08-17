@extends('layout.master')
@section('styles')
<link rel="stylesheet" href="{{URL::asset('/css/chat.css')}}">
<style>
    {{-- .recever .bubble2{
        background: #007bff !important;
    } --}}
    
    .msg-container{
        position: relative;
        margin-bottom: 50px;
    }
    .sender{
        padding: 10px;
        margin-bottom: 30px;
    }
    .msg-time{
        position: absolute;
        margin-top: 10px;
        left: 10px;  
        font-size: 12px;
    }
    .sender .msg-time{
        left: 78%;
        margin-top:17px
    }
    .message{
        background:#f5f5f5; 
        padding: 5px 10px;
        border-radius: 10px;   
        float: left;
        color:#bdbac2;
        margin-left: 10px;
        min-width: 150px;
        max-width: 300px;
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
                                                    <img src="{{URL::asset($friend->image)}}" alt="avatar">
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
                                                            <button type="button" class="dropdown-item"><svg
                                                                    xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24"
                                                                    class="eva eva-video">
                                                                    <g data-name="Layer 2">
                                                                        <g data-name="video">
                                                                            <rect width="24" height="24" opacity="0">
                                                                            </rect>
                                                                            <path
                                                                                d="M21 7.15a1.7 1.7 0 0 0-1.85.3l-2.15 2V8a3 3 0 0 0-3-3H5a3 3 0 0 0-3 3v8a3 3 0 0 0 3 3h9a3 3 0 0 0 3-3v-1.45l2.16 2a1.74 1.74 0 0 0 1.16.45 1.68 1.68 0 0 0 .69-.15 1.6 1.6 0 0 0 1-1.48V8.63A1.6 1.6 0 0 0 21 7.15z">
                                                                            </path>
                                                                        </g>
                                                                    </g>
                                                                </svg>Video call</button>
                                                            <button type="button" class="dropdown-item"><svg
                                                                    xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24"
                                                                    class="eva eva-phone">
                                                                    <g data-name="Layer 2">
                                                                        <g data-name="phone">
                                                                            <rect width="24" height="24" opacity="0">
                                                                            </rect>
                                                                            <path
                                                                                d="M17.4 22A15.42 15.42 0 0 1 2 6.6 4.6 4.6 0 0 1 6.6 2a3.94 3.94 0 0 1 .77.07 3.79 3.79 0 0 1 .72.18 1 1 0 0 1 .65.75l1.37 6a1 1 0 0 1-.26.92c-.13.14-.14.15-1.37.79a9.91 9.91 0 0 0 4.87 4.89c.65-1.24.66-1.25.8-1.38a1 1 0 0 1 .92-.26l6 1.37a1 1 0 0 1 .72.65 4.34 4.34 0 0 1 .19.73 4.77 4.77 0 0 1 .06.76A4.6 4.6 0 0 1 17.4 22z">
                                                                            </path>
                                                                        </g>
                                                                    </g>
                                                                </svg>Voice call</button>
                                                            <button type="button" class="dropdown-item"
                                                                data-toggle="modal" data-target="#compose"><svg
                                                                    xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24"
                                                                    class="eva eva-person-add">
                                                                    <g data-name="Layer 2">
                                                                        <g data-name="person-add">
                                                                            <rect width="24" height="24" opacity="0">
                                                                            </rect>
                                                                            <path
                                                                                d="M21 6h-1V5a1 1 0 0 0-2 0v1h-1a1 1 0 0 0 0 2h1v1a1 1 0 0 0 2 0V8h1a1 1 0 0 0 0-2z">
                                                                            </path>
                                                                            <path
                                                                                d="M10 11a4 4 0 1 0-4-4 4 4 0 0 0 4 4z">
                                                                            </path>
                                                                            <path
                                                                                d="M16 21a1 1 0 0 0 1-1 7 7 0 0 0-14 0 1 1 0 0 0 1 1">
                                                                            </path>
                                                                        </g>
                                                                    </g>
                                                                </svg>Add people</button>
                                                            <button type="button" class="dropdown-item"
                                                                data-utility="open"><svg
                                                                    xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24"
                                                                    class="eva eva-info">
                                                                    <g data-name="Layer 2">
                                                                        <g data-name="info">
                                                                            <rect width="24" height="24"
                                                                                transform="rotate(180 12 12)"
                                                                                opacity="0"></rect>
                                                                            <path
                                                                                d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm1 14a1 1 0 0 1-2 0v-5a1 1 0 0 1 2 0zm-1-7a1 1 0 1 1 1-1 1 1 0 0 1-1 1z">
                                                                            </path>
                                                                        </g>
                                                                    </g>
                                                                </svg>Information</button>
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
                                                        <img id="chatAvatar" width="35px" height="35px" src='{{URL::asset("$message->image")}}' alt="avatar">
                                                   @else
                                                   
                                                        <img width="35px" height="35px" src='{{URL::asset("$message->image")}}' alt="avatar">
                                                        <span>{{$message->first_name." ".$message->last_name}}</span>
                                                   @endif
                                                </div>
                                                <div class="message">
                                                        {{$message->message}}
                                                </div>
                                                <br>
                                                <p class="msg-time" style="color: #bdbac2;"> {{date('j F h:i A',strtotime($message->created_at))}}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="container">
                                            <div class="bottom">
                                                <form id="fmsg">
                                                    @csrf
                                                    <textarea class="form-control form-controls" name="message" id="message" placeholder="Type message..." rows="1"></textarea>
                                                    <button type="submit" class="btn prepend "><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="eva eva-paper-plane"><g data-name="Layer 2"><g data-name="paper-plane"><rect width="24" height="24" opacity="0"></rect><path d="M21 4a1.31 1.31 0 0 0-.06-.27v-.09a1 1 0 0 0-.2-.3 1 1 0 0 0-.29-.19h-.09a.86.86 0 0 0-.31-.15H20a1 1 0 0 0-.3 0l-18 6a1 1 0 0 0 0 1.9l8.53 2.84 2.84 8.53a1 1 0 0 0 1.9 0l6-18A1 1 0 0 0 21 4zm-4.7 2.29l-5.57 5.57L5.16 10zM14 18.84l-1.86-5.57 5.57-5.57z"></path></g></g></svg></button>
                                                </form>
                                                <input id="attach" type="file" style="display:none">
                                                <i id="choose" class="fas fa-paperclip"></i>
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

<script src="{{URL::asset('/js/groupChat.js')}}"></script>
@endsection
@endsection


