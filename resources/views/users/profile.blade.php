@extends('layout.master')
@section('styles')
    <link rel="stylesheet" href="{{secure_asset('/css/profile.css')}}">
@endsection
@section('content')
    <!-- profile -->
    <section>
        <div class="container">
            <div class="row" style="margin-top:50px">
                {{--  <div class="col-md-12 col-sm-12">
                    <div class="image-profil mt-3 pt-3">
                        <img src="{{asset('/img/agency-slider02-min.jpg')}}" alt="" width="100%"
                            style="    border-radius: 0px 66px 0px 0px;">
                    </div>
                </div>  --}}
                {{--  <div class="col-md-10 col-sm-10 offset-md-1 mb-3">
                    <div class="data-following">
                        <div class="invest pt-4">
                            <p>1234</p>
                            <p>investor project</p>
                        </div>
                        <div class="invest pt-4">
                            <p class="">12</p>
                            <p class=""> project</p>
                        </div>
                        <div class="invest pt-4" style="  border-right: none">
                            <p class="">230</p>
                            <p class="">partners </p>
                        </div>

                    </div>
                </div>

                <div class="col-md-3 col-sm-2" style="width: 50%">
                    <div class="name-user">
                        <h1>mark stefain</h1>

                        <small class="ml-2" style="color:rgb(122, 116, 116)">Lorem ipsum/ccmm</small>
                    </div>


                </div>  --}}
                <div class="col-md-12 col-sm-12 mt-3">
                    <div>
                        <a href="" class="text-dark text-larg"> <i class="fas fa-map-marker-alt icon-contact2"></i>
                            {{$address->name." / ".$address->city_name}}</a><br>
                        <a href="" class="text-dark text-larg"> <i class="fas fa-envelope icon-contact2"></i>
                        {{Auth::user()->email}}</a><br>
                        <a href="" class="text-dark text-larg"> <i class="fas fa-address-book icon-contact2"></i>
                        {{Auth::user()->phone}}</a><br>
                        <p class="mb-3 mt-3">{{Auth::user()->description}}</p>
                        <span class="text-dark text-larg">total investment:</span>
                        <a href="" class="font-weight-bold text-larg"
                            style="color: rgba(74, 105, 255,100%)">{{$total_investments}}$</a>
                        <br>
                        <span class="text-dark text-larg">Favourites :</span>
                        <span class="text-dark text-larg">
                         @foreach ($favs as $fav)
                             @if (session('locale')=="ar")
                                 {{$fav->dep_ar.' , '}}
                             @else
                                 {{$fav->dep_en.' , '}}                                 
                             @endif
                         @endforeach 
                        </span>
                    </div>
                </div>
   
            </div>
        </div>
    </section>
    <!-- project home -->
    <section class="mb-3 pb-5">
        <div class="container">
          <div class="row">
              @foreach ($projects as $project)    
                <div class="col-md-12 col-sm-12 mb-3">
                  <div class="card-hover ">
                    <a href="{{URL::asset('/projects/'.$project->id)}}">
                      <div class="card proj card-height text-white">
                        <img class="card-img" src="{{asset($project->image)}}" height="400px" alt="Card image">
                        <div class="card-img-overlay fonts project-padd text-center">
                          <h3 class="card-title text-bottom">{{$project->title}} </h3>
                          <p class="card-text font-project-head"> {{$project->description}}</p>
                          <p class="card-text">{{$project->created_at}}</p>
                        </div>
                      </div>
                    </a>
                    <div class="news-post-meta">
                      <a href="#"><i class="far fa-heart"></i> {{$project->likes}}</a>
                      <a href="#"><i class="far fa-comments"></i> {{$project->comments}}</a>
                    </div>

                  </div>
                </div>
                {{--  <div class="col-md-12 col-sm-12">
                  <button type="button" class="btn btn-primaryed  p-2 investModel" title="{{$project->id}}" style="width: 20%;    border-radius: 3px;">@lang('main.invest')</button>
                    <button type="button" class="btn btn-primaryed  p-2" style="width: 20%;    float:right;    background-color:  #fff;
                    color: rgba(74, 105, 255,100%); border: 1px solid #ccc">{{$project->investment}}$</button>
                  </div>  --}}
          @endforeach
          </div>
        </div>
      </section>
      <!-- end home page -->
    <!-- end profile -->
@endsection