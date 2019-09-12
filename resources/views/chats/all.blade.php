@extends('layout.master')
@section('styles')
<link rel="stylesheet" href="{{secure_asset('/css/media/chats.css')}}">    
@endsection


@section('content')
    
<!-- messages -->
 <section>
     <div class="container">
<div class="row">

    <div class="col-lg-6 col-md-6 offset-md-3 mt-3 pt-3 paddl-r">
        <p class="font-weight-bold text-center styleheader "> @lang('main.messages')</p>
        <div class="central-meta">
            <div class="frnds">
                <ul class="nav nav-tabs text-center">
                     <!-- <li class="nav-item"><a class="active" href="#frends" data-toggle="tab">My Friends</a> <span>55</span></li> -->
                     <!-- <li class="nav-item text-center"><a class="active font-weight-bold" href="#frends" data-toggle="tab">Add Friend</a></li> -->
                   
                     <!-- <li class="nav-item"><a class="" href="#frends-req" data-toggle="tab">Friend Requests</a><span>60</span></li> -->
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                  <div class="tab-pane active fade show" id="frends">
                    <ul class="nearby-contct">
                        @foreach($users as $user)
                            <li class="{{($user['status'] == 'sender_id' && $user['read'] == 0)?'unread':''}}">
                                <div class="nearly-pepls">
                                    <figure>
                                        <a href="{{URL::asset('/user/'.$user['info']->id.'/profile')}}" title=""><img src="{{URL::asset($user['info']->image)}}" alt="" width="70px" height="70px"></a>
                                    </figure>
                                    <div class="pepl-info">
                                        <h4><a href="{{URL::asset('/user/'.$user['info']->id.'/profile')}}" title="" class="font-weight-bold">{{$user['info']->first_name . " ".$user['info']->last_name}}</a></h4>
                                        {{--<p>{{$user['info']->position}}</p>--}}
                                        @if($user['last_message']->type == 'text')
                                            <p style="margin-bottom: 0;">{{ (strlen($user['last_message']->message)>25)? substr($user['last_message']->message,0,25).'...' : substr($user['last_message']->message,0,25)}}</p>
                                        @elseif($user['last_message']->type == 'voice')
                                            <p>@lang('chat.sentVoice')</p>
                                        @elseif($user['last_message']->type == 'application')
                                            <p>@lang('chat.sentAttachment')</p>
                                        @elseif($user['last_message']->type == 'image')
                                            <p>@lang('chat.sentImage')</p>
                                        @endif
                                        <span class="ml-3" style="color: #bdbac2;float: right"> {{(new Carbon\Carbon($user['last_message']->created_at))->diffForHumans()}}</span>

                                    </div>
                                    <div class="circule ml-3">
                                        <a href="{{URL::asset('/user/chats/'.$user['info']->id)}}">
                                            <i class="fas fa-envelope text-white icon-contact"></i>
                                        </a>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <div class="lodmore"><button class="btn-view btn-load-more"> <i class="fas fa-redo-alt" style="    color: rgba(74, 105, 255,100%);"></i></button></div>
                  </div>
              
                </div>
            </div>
        </div>	
    </div>
</div>
     </div>
 </section>
 <!-- messages -->


@section('scripts')
    
@endsection
@endsection


