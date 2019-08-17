@extends('layout.master')
@section('styles')
<link rel="stylesheet" href="{{URL::asset('/css/post.css')}}">
<link rel="stylesheet" href="{{URL::asset('c/css/media/posts.css')}}">
@endsection


@section('content')
    
<!--all post -->
<section>
    <div class="container">
<div class="row">
        <div class="col-md-12 col-sm-12 mt-3 ml-3">
                <div class="title ml-3" style=" display: inline-block;">
                  <h3 class="text-dark ">
                     News
                  </h3>
                </div>
            
              </div>
              <!-- post card 1 -->
<div class="col-md-12 col-sm-12">
    <div class="card mb-3 " style="border-radius: 2rem;border: none;  background-color: #111111">
            <div class="card-body">
               
                    <p class="ml-3 pl-5" style="  color: #cccccc; font-size: 12px;">Published: June,2 2018 19:PM</p>
                </div>
        <img class="card-img-top" src="{{URL::asset('/img/1.jpg')}}" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title text-white">Post Name</h5>
          <p class="card-text text-white">This is a wider card with supporting text below as a natural lead-in 
              to additional content. This content is a little bit longer.
              to additional content. This content is a little bit longer.....</p>
              <a class="we-reply mb-3 mt-3" href="post.html" title=""> Read More</a>
              <br>
              <div class="news-post-meta mt-3">
                    <a href="#" class="text-white"><i class="far fa-heart"></i> 370 likes</a>
                    <a href="#" class="text-white"><i class="fas fa-share-alt"></i>123 share</a>
      
                    <a href="#" class="text-white"><i class="far fa-comments"></i> 24 comments</a>
                  </div>

                  <!-- comment -->
                  <div class="post-comment">
                  
                        <div class="post-comt-box mt-3">
                            <form method="post">
                                <textarea placeholder="Leave your comment" 
                                 style="  box-shadow: 10px 15px 45px -5px rgba(249, 249, 250, 0.25);background-color: #000000  "></textarea>
                            
                       
                                <button type="submit"></button>

                            </form>	
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
                  <!-- end comment -->
          <p class="card-text" >
            <small  style="color:#cccccc">Last updated 3 mins ago</small>
        </p>
        </div>
      </div>
      
</div>
<!-- end 1  -->
              <!-- post card 2-->
              <div class="col-md-12 col-sm-12 ">
                    <div class="card mb-3 " style="border-radius: 2rem;border: none;  background-color: #111111">
                            <div class="card-body">
                               
                                    <p class="ml-3 pl-5" style="  color: #cccccc; font-size: 12px;">Published: June,2 2018 19:PM</p>
                                </div>
                        <img class="card-img-top" src="{{URL::asset('/img/pexels-photo-842567-min.jpeg')}}" alt="Card image cap">
                        <div class="card-body">
                          <h5 class="card-title text-white">Post Name</h5>
                          <p class="card-text text-white">This is a wider card with supporting text below as a natural lead-in 
                              to additional content. This content is a little bit longer.
                              to additional content. This content is a little bit longer.....</p>
                              <a class="we-reply mb-3 mt-3" href="post.html" title=""> Read More</a>
                              <br>
                              <div class="news-post-meta mt-3">
                                    <a href="#" class="text-white"><i class="far fa-heart"></i> 370 likes</a>
                                    <a href="#" class="text-white"><i class="fas fa-share-alt"></i>123 share</a>
                      
                                    <a href="#" class="text-white"><i class="far fa-comments"></i> 24 comments</a>
                                  </div>
                
                                  <!-- comment -->
                                  <div class="post-comment">
                                  
                                        <div class="post-comt-box mt-3">
                                            <form method="post">
                                                <textarea placeholder="Leave your comment" 
                                                 style="  box-shadow: 10px 15px 45px -5px rgba(249, 249, 250, 0.25);background-color: #000000  "></textarea>
                                            
                                       
                                                <button type="submit"></button>
                
                                            </form>	
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
                                  <!-- end comment -->
                          <p class="card-text" >
                            <small  style="color:#cccccc">Last updated 3 mins ago</small>
                        </p>
                        </div>
                      </div>
                      
                </div>
                <!-- end 2  -->
</div>
    </div>
</section>


@section('scripts')
    
@endsection
@endsection


