@extends('layout.master')
@section('styles')
    <link rel="stylesheet" href="{{secure_asset('/css/notifications.css')}}">
@endsection


@section('content')
    

<section>
    <div class="container">
<div class="row">

   <div class="col-lg-6 col-md-6 offset-md-3 mt-3 pt-3 paddl-r">
       <p class="font-weight-bold text-center styleheader ">@lang('main.settings.lang')</p>
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
                               <h4><a href="#" title="" class="font-weight-bold font-setting text-dark">English</a></h4>
                           </div>
                        
                            <label class="switch"> 
                                <input id="en" type="checkbox">
                                <span class="lever"></span>
                            </label>
                       </div>
                   </li>
                   <li>
                        <div class="nearly-pepls">
                            <div class="pepl-info">
                                <h4><a href="#" title="" class="font-weight-bold font-setting text-dark">Arabic</a></h4>
                            </div>
                            <label class="switch"> 
                                <input id="ar" type="checkbox">
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
    <script>
        var baseURL = $('#baseURL').val();



        function request( type ,url , data){
            return new Promise(function(resolve, reject) {
                $.ajax({
                    url:baseURL +url,
                    type:type,
                    data:data,
                }).done(function(response){
                    resolve(response);
                })
            })
        }
        var lang = $("meta[name='lang']")[0].lang;
        if(lang == "ar"){
            $("#ar").attr('checked' , true);
            $("#en").attr('checked' , false);
        }else{
            $("#ar").attr('checked' , false);
            $("#en").attr('checked' , true);
        }
        //(lang).attr('checked' , true);

        $("#ar , #en").change(function(){
            if(lang == "ar"){
            $("#ar").attr('checked' , false);
        }else{
            $("#en").attr('checked' , false);
        }
            request("get" , '/lang/'+this.id,null).then(res=>{
                if(res.status == "done"){
                    window.location.reload();
                }
            })
        })
    </script>
@endsection
@endsection


