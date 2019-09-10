@extends('layout.master')
@section('styles')
   
    
@endsection


@section('content')
    


<!-- friends -->
<section>
    <div class="container">
<div class="row">

   <div class="col-lg-6 col-md-6 offset-md-3 mt-3 pt-3 paddl-r">
       <p class="font-weight-bold text-center styleheader "> @lang('main.friends')</p>
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
                       @foreach ($friends as $friend)  
                            <li>
                                <div class="nearly-pepls">
                                    <figure>
                                        <a href="{{URL::asset('/user/'.$friend->id.'/profile')}}" title=""><img width="70px" height="70px" src="{{asset($friend->image)}}" alt=""></a>
                                    </figure>
                                    <div class="pepl-info">
                                        <h4><a href="{{URL::asset('/user/'.$friend->id.'/profile')}}" title="" class="font-weight-bold">{{$friend->first_name." ".$friend->last_name}}</a></h4>
                                        <p>{{$friend->description}}</p>
                        
                                    </div>
                                    <!-- <i class=""></i> -->
                                    <div class="circule ml-3">
                                    <a href='{{URL::asset("/user/chats/$friend->id")}}'> <i class="fas fa-envelope text-white icon-contact"></i></a>
                                    </div>
                                </div>
                            </li>
                       @endforeach

                    </ul>
                   <div class="lodmore"><button class="btn-view btn-load-more"> <i class="fas fa-redo-alt" style="color: rgba(74, 105, 255,100%);"></i></button></div>
                 </div>
             
               </div>
           </div>
       </div>	
   </div>
</div>
    </div>
</section>
<!-- end friends -->

@section('scripts')
    
@endsection
@endsection


