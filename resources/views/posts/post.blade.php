@extends('layout.master')
@section('styles')
    <link rel="stylesheet" href="{{URL::asset('/css/post.css')}}">
    <link rel="stylesheet" href="{{URL::asset('/css/media/posts.css')}}">
    <style>
        .container{
            margin-top: 70px;
        }
    </style>
@endsection


@section('content')
    

<!-- post -->
<section class="mt-3 ">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="mt-3 mb-3" style="">
                    <img src="{{URL::asset('/img/kiani_15-min.jpg')}}" alt="" width="100%" style="    border-radius: 46px;
box-shadow: 74px 60px 77px 81px rgba(0, 0, 0, 0.25);
">
                </div>
            </div>
            <div class="col-md-12 col-sm-12" style="background-color:#111111">
                <div class="text-post">
                    <p class="text-white post-details p-4" >
                        It is a long established fact that a reader will be distracted by the readable content of a
                        page when looking at its layout. The point of using Lorem Ipsum is that it has a
                        more-or-less normal distribution of letters, as opposed to using 'Content here, content
                        here', making it look like readable English. Many desktop publishing packages and web page
                        editors now use Lorem Ipsum
                    </p>
                               <!-- comment1 -->
            <div class="col-md-12 col-sm-12 mb-3">
                <div class="post-comment">
              
                    <div class="post-comt-box mt-3">
                        <form method="post">
                            <textarea placeholder="Leave your comment" 
                             style="  box-shadow: 10px 15px 45px -5px rgba(249, 249, 250, 0.25);background-color: #000000  "></textarea>
                        
                   
                            <button type="submit"></button>

                        </form>	
                        <a class="we-reply mb-3 mt-3" href="#" title=""> View All Comment 20</a>
                    </div>
                    <div class="title mb-3 mt-3" style=" display: inline-block;">

                        <div class="users-thumb-list" style="margin-top: 5px">
                          <a href="#" class="head-project  pl-2  " style="font-size:19px; color: rgba(74, 105, 255,100%)" title="" data-toggle="tooltip"
                            data-original-title="Anderw">
                            <img src="{{URL::asset('/img/friend-avatar6.jpg')}}" alt="">
                         mark john
                          </a>
                        </div>
                        </div>
                          <div class="we-comment mb-3 mt-3" style=" background-color: #000000; border:none;    border-radius: 10px;">
                            <div class="coment-head">
                                <h5><a href="#" title="">Donald Trump</a></h5>
                                <span>1 week ago</span>
                                <a class="we-reply" href="#" title="Reply"><i class="fa fa-reply"></i></a>
                            </div>
                            <p class="text-white">we are working for the dance and sing songs. this video is very awesome for the youngster. please vote this video and like our channel
                            
                            </p>
                            <div class="news-post-meta" style="border: none">
                                <a href="#"><i class="far fa-heart"></i> likes</a>
                                <a href="#"><i class="fa fa-reply"></i> Reply</a>
                              </div>
                        </div>
                </div>
            </div>
            <!-- end comment  -->

                    <!-- comment1 -->
                    <div class="col-md-12 col-sm-12 mb-3">
                        <div class="post-comment">
                      
                   
                            <div class="title mb-3" style=" display: inline-block;">
    
                                <div class="users-thumb-list" style="margin-top: 5px">
                                  <a href="#" class="head-project  pl-2  " style="font-size:19px; color: rgba(74, 105, 255,100%)" title="" data-toggle="tooltip"
                                    data-original-title="Anderw">
                                    <img src="{{URL::asset('/img/friend-avatar6.jpg')}}" alt="">
                                 mark john
                                  </a>
                                </div>
                                </div>
                                  <div class="we-comment mb-3 mt-3" style=" background-color: #000000; border:none;    border-radius: 10px;">
                                    <div class="coment-head">
                                        <h5><a href="#" title="">Donald Trump</a></h5>
                                        <span>1 week ago</span>
                                        <a class="we-reply" href="#" title="Reply"><i class="fa fa-reply"></i></a>
                                    </div>
                                    <p class="text-white">we are working for the dance and sing songs. this video is very awesome for the youngster. please vote this video and like our channel
                                    
                                    </p>
                                    <div class="news-post-meta" style="border: none">
                                        <a href="#"><i class="far fa-heart"></i> likes</a>
                                        <a href="#"><i class="fa fa-reply"></i> Reply</a>
                                      </div>
                                </div>
                        </div>
                    </div>
                    <!-- end comment 2-->

                </div>
            </div>
        </div>
    </div>
</section>



@section('scripts')
    
@endsection
@endsection


