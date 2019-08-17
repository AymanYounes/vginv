@extends('layout.master')
@section('styles')
    
@endsection


@section('content')

<section>
    <div class="container">
<div class="row">

   <div class="col-lg-6 col-md-6 offset-md-3 mt-3 pt-3 paddl-r">
       <p class="font-weight-bold text-center styleheader "> @lang('main.settings.settings')</p>
       <div class="central-meta">
           <div class="frnds">
               <ul class="nav nav-tabs text-center">
      
                </ul>

               <!-- Tab panes -->
               <div class="tab-content">
                 <div class="tab-pane active fade show" id="frends">
                   <ul class="nearby-contct">
                   <li>
                       <div class="nearly-pepls">
                           <figure>
                               <a href="#" title=""><i class="fas fa-user"></i></a>
                           </figure>
                           <div class="pepl-info">
                               <h4><a href="{{URL::asset('/user/settings/profile/edit')}}" title="" class="font-weight-bold font-setting text-dark">@lang('main.settings.editProfile') </a></h4>
                      
              
                           </div>
                           <!-- <i class=""></i> -->
                           <div class="circule2 ml-3">
                           <a href="{{URL::asset('/user/settings/profile/edit')}}"> 
                            <i class="fas fa-angle-right icon-contact"></i>
                        </a>
                           </div>
                       </div>
                   </li>
                   <li>
                       <div class="nearly-pepls">
                           <figure>
                               <a href="#" title=""><i class="fas fa-unlock-alt"></i></a>
                           </figure>
                           <div class="pepl-info">
                            <h4><a href="{{URL::asset('/user/settings/password')}}" title="" class="font-weight-bold font-setting text-dark"> @lang('main.settings.password') </a></h4>
                      
              
                           </div>
                           <!-- <i class=""></i> -->
                           <div class="circule2 ml-3">
                            <a href="{{URL::asset('/user/settings/password')}}"> 
                             <i class="fas fa-angle-right icon-contact"></i>
                         </a>
                            </div>
                       </div>
                   </li>
                   <li>
                       <div class="nearly-pepls">
                           <figure>
                               <a href="#" title=""><i class="fas fa-bell"></i></a>
                           </figure>
                           <div class="pepl-info">
                            <h4><a href="{{URL::asset('/user/settings/notifications')}}" title="" class="font-weight-bold font-setting text-dark">@lang('main.settings.notify')   </a></h4>
                      
              
                           </div>
                           <!-- <i class=""></i> -->
                           <div class="circule2 ml-3">
                            <a href="{{URL::asset('/user/settings/notifications')}}"> 
                             <i class="fas fa-angle-right icon-contact"></i>
                         </a>
                            </div>
                       </div>
                   </li>
                   <li>
                       <div class="nearly-pepls">
                           <figure>
                               <a href="#" title=""><i class="fas fa-globe-americas"></i></a>
                           </figure>
                           <div class="pepl-info">
                            <h4><a href="{{URL::asset('/user/settings/language')}}" title="" class="font-weight-bold font-setting text-dark">@lang('main.settings.lang')   </a></h4>
                      
                           </div>
                           <!-- <i class=""></i> -->
                           <div class="circule2 ml-3">
                            <a href="{{URL::asset('/user/settings/language')}}"> 
                             <i class="fas fa-angle-right icon-contact"></i>
                         </a>
                            </div>
                       </div>
                   </li>
              
                   
               </ul>
                   <!-- <div class="lodmore"><button class="btn-view btn-load-more"> 
                       <i class="fas fa-redo-alt" style="    color: rgba(74, 105, 255,100%);"></i></button></div>
               -->
              
                </div>
             
               </div>
           </div>
       </div>	
   </div>
</div>
    </div>
</section>


@section('scripts')

@endsection
@endsection
