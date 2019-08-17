@extends('layout.master')
@section('styles')
<link rel="stylesheet" href="{{URL::asset('/css/media/chats.css')}}">  
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
                                            <p><strong><a href="/user/{{$not->data['sender']}}/profile">{{$not->data['sender_name']}}</a></strong>
                                                Sent you a friend request.
                                            </p>
                                            <a class="action" href="/request/{{$not->id}}/{{$not->data['sender']}}/confirm">Confirm</a>
                                            <a class="action" href="/request/{{$not->id}}/{{$not->data['sender']}}/cancel">Cancel</a>
                                        </div>
                                        <span class="ml-3" style="color: #bdbac2;"> {{date('h:i A',strtotime($not->created_at))}}</span>
                                    </div>
                                </li>
                            @else  
                                <li>
                                    <div class="nearly-pepls">
                                        <div class="pepl-info">
                                            <p>ftv It is a long established fact ftv It is a long established fact </p>
                                        </div>
                                        <span class="ml-3" style="color: #bdbac2;"> 07:30am</span>
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


