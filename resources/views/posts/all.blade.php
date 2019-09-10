@extends('layout.master')
@section('styles')
<link rel="stylesheet" href="{{secure_asset('/css/post.css')}}">
<link rel="stylesheet" href="{{secure_asset('c/css/media/posts.css')}}">
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
        @foreach ($posts as $post)
            <div class="col-md-12 col-sm-12">
                <div class="card mb-3 " style="border-radius: 2rem;border: none;  background-color: #111111">
                    <div class="card-body">
                    <p class="ml-3 pl-5" style="  color: #cccccc; font-size: 12px;">Published: {{date('j F h:i A',strtotime($post->created_at))}}</p>
                    </div>
                    <img class="card-img-top" height="500px" src="/vg-admin/public{{$post->image}}" alt="Card image cap">
                    <div class="card-body">
                        @if (session('locale')=="en")
                            
                          <h5 class="card-title text-white">{{$post->title}}</h5>
                          <p class="card-text text-white">
                              {{$post->content}}
                          </p>
                        @else
                          <h5 class="card-title text-white">{{$post->title_ar}}</h5>
                          <p class="card-text text-white">
                              {{$post->content_ar}}
                          </p>
                        @endif
                        <a class="we-reply mb-3 mt-3" href="{{URL::asset('/posts/'.$post->id)}}" title=""> Read More</a>
                          <br>
                          <div class="news-post-meta mt-3">
                              <a href="#" class="text-white"><i class="far fa-comments"></i> {{$post->comments}} comments</a>
                          </div>
                    </div>
                  </div>  
            </div>
        @endforeach

        <!-- end 1  -->
      </div>
  </div>
</section>


@section('scripts')
    
@endsection
@endsection


