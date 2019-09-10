@extends('layout.master')
@section('styles')
    
@endsection


@section('content')
    

<!-- change password -->
<section>
   <div class="container">
<div class="row">

  <div class="col-lg-6 col-md-6 offset-md-3 mt-3 pt-3 paddl-r">
      <p class="font-weight-bold text-center styleheader "> @lang('main.settings.changePass')</p>
      <div class="central-meta">
          <div class="frnds">
              <ul class="nav nav-tabs text-center">
     
               </ul>

              <!-- Tab panes -->
              <div class="tab-content">
                <div class="tab-pane active fade show" id="frends">
                  <ul class="nearby-contct">
               
         <form action="{{URL::asset('/user/settings/password')}}" method="POST" class="text-center">
            @csrf
               <li>
           <div class="form-group">
               <label for="inputPassword4" style="color:gray">@lang('main.settings.currentPass')</label>
               <input type="password" name="current_password" required class="form-control form-pass" id="inputPassword" placeholder="">
               @if(session('current_password'))
                    <span style="color:#dc3545;text-align:center;font-size:14px">
                        <strong>{{ session('current_password') }}</strong>
                    </span>
                @endif
           </div>
        

        
                  </li>
                  <li>
             
                     <div class="form-group">
                         <label for="inputPassword4" style="color:gray">@lang('main.settings.newPass')</label>
                         <input type="password" name="password" required class="form-control form-pass" id="inputPassword" placeholder="">
                         @error('password')
                            <span style="color:#dc3545;text-align:center;font-size:14px" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                     </div>
         
               
                            </li>
                            <li>
                           
                                 <div class="form-group">
                                     <label for="inputPassword4" style="color:gray">@lang('main.settings.confirmPass')</label>
                                     <input type="password" required name="password_confirmation" class="form-control form-pass" id="inputPassword" placeholder="">
                             
                                 </div>
                               </li>
                               <button type="submit" class="btn btn-primary">@lang('main.submit')</button>
                               </form>
                                    
                 
             
                  
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
<!-- end change -->


@section('scripts')
    
@endsection
@endsection


