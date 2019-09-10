@extends('layout.master')
@section('styles')
    <link rel="stylesheet" href="{{secure_asset('/css/post.css')}}">
    <link rel="stylesheet" href="{{secure_asset('/css/media/posts.css')}}">
    <style>
        .container{
            margin-top: 70px;
        }
        .we-comment{
            display: block !important;
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
                    <img src="/vg-admin/public{{$post->image}}" alt="" width="100%" style="    border-radius: 46px;
box-shadow: 74px 60px 77px 81px rgba(0, 0, 0, 0.25);
">
                </div>
            </div>
            <div class="col-md-12 col-sm-12" style="background-color:#111111">
                <div class="text-post">
                    @if (session("locale")== "en")
                        <p class="text-white post-details p-4" >
                            {{$post->content}}     
                        </p>
                    @else
                        <p class="text-white post-details p-4" >
                                {{$post->content_ar}}
                        </p>
                    @endif
                  
                               <!-- comment1 -->
            <div class="col-md-12 col-sm-12 mb-3">
                <div class="post-comment">
              
                    <div class="post-comt-box mt-3">
                        <form id="postForm">
                            @csrf
                            <input type="hidden" name="post_id" value="{{$post->id}}">
                            <textarea id="postCommnet" name="comment" placeholder="Leave your comment" 
                             style="  box-shadow: 10px 15px 45px -5px rgba(249, 249, 250, 0.25);background-color: #fff  "></textarea>
                        
                        </form>	
                        {{-- <a class="we-reply mb-3 mt-3" href="#" title=""> View All Comment 20</a> --}}
                    </div>
                    <div class="comments">
                        @foreach ($comments as $comment)
                            
                            <div class="title mb-3 mt-3" style=" display: inline-block;">
                                <div class="users-thumb-list" style="margin-top: 5px">
                                    <a href='{{secure_asset("/user/$comment->uid/profile")}}' class="head-project  pl-2  " style="font-size:19px; color: rgba(74, 105, 255,100%)" title="" data-toggle="tooltip"
                                    data-original-title="Anderw">
                                    <img src="{{asset($comment->uimage)}}" width="50px" height="50px" alt="">
                                        {{$comment->ufirst." ".$comment->ulast}}
                                    </a>
                                </div>
                            </div>
                            <div class="we-comment mb-3 mt-3" style="width:100%; background-color: #000000;color:#fff; border:none;    border-radius: 10px;">
                                <div class="coment-head">
                                    <div class="coment-head">
                                        <span>{{(new Carbon\Carbon($comment->created_at))->diffForHumans()}}</span>
                                    </div>
                                    <p>
                                        {{$comment->comment}}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- end comment  -->   

                </div>
            </div>
        </div>
    </div>
</section>

@section('scripts')
    
@endsection
@endsection


