@extends('layout.master')
@section('styles')
    <link rel="stylesheet" href="{{URL::asset('/css/notifications.css')}}">
@endsection


@section('content')
    

<section>
    <div class="container">
<div class="row">

   <div class="col-lg-6 col-md-6 offset-md-3 mt-3 pt-3 paddl-r">
       <p class="font-weight-bold text-center styleheader ">@lang('main.settings.editNotify')</p>
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
                           <div class="pepl-info">
                               <h4><a href="#" title="" class="font-weight-bold font-setting text-dark">@lang('main.settings.appNotify')</a></h4>
                           </div>
                    
                        
<label class="switch"> 
	<input type="checkbox">
	<span class="lever"></span>
</label>

                       </div>
                   </li>
                   <li>
                        <div class="nearly-pepls">
                            <div class="pepl-info">
  <h4><a href="#" title="" class="font-weight-bold font-setting text-dark">@lang('main.settings.messageNotify')</a></h4>
                            </div>
                     
                         
 <label class="switch"> 
     <input type="checkbox">
     <span class="lever"></span>
 </label>
 
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


