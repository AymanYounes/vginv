@extends('layout.master')
@section('styles')
<link rel="stylesheet" href="{{secure_asset('/css/media/chats.css')}}">  
<style>
    .action{
        margin-right: 10px;
    }
</style>  
@endsection


@section('content')
    
<!-- messages -->
 <section>
     <div class="container">
<div class="row">

    <div class="col-lg-6 col-md-6 offset-md-3 mt-3 pt-3 paddl-r">
        <p class="font-weight-bold text-center styleheader "> @lang('main.settings.notify')</p>
        <div class="central-meta">
            <div class="frnds">

                <!-- Tab panes -->
                <div class="tab-content">
                  <div class="tab-pane active fade show" id="frends">
                    <ul class="nearby-contct">
                        @foreach (Auth::user()->notifications as $not)
                            @if ($not->type == 'App\Notifications\addFriend')
                                <li>
                                    <div class="nearly-pepls">
                                        <div class="pepl-info">
                                            <p><strong><a href="{{URL::asset('/user/'.$not->data['sender'].'/profile')}}">{{$not->data['sender_name']}}</a></strong>
                                                Sent you a friend request.
                                            </p>
                                            <a class="action" href="{{URL::asset('/request/'.$not->id.'/'.$not->data['sender'].'/confirm')}}">Confirm</a>
                                            <a class="action" href="{{URL::asset('/request/'.$not->id.'/'.$not->data['sender'].'/cancel')}}">Cancel</a>
                                        </div>
                                        <span class="ml-3" style="color: #bdbac2;"> {{(new Carbon\Carbon($not->created_at))->diffForHumans()}}</span>
                                    </div>
                                </li>
                            
                            @elseif ($not->type == 'App\Notifications\projectComment')
                                <li>
                                    <div class="nearly-pepls">
                                        <div class="pepl-info">
                                            <p><strong><a href="{{URL::asset('/user/'.$not->data['sender'].'/profile')}}">{{$not->data['sender_name']}}</a></strong>
                                                <a href="{{URL::asset('/projects/'.$not->data['project_id'])}}" >Add a comment in a project that you invest.</a>
                                            </p>
                                        </div>
                                        <span class="ml-3" style="color: #bdbac2;"> {{(new Carbon\Carbon($not->created_at))->diffForHumans()}}</span>
                                    </div>
                                </li>
                            @endif
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


