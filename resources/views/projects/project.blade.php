@extends('layout.master')
@section('styles')
<link rel="stylesheet" href="{{secure_asset('/css/project.css')}}">
<style>
/* Thumbnails */

@media (min-width:0px) and (max-width:321px) {
.form-wrapper{
    padding: 0px;
}
.form-wrapper #search{
    width: 65%;
}
.div-home-icon {
    margin-left: 13px;
}
.d{
    display: none;
}
.rad{
    width: 43px;
    height: 43px;
}
.d-none{
    display:block !important;
    margin: 10px 0px 10px 0px
}
.bg-dar{
    display: flex;
}
.bg-dange{
    width: 26%;
}
.marg {
    margin-left: 11px;
    margin-top: 0px
}
     /* stylehome page */
     .add-cir{
        display: flex;
        width: 20px;
        height: 20px;
        font-size: 24px;
        margin: 0;
        justify-content: center;
        align-items: center;
        background-color: rgba(74, 105, 255,100%);
        border-radius: 50%;
        transition: all .5s;
        float: right;
      }
      .icon-contact-add{
    font-size: 15px;
    margin-bottom: 12px;
      }
      .users-thumb-list > a img {
        border-radius: 50%;
        width: 25px;
    }
    .users-thumb-list{
        margin-top: 39%;
    }
  .pl-5 {
        padding-left: 0px!important
    }
    .font-project-head {
        font-size: 13px;
        margin-bottom: 2px;
    }
    .text-bottom{
        margin-bottom: 2px;
    }
    .card-height{
        height: 137px;
    }
    .card-height img{
        height: 100%;
    }
    .news-post-meta a{
            margin-right: 0px;
            font-size: 12px;
    }
    .media-h5{
        font-size: 14px;
        font-weight: bold;
            margin-bottom: 4px;
    }
    .media-p{
        font-size: 12px;
    }
    .btn-primaryed{
        width: 48%!important
    }
    .width-media-btn {
        width: 49%!important;
          }
      
}
@media (min-width:322px) and (max-width:575px) {
.form-wrapper{
    padding: 0px;
}
.form-wrapper #search{
    width: 70%;
}
.div-home-icon {
    margin-left: 40px;
}
.d{
    display: none;
}
.rad{
    width: 43px;
    height: 43px;
}
.d-none{
    display:block !important;
    margin: 10px 0px 10px 0px
}
.bg-dar{
    display: flex;
}
.bg-dange{
    width: 26%;
}
.marg {
    margin-left: 11px;
    margin-top: 0px
}
/* stylehome page */
.add-cir{
    display: flex;
    width: 20px;
    height: 20px;
    font-size: 24px;
    margin: 0;
    justify-content: center;
    align-items: center;
    background-color: rgba(74, 105, 255,100%);
    border-radius: 50%;
    transition: all .5s;
    float: right;
  }
  .icon-contact-add{
font-size: 15px;
margin-bottom: 12px;
  }
  .users-thumb-list > a img {
    border-radius: 50%;
    width: 25px;
}
.users-thumb-list{
    margin-top: 39%;
}
.pl-5 {
    padding-left: 0px!important
}
.font-project-head {
    font-size: 13px;
    margin-bottom: 2px;
}
.text-bottom{
    margin-bottom: 2px;
}
.card-height{
    height: 137px;
}
.card-height img{
    height: 100%;
}
.news-post-meta a{
        margin-right: 0px;
}
.media-h5{
    font-size: 14px;
    font-weight: bold;
        margin-bottom: 4px;
}
.media-p{
    font-size: 12px;
}
.btn-primaryed{
    width: 48%!important
}
.width-media-btn {
width: 45%!important;
}

}
@media (min-width:425px) and (max-width:529px) {
.form-wrapper{
    padding: 0px;
}
.form-wrapper #search{
    width: 74%;
}
.div-home-icon {
    margin-left: 56px;
}
.d{
    display: none;
}
.rad{
    width: 43px;
    height: 43px;
}
.d-none{
    display:block !important;
    margin: 10px 0px 10px 0px
}
.bg-dar{
    display: flex;
}
.bg-dange{
    width: 26%;
}
.marg {
    margin-left: 11px;
    margin-top: 0px
}
    /* stylehome page */
    .add-cir{
        display: flex;
        width: 30px;
        height: 30px;
        font-size: 24px;
        margin: 0;
        justify-content: center;
        align-items: center;
        background-color: rgba(74, 105, 255,100%);
        border-radius: 50%;
        transition: all .5s;
        float: right;
      }
      .icon-contact-add{
    font-size: 20px;
    margin-bottom: 11px;
      }
      .users-thumb-list > a img {
        border-radius: 50%;
        width: 25px;
    }
    .users-thumb-list{
        margin-top: 39%;
    }
    .pl-5 {
        padding-left: 0px!important
    }
    .font-project-head {
        font-size: 13px;
        margin-bottom: 2px;
    }
    .text-bottom{
        margin-bottom: 2px;
    }
    .card-height{
        height: 137px;
    }
    .card-height img{
        height: 100%;
    }
    .news-post-meta a{
            margin-right: 0px;
    }
    .media-h5{
        font-size: 14px;
        font-weight: bold;
            margin-bottom: 4px;
    }
    .media-p{
        font-size: 12px;
    }
    .width-media-btn {
        width: 45%;
          }
}
@media (min-width:576px) and (max-width:768px) {
.form-wrapper #search{
    width: 68%;
}
.marg{
    margin-top: -58px;
}
.div-home-icon {
    margin-left: 32%;
}
.circule2{
    height: 42px;
    font-size: 20px;
}
.pl-5 {
    padding-left: 0px!important
}
.font-project-head {
    font-size: 13px;
    margin-bottom: 2px;
}
.text-bottom{
    margin-bottom: 2px;
}
.card-height{
    height: 137px;
}
.card-height img{
    height: 100%;
}
.news-post-meta a{
        margin-right: 0px;
}
.media-h5{
    font-size: 14px;
    font-weight: bold;
        margin-bottom: 4px;
}
.media-p{
    font-size: 12px;
}
.users-thumb-list{
    margin-top: 50%;
}
.width-media-btn {
    width: 45%;
      }
}
@media (min-width:769px) and (max-width:991px) {

}
@media (min-width:992px) and (max-width:1200px) {
.form-wrapper #search{
    width: 76%;
}
.marg{
    margin-top: -58px;
}
.div-home-icon {
    margin-left: 32%;
}
.circule2{
    height: 42px;
    font-size: 20px;
}
}


</style>
<!-- end style media -->

<style>
html{
    overflow-x: hidden;
}

</style>
@endsection


@section('content')


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header ">
          <h5 class="modal-title font-weight-bold " id="exampleModalLongTitle">INVEST </h5>
    
        </div>
        <div class="modal-body">
          <form id="investForm">
            @csrf
            <input type="hidden" id="project_id" name="project_id"> 
            <div class="container">
              <div class="row">
                <div class="col-md-2 col-sm-2">
                  <div class="circule">

                    <p style="background-color: transparent; margin-top:10px
                    border: none;"> <i class="fas fa-minus text-white icon-contact"></i></p></div>
                </div>

                <div class="col-md-8 col-sm-8">
                  <div class="form-group">

                    <input type="number" class="form-control border-input" name="amount" id="exampleInputEmail1" aria-describedby="emailHelp"
                      placeholder="your invest">

                  </div>
                  <p class="alert alert-success done" style="display:none">Your Request sent successfully.</p>
                  <p class="alert alert-warning exists" style="display:none">You are aleardy invested in this project.</p>
                  <p class="alert alert-danger error" style="display:none">Something went wrong,please try again.</p>
                </div>
                <div class="col-md-2 col-sm-2">
                  <div class="circule ">

                    <p style="background-color: transparent;margin-top:10px
                    border: none;"> <i class="fas fa-plus text-white icon-contact"></i></p></div>
                </div>
              </div>
            </div>
      
        </form>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <button type="button" id="invest" class="btn btn-primary" style="    width: 100%;
        border-radius: 31px;
    ">NEXT </button>
      </div>
    </div>
  </div>
  </div>
<!-- project -->
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="progress-div mt-3">
                    <p class="ml-3 pl-5" style="  color: gray; font-size: 15px;">@lang('main.members')
                        <span class="mr-3 " style="float: right; color:rgba(74, 105, 255,100%) ">{{$project->totalInvest}}$</span></p>
                    <div class="progress  ml-3 ">
                        <div class="progress-bar" style="width:{{$project->totalInvest/$project->budget*100}}%" role="progressbar" aria-valuenow="" aria-valuemin="0"
                            aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container mt-3 ">
        <div class="row">
            <div class="col-md-12 col-sm-12 mt-3">
                <div class="title" style=" display: inline-block;">

                    <div class="users-thumb-list" style="margin-top: 0px">
                        <a href="#" class="head-project font-weight-bold pl-2" title="" data-toggle="tooltip"
                            data-original-title="">
                            {{$project->title}}
                        </a>
                        <p class="ml-3 pl-5" style="  color: gray; font-size: 12px;">
                            {{date('j F h:i A',strtotime($project->created_at))}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- gallary -->

    <div class="container gallary-container mb-3">
        <div class="row" style="width:60%">
                
            <ul class="slides col-md-12 col-sm-12">
                @if (count($assets)>0)
                    @foreach ($assets as $i => $asset)
                        @if ($asset->type == 0)
                            <li id="slide{{$i}}"><img width="100%" src="{{secure_asset($asset->path)}}" alt="" /></li>
                        @endif
                    @endforeach
                </ul>
                <ul class="thumbnails">

                    @foreach ($assets as $i => $asset)
                        @if ($asset->type == 0)
                            <li>
                                <a href="#slide{{$i}}"><img src="{{secure_asset($asset->path)}}" alt="" /></a>
                            </li>
                        @endif
                    @endforeach
                @else
                    <li id="slide"><img width="100%" src="{{secure_asset($project->image)}}" alt="" /></li>
                @endif
            </ul>
        </div>
    </div>
    <div class="container">
        <div class="row">
            
            <div class="col-md-12 col-sm-12 mb-3">
                <a href='{{secure_asset("/projects/$project->id/assets/download")}}'><i class="fas fa-download"></i> @lang('main.download') </a>
                    @if($project->auth != Auth::user()->id)
                    @if (session("type")=="vg")
                        <button type="button" class="btn btn-primaryed  p-2 investModel" title="{{$project->id}}" style="width: 20%;    border-radius: 3px;">@lang('main.invest')</button>
                    @else
                        <button type="button" class="btn btn-primaryed  p-2 investModel" title="{{$project->id}}" style="width: 20%;    border-radius: 3px;">@lang('main.deal')</button>
                    @endif
                    @endif
            </div>
            <div class="col-md-12 col-sm-12">
                <p>
                   {{$project->description}}
                </p>
                <strong style="font-size: 18px">@lang('main.labels.investments'):</strong>
                <span class="ml-2" style="color: rgba(74, 105, 255,100%); font-size: 22px ">{{$project->totalInvest}}$</span>
               <br>
                <div class="news-post-meta mt-3" style="    padding: 0px 0px;    display: inline-block; ">
                    <a><i id="proLike" title="{{$project->id}}" class="far fa-heart"></i><span id="likes"> {{$project->likes}}</span> </a>
                    {{--  <a href="#"><i class="fas fa-share-alt"></i>123 </a>  --}}
      
                    <a href="#"><i class="far fa-comments"></i> {{count($comments)}} </a>
                  </div>
                  <!-- <button type="button" class="btn btn-primaryed mt-3  p-2 font-weight-bold" style="width: 20%;    float:right;    background-color:  #fff;
                  color: rgba(74, 105, 255,100%); border: 1px solid #ccc">@lang('main.invite')</button> -->
            </div>
            <!-- comment1 -->
            <div class="col-md-12 col-sm-12 mb-3">
                <div class="post-comment">
              
                    <div class="post-comt-box mt-3">
                        <form id="commForm">
                            @csrf
                            <input type="hidden" name="project_id" value="{{$project->id}}">
                            <textarea id="comment" name="comment" placeholder="Leave your comment" style="  box-shadow: 10px 15px 45px -5px rgba(20,10,25,.25);"></textarea>
                        
                   
                            <button type="submit"></button>
                        </form>	
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-sm-12 mb-3 comments">
                @foreach ($comments as $comment)                
                    <div class="post-comment">
                        <div class="title mb-3" style=" display: inline-block;">
                            <div class="users-thumb-list" style="margin-top: 5px">
                                <a href='{{secure_asset("/user/$comment->uid/profile")}}' class="head-project  pl-2  " style="font-size:19px; color: rgba(74, 105, 255,100%)" title="" data-toggle="tooltip"
                                data-original-title="Anderw">
                                <img src="{{asset($comment->uimage)}}" width="50px" height="50px" alt="">
                                    {{$comment->ufirst." ".$comment->ulast}}
                                </a>
                            </div>
                            </div>
                                <div class="we-comment mb-3 mt-3" style="width:10%">
                                <div class="coment-head">
                                    <span>{{(new Carbon\Carbon($comment->created_at))->diffForHumans()}}</span>
                                </div>
                                <p>
                                    {{$comment->comment}}
                                </p>
                            </div> 
                    </div><br>
                @endforeach
            </div>

                    <!-- end comment 2-->
                    <!-- <div class="col-md-12 mb-3 pb-5">
                        <button type="button" class="btn    p-2"
                        style="width: 100%; color: #fff; background-color: rgb(248, 56, 88);  border-radius: 3px;">@lang('main.report')
                      </button>
                    </div> -->
        </div>
    </div>
    <!-- end gallary -->

</section>
<!-- end project -->


@section('scripts')
    <script src="{{secure_asset('/js/slippry.min.js')}}"></script>
    <script>
        var thumbs = jQuery('#thumbnails').slippry({
        // general elements & wrapper
        slippryWrapper: '<div class="slippry_box thumbnails" />',
        // options
        transition: 'horizontal',
        pager: false,
        auto: false,
        onSlideBefore: function (el, index_old, index_new) {
            jQuery('.thumbs a img').removeClass('active');
            jQuery('img', jQuery('.thumbs a')[index_new]).addClass('active');
        }
        });

        jQuery('.thumbs a').click(function () {
        thumbs.goToSlide($(this).data('slide'));
        return false;
        });

    </script>
@endsection
@endsection


