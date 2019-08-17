@extends('layout.master')
@section('styles')
    <link rel="stylesheet" href="{{URL::asset('/css/profile.css')}}">
    <meta name="city" content="{{Auth::user()->city_id}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <style>

        .select2{
            width: 70% !important;
            text-align: center;
            margin-left: 15%;
        }
        label{
            margin-left: 15%;
        }
    </style>
@endsection
@section('content')
    <!-- edit profile -->
 <section>
     <div class="container">
      <!-- form -->
     
      <div class="row mt-3" id="form-reg">
       <div class="col-md-12 col-sm-12 text-center mb-3 mt-3">
           <h1>
               @lang('main.settings.editProfile')
           </h1>
       </div>
            <div class="col-md-6 offset-md-3 col-sm-12">
                <div class="form-back">
                    <form action="{{URL::asset('/user/settings/profile/update')}}" enctype="multipart/form-data" method="POST">
                        @csrf 
                        <div class="form-group" style="margin-bottom: 0rem;">
                            <input type="text" class="form-control border-inbut" required value="{{Auth::user()->first_name}}" name="firstname" placeholder="@lang('main.labels.fname')">
                             @if ($errors->has('firstname'))
                                <span class="error" role="alert">
                                    <strong>{{ $errors->first('firstname') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group" style="margin-bottom: 0rem;">
                            <input type="text" class="form-control border-inbut" required value="{{Auth::user()->last_name}}" name="lastname" placeholder="@lang('main.labels.lname')">
                            @if ($errors->has('lastname'))
                                <span class="error" role="alert">
                                    <strong>{{ $errors->first('lastname') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group" style="margin-bottom: 0rem;">
                            <input type="email" class="form-control border-inbut" required value="{{Auth::user()->email}}" name="email" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="@lang('main.labels.email')">
                            @error('email')
                                <span class="error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group" style="margin-bottom: 0rem;">

                            <input type="tel" class="form-control border-inbut" required name="phone" value="{{Auth::user()->phone}}" id="exampleInputPassword1"
                                placeholder="@lang('main.labels.phone')">
                            @if ($errors->has('phone'))
                                <span class="error" role="alert">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group" style="margin-bottom: 0rem;">

                            <input type="text" class="form-control border-inbut" required name="position" value="{{Auth::user()->position}}"
                                placeholder="@lang('main.labels.position')">
                            @error('position')
                                <span class="error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                 
                        <div class="form-group" style="margin-bottom: 0rem;">
                            <label style="margin-left:18%">@lang('main.labels.birth')</label>
                            <input type="date" style="margin-top:0px" required class="form-control border-inbut" name="birth" value="{{Auth::user()->date_of_barth}}">
                            @if ($errors->has('birth'))
                                <span class="error" role="alert">
                                    <strong>{{ $errors->first('birth') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group " style="margin-bottom: 0rem;">
                                <select id="inputState" name="country" required class="form-control pro_country country border-inbut">
                                  <option selected>@lang('main.labels.country')</option>
                                </select>
                                @if ($errors->has('counrty'))
                                    <span class="error" role="alert">
                                        <strong>{{ $errors->first('counrty') }}</strong>
                                    </span>
                                @endif
                              </div>

                        <div class="form-group " style="margin-bottom: 0rem;">
                          
                            <select id="inputState" name="city" required class="form-control pro_city city border-inbut">
                              <option selected>@lang('main.labels.city')</option>
                            </select>
                            @if ($errors->has('city'))
                                <span class="error" role="alert">
                                    <strong>{{ $errors->first('city') }}</strong>
                                </span>
                            @endif
                          </div>
                          <div class="form-group " style="margin-bottom: 0rem;">
                              <label>@lang('main.labels.favs')</label>
                               <select class="selectpicker form-group" name="favs[]" required placeholder="@lang('main.labels.favs').." multiple data-live-search="true">
                                    @foreach ($deps as $dep)
                                        <option value="{{$dep->id}}">{{$dep->dep_name}}</option>
                                    @endforeach    
                                    
                                </select>

                            </div>
                      
                                <!-- upload image -->
                                <div class="input-group mb-3 pb-3" style="margin-bottom: 0rem;">
                                    <div class="custom-file">
                                    <input type="file" class="custom-file-input border-inbut" name="image" id="inputGroupFile02">
                                    <label class="custom-file-label border-inbut" for="inputGroupFile02">@lang('main.labels.profileImg')</label>
                                    </div>
                                    <!-- <div class="input-group-append">
                                    <span class="input-group-text" id="">Upload</span>
                                    </div> -->
                                </div>
                        
                                <div class="form-group" style="margin-bottom: 0rem;">
                                
                                    <textarea class="form-control border-inbut" required name="description" id="exampleFormControlTextarea1" rows="3" placeholder="@lang('main.labels.desc')">{{Auth::user()->description}}</textarea>
                                    @if ($errors->has('description'))
                                        <span class="error" role="alert">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                        <input type="submit" class="btn btn-primary btn-cont mt-3 mb-3 p-2" value="@lang('main.submit')">
                    </form>
                </div>

            </div>
        </div>

        <!-- endform -->
     </div>
 </section>
    <!-- end edit profile -->
    @section('scripts')
        <script src="{{URL::asset('/js/login.js')}}"></script>
        <script>
            $(document).ready(function() {
               $('.selectpicker').select2();
             $('.selectpicker').val({{$userFavs}});
             $('.selectpicker').trigger('change');

            });
        </script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    @endsection
@endsection