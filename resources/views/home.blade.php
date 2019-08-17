@extends('layout.master')
@section('styles')
{{-- <link rel="stylesheet" href="/app/public/css/style.css">--}}
<link rel="stylesheet" href="{{URL::asset('/css/media/home.css')}}"> 
<style>
  .proposed {
    height: 350px;
  }
  .proposed img{
    height: 80% !important;
  }
  .proj{
    margin:25px 25px;
    height: 400px;
  }
</style>
<!-- poll -->
<style>
.li-edits {
  display: block;
  border: solid 1px #ddd;
  padding: 4px;
  margin-bottom: 10px;
  position: relative;
}
.li-edits .perc-back {
  background: #d2dfe5;
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  width: 0%;
  z-index: -1;
}

.buttons {
  float: right;
  background: #007cb0;
  border: none;
  border-radius: 3px;
  color: #fff;
  padding: 0 30px;
  font-size: 20px;
  line-height: 40px;
}

.inputs {
  display: none;
}

.labels {
  vertical-align: middle;
  cursor: pointer;
  line-height: 15px;
  overflow: hidden;
}
.labels:before {
  content: url("http://img.qa01.medscapestatic.com/pi/videoplayer/icons/qna-radio-off.png");
  overflow: hidden;
  display: inline-block;
  margin-right: 10px;
  margin-top: 2px;
  margin-left: 2px;
  margin-bottom: -1px;
}

.inputs[type=radio]:checked + .labels:before {
  content: url("http://img.qa01.medscapestatic.com/pi/videoplayer/icons/qna-radio-on.png");
  margin-top: 0;
  margin-left: 0;
  margin-bottom: -3px;
  margin-right: 8px;
}

li.correct .labels:before {
  content: url("http://img.qa01.medscapestatic.com/pi/videoplayer/icons/qna-correct.png");
  margin-top: 0;
  margin-left: 0;
  margin-bottom: -5px;
  margin-right: 6px;
}

li.correct .inputs[type=radio]:checked + .labels:before {
  content: url("http://img.qa01.medscapestatic.com/pi/videoplayer/icons/qna-correct.png");
  margin-top: 0;
  margin-left: 0;
  margin-bottom: -5px;
  margin-right: 6px;
}

.perc-number {
  float: right;
}

</style>
@endsection
@section('content')
    

<!-- Modal -->

<div class="modal fade text-white" id="exampleModal" tabindex="-1" role="dialog"
aria-labelledby="exampleModalLabel" aria-hidden="true" style="width:100%; background-color: rgba(241, 240, 242, 100%);">
<div class="modal-dialog" role="document">
    <div class="modal-content" style="">
        <div class="modal-header">
          <img src="{{URL::asset('/img/e8025d7e05c8f3c49d06eee747b4a794-1920x400-c-center-min.jpg')}}" alt="" width="100%">
       
            <!-- <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                <span class="font-weight-bold" aria-hidden="true" style="columns: #000000;">Close &times;</span>
            </button> -->
        </div>
        <div class="modal-body">
            <h5 class="modal-title " id="exampleModalLabel">
                   
                <p class="text-center text-dark talk">@lang('main.addProject')</p>
    
</h5>
            <form method="POST" action="{{URL::asset('/user/add/project')}}" enctype="multipart/form-data">
              @csrf
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label text-dark">@lang('main.labels.title') *</label>
                    <input type="text" class="form-control" name="title" required id="recipient-name">
                    @error('title')
                        <span class="error" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="custom-file">                                       
                              <input type="file" class="custom-file-input" required name="images[]" multiple id="inputGroupFile02">
                              <label class="custom-file-label" for="inputGroupFile02">@lang('main.labels.images')</label>
                            </div>
                            @error('images')
                                <span class="error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                    </div>
                    <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="custom-file">
                                  <input type="file" class="custom-file-input" multiple required name="study" id="inputGroupFile02">
                                  <label class="custom-file-label " for="inputGroupFile02">@lang('main.labels.study')</label>
                                </div>
                                @error('study')
                                   <span class="error" role="alert">
                                       <strong>{{ $message }}</strong>
                                   </span>
                               @enderror
                              </div>
                        </div>
                        {{--  <div class="form-group">
                                <label for="recipient-name" class="col-form-label text-dark">Feasibility Study</label>
                                <input type="text" class="form-control" name="study" required id="recipient-name">
                                @error('study')
                                    <span class="error" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>  --}}
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label text-dark">@lang('main.labels.investments')</label>
                                <input type="text" class="form-control" name="investment" required id="recipient-name">
                                @error('investment')
                                    <span class="error" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label text-dark">@lang('main.labels.budget')</label>
                                <input type="text" class="form-control" name="budget" required id="recipient-name">
                                @error('budget')
                                    <span class="error" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group bottom-m">
                                <label for="recipient-name" class="col-form-label text-dark">@lang('main.labels.projectCountry') </label>
                                <select id="inputState" name="country" required required class="form-control country border-inbut @error('country') is-invalid @enderror" name="country" value="{{ old('country') }}">
                                    <option selected>Country</option>
                                </select>
                                @error('country')
                                    <span class="error" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group bottom-m" >
                                <label for="recipient-name" class="col-form-label text-dark">@lang('main.labels.projectCity') </label>
                                <select id="inputState" required name="city" required class="form-control city border-inbut @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}">
                                  <option selected>City</option>
                                </select>
                                @error('city')
                                    <span class="error" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <label class="input-group-text" for="inputGroupSelect01">@lang('main.labels.category')</label>
                                    </div>
                                    <select class="custom-select deps" name="category" required id="inputGroupSelect01">
                                      <option selected>@lang('main.labels.choose')...</option>
                                    </select>
                                    @error('category')
                                        <span class="error" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                  </div>
                            </div>
                      
                <div class="form-group">
                    <label for="message-text" class="col-form-label text-dark">@lang('main.labels.desc') *</label>
                    <textarea class="form-control" name="description" required id="message-text"></textarea>
                    @error('description')
                        <span class="error" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="modal-footer text-center">
                  <button type="submit" value="submit" class="btn btn-primaryed  p-2" style="width: 20%;  border-radius: 3px;  ">
                    @lang('main.submit')</button>
                    <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                        <span class="font-weight-bold" aria-hidden="true" style="columns: #000000;">@lang('main.labels.close') &times;</span>
                    </button> 
                </div>
            </form>
          

        </div>
    
    </div>
</div>
</div>
<!-- end modal -->

<section>
    <div class="container">
      @if (count($poll)>0)
        <div class="row mt-3 pt-4">
            <div class="col-md-12 col-sm-12">
              <div>
                @error("answer")
                  <span class="error" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
                <form action="/poll/{{$poll[0]->question_id}}/answer" method="POST">
                  @csrf
                  @foreach ($poll as $i=>$p)   
                    <li class="li-edits"><span class="perc-back" style="width: @if(isset($pollVotes[$i])){{$pollVotes[$i]->count/$pollVotes[$i]->total*100}}% @else 0% @endif"></span>
                      <input class="inputs" type="radio" name="answer" id="answer{{$p->id}}" value="{{$p->id}}">
                      <label class="labels" for="answer{{$p->id}}">{{$p->answer}}</label>
                      <span class="perc-number">
                        @if(isset($pollVotes[$i]))
                          {{number_format((float)$pollVotes[$i]->count/$pollVotes[$i]->total*100, 2, '.', '')}}%
                        @else
                          0%
                        @endif
                      </span>
                    </li>
                  @endforeach
                    <button type="submit" class="buttons">@lang('main.submit')</button>
                </form>
              </div>
          </div>
        </div>
      @endif

      <div class="row">
        <div class="col-md-12 col-sm-12 mt-3">
          <div class="title" style=" display: inline-block;">
            <h3 class="text-dark ">
              @lang('main.proposed')
            </h3>
          </div>
          {{--  <a class="slide__text-link text-dark mb-3" href="#" style="float: right;">View All</a>  --}}
        </div>
        @foreach ($invests as $invest)
               
            <div class="col-md-4 col-sm-4 col-xs-4 col-lg-4 w-col">
              <div class="card text-white proposed card-sug">
                <img class="card-img" src="{{URL::asset($invest->image)}}" alt="Card image" width="100%">
                <div class="card-img-overlay padd">

                  <div class=" add-cir">
                    <a href="">
                      <i class="fas fa-plus text-white icon-contact icon-contact-add"></i>
                    </a>
                  </div>
                  {{--  <div class="users-thumb-list">
                    <a href="#" title="" data-toggle="tooltip" data-original-title="Anderw">
                      <img src="/app/public/img/friend-avatar8.jpg" alt="">
                    </a>
                    <a href="#" title="" data-toggle="tooltip" data-original-title="frank">
                      <img src="/app/public/img/friend-avatar2.jpg" alt="">
                    </a>
                    <a href="#" title="" data-toggle="tooltip" data-original-title="Sara">
                      <img src="/app/public/img/friend-avatar3.jpg" alt="">
                    </a>
                    <a href="#" title="" data-toggle="tooltip" data-original-title="Amy">
                      <img src="/app/public/img/friend-avatar4.jpg" alt="">
                    </a>
                  </div>  --}}
                </div>
                <div class="card-body" style="    padding: 5px;">
                  <h5 class="card-title text-dark media-h5">{{$invest->title}}</h5>
                  <p class="card-text  media-p" style="  color: gray;">{{$invest->description}} </p>
                </div>
              </div>
            </div>
        @endforeach

      </div>
    </div>
  </section>
  <!-- add project -->
  <div class="container">
    <div class="row mt-3">
      <div class="col-md-6 col-sm-12 offset-md-3 mt-3 ">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primaryed  p-3" data-toggle="modal" data-target="#exampleModal">@lang('main.addProject')</button>

      </div>
    </div>
  </div>

  <!-- end add project -->
  <!-- news -->
  <section class="mb-3 pb-5">
    <div class="container">
      <div class="row mt-3">
        <div class="col-md-12 col-sm-12 mt-3">
          <div class="title" style=" display: inline-block;">
            <h3 class="text-dark ">
              @lang('main.news')
            </h3>
          </div>
          <a class="slide__text-link text-dark mb-3" href="{{URL::asset('/posts/all')}}" style="float: right;">@lang('main.all')</a>
        </div>
        <div class="col-md-12 col-sm-12 mt-3">
          <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner row w-100 mx-auto">
              @foreach ($posts as $post)
                  
                <div class="carousel-item col-md-4 active">
                  <a href="">
                    <div class="card">

                      <div class="card-img-overlay fonts">
                        <p class="card-text pedit">{{$post->title}}</p>

                      </div>
                      <img class="card-img-top img-fluid" src="http://www.vginv.com/vg-admin/public{{$post->image}}"
                        alt="Card image cap">

                    </div>
                  </a>

                </div>
              @endforeach

            </div>
            <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>

        </div>
      </div>
    </div>
  </section>
  <!-- end new -->
  <!-- project -->
  <section>
    <div class="container">
      <div class="row">
          @foreach ($projects as $project)
              
            <div class="col-md-12 col-sm-12 mb-3">
              <div class="card-hover ">
                <a href="{{URL::asset('/projects/'.$project->id)}}">
                  <div class="card proj card-height text-white">
                    <img class="card-img" src="{{URL::asset($project->image)}}" height="400px" alt="Card image">
                    <div class="card-img-overlay fonts project-padd text-center">
                      <h3 class="card-title text-bottom">{{$project->title}} </h3>
                      <p class="card-text font-project-head"> {{$project->description}}</p>
                      <p class="card-text">{{$project->created_at}}</p>
                    </div>
                  </div>
                </a>
                <div class="news-post-meta">
                  <a href="#"><i class="far fa-heart"></i> {{$project->likes}} @lang('main.like')</a>
                  {{--  <a href="#"><i class="fas fa-share-alt"></i>123 share</a>  --}}

                  <a href="#"><i class="far fa-comments"></i> {{$project->comments}} @lang('main.comment')</a>
                </div>

              </div>
            </div>
            <div class="col-md-12 col-sm-12">
              <button type="button" class="btn btn-primaryed  p-2" style="width: 20%;    border-radius: 3px;">@lang('main.invest')</button>
                <button type="button" class="btn btn-primaryed  p-2" style="width: 20%;    float:right;    background-color:  #fff;
                color: rgba(74, 105, 255,100%); border: 1px solid #ccc">{{$project->investment}}$</button>
              </div>
          @endforeach
      </div>
    </div>
  </section>

  @section('script')
  <script>
    $(document).ready(function () {
      $("#myCarousel").on("slide.bs.carousel", function (e) {
        var $e = $(e.relatedTarget);
        var idx = $e.index();
        var itemsPerSlide = 3;
        var totalItems = $(".carousel-item").length;

        if (idx >= totalItems - (itemsPerSlide - 1)) {
          var it = itemsPerSlide - (totalItems - idx);
          for (var i = 0; i < it; i++) {
            // append slides to end
            if (e.direction == "left") {
              $(".carousel-item")
                .eq(i)
                .appendTo(".carousel-inner");
            } else {
              $(".carousel-item")
                .eq(0)
                .appendTo($(this).find(".carousel-inner"));
            }
          }
        }
      });
    });

  </script>
  @endsection
  <script src="{{URL::asset('/js/ajaxFuns.js')}}"></script>
@endsection