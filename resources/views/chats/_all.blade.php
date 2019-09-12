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

                <!-- Tab panes -->
                <div class="tab-content">
                  <div class="tab-pane active fade show" id="frends">
                    <ul class="nearby-contct">
                        @foreach($users as $user)
                            <li>
                                <div class="nearly-pepls">
                                    <figure>
                                        <a href="{{URL::asset('/user/'.$user->id.'/profile')}}" title=""><img src="{{URL::asset($user->image)}}" alt="" width="70px" height="70px"></a>
                                    </figure>
                                    <div class="pepl-info">
                                        <h4><a href="{{URL::asset('/user/'.$user->id.'/profile')}}" title="" class="font-weight-bold">{{$user->first_name . " ".$user->last_name}}</a></h4>
                                        <p>{{$user->position}}</p>
                        
                                    </div>
                                    <div class="circule ml-3">
                                        <a href="{{URL::asset('/user/chats/'.$user->id)}}">
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



@endsection

@section('scripts')

@endsection
