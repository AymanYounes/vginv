@extends('layout.master')
@section('styles')
    <link rel="stylesheet" href="{{URL::asset('/css/profile.css')}}">
@endsection
@section('content')
    <!-- profile -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="image-profil mt-3 pt-3">
                        <img src="{{URL::asset('/img/agency-slider02-min.jpg')}}" alt="" width="100%"
                            style="    border-radius: 0px 66px 0px 0px;">
                    </div>
                </div>
                <div class="col-md-10 col-sm-10 offset-md-1 mb-3">
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


                </div>

                <div class="col-md-2 text-center offset-md-7 col-sm-2" style="width: 50%">
                    <div style="    display: flex;">
                        <div class="circule2 ml-3" style="background-color: rgba(74, 105, 255,100%); ">
                            <a href=""> <i class="fas fa-envelope icon-contact2 text-white"></i></a></div>
                        <div class="circule2 ml-3" style="background-color: rgba(74, 105, 255,100%); ">
                            <a href=""> <i class="fas fa-user-times icon-contact2 text-white"></i></a></div>
                    </div>

                </div>
                <div class="col-md-12 col-sm-12 mt-3">
                    <div>
                        <a href="" class="text-dark text-larg"> <i class="fas fa-map-marker-alt icon-contact2"></i>
                            egypt,cairo</a>
                        <p class="mb-3 mt-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit possimus
                            ratione dolorem
                            similique eius placeat minus deserunt debitis illum magnam, adipisci consectetur consequatur
                            recusandae, porro beatae labore vero, ipsam ducimus!</p>
                        <span class="text-dark text-larg">total investment:</span>
                        <a href="" class="font-weight-bold text-larg"
                            style="color: rgba(74, 105, 255,100%)">2000000$</a>
                        <br>
                        <span class="text-dark text-larg">My Favourite :</span>
                        <span class="text-dark text-larg">Art, Building, Ground </span>
                    </div>
                </div>
   
            </div>
        </div>
    </section>
    <!-- project home -->
    <section class="mb-3 pb-5">
        <div class="container">
          <div class="row">
            <div class="col-md-12 col-sm-12 mt-3">
              <div class="title" style=" display: inline-block;">
    
                <div class="users-thumb-list" style="margin-top: 0px">
                  <a href="project.html" class="head-project font-weight-bold pl-2" title="" data-toggle="tooltip"
                    data-original-title="Anderw">
                    <img src="{{URL::asset('/img/friend-avatar6.jpg')}}" alt="">
                    Project 1
                  </a>
                  <p class="ml-3 pl-5" style="  color: gray; font-size: 12px;">Published: June,2 2018 19:PM</p>
                </div>
              </div>
              <a class="slide__text-link text-dark mb-3" href="#" style="float: right;">View All</a>
            </div>
    
    
            <div class="col-md-12 col-sm-12 mb-3">
              <div class="card-hover ">
                <a href="project.html">
                  <div class="card card-height text-white">
                    <img class="card-img" src="{{URL::asset('/img/e8025d7e05c8f3c49d06eee747b4a794-1920x400-c-center-min.jpg')}}" alt="Card image">
                    <div class="card-img-overlay fonts project-padd text-center">
                      <h3 class="card-title text-bottom">Prpject Name </h3>
                      <p class="card-text font-project-head">This is a wider card with supporting text below as a natural
                        lead-in to additional content. </p>
                      <p class="card-text">Last updated 3 mins ago</p>
                    </div>
                  </div>
                </a>
                <div class="news-post-meta">
                  <a href="#"><i class="far fa-heart"></i> 370 likes</a>
                  <a href="#"><i class="fas fa-share-alt"></i>123 share</a>
    
                  <a href="#"><i class="far fa-comments"></i> 24 comments</a>
                </div>
    
              </div>
            </div>
            <div class="col-md-12 col-sm-12">
              <button type="button" class="btn btn-primaryed  p-2" style="width: 20%;    border-radius: 3px;">invest in this
                project</button>
              <button type="button" class="btn btn-primaryed  p-2" style="width: 20%;    float:right;    background-color:  #fff;
        color: rgba(74, 105, 255,100%); border: 1px solid #ccc">200000.00$</button>
            </div>
            <!-- 2 -->
            <div class="col-md-12 col-sm-12 mb-3 mt-3 pt-5">
              <div class="card-hover ">
                <a href="project.html">
                  <div class="card card-height text-white">
                    <img class="card-img" src="{{URL::asset('/img/Title-AGB-Group-Health-min.png')}}" alt="Card image">
                    <div class="card-img-overlay fonts project-padd text-center">
                      <h3 class="card-title text-bottom">Prpject Name </h3>
                      <p class="card-text font-project-head">This is a wider card with supporting text below as a natural
                        lead-in to additional content. </p>
                      <p class="card-text">Last updated 3 mins ago</p>
                    </div>
                  </div>
                </a>
                <div class="news-post-meta">
                  <a href="#"><i class="far fa-heart"></i> 370 likes</a>
                  <a href="#"><i class="fas fa-share-alt"></i>123 share</a>
    
                  <a href="#"><i class="far fa-comments"></i> 24 comments</a>
                </div>
    
              </div>
            </div>
            <div class="col-md-12 col-sm-12">
              <button type="button" class="btn btn-primaryed  p-2" style="width: 20%;    border-radius: 3px;">invest in this
                project</button>
              <button type="button" class="btn btn-primaryed  p-2" style="width: 20%;    float:right;    background-color:  #fff;
            color: rgba(74, 105, 255,100%); border: 1px solid #ccc">200000.00$</button>
            </div>
    


            <div class="col-md-12  pt-5">
                <button type="button" class="btn    p-2"
                style="width: 100%; color: #fff; background-color: rgb(248, 56, 88);  border-radius: 3px;">Report
              </button>
    </div>
          </div>
        </div>
      </section>
      <!-- end home page -->
    <!-- end profile -->
@endsection