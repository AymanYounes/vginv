@extends('layout.master')
@section('styles')
{{-- <link rel="stylesheet" href="/app/public/css/style.css">--}}
<link rel="stylesheet" href="{{secure_asset('/css/media/home.css')}}">
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



@if(session("locale") == 'ar')
    /* RTL */

    .form-group{
        direction: rtl;
        text-align: right;
    }
.custom-file-label::after {
    left: 0;
    right: auto;
    border-left-width: 0;
    border-right: inherit;
}
@endif

</style>
@endsection
@section('content')


<!-- Modal -->
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
  data-backdrop="static" data-keyboard="false" aria-hidden="true">
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



  <!-- end invest -->

<!-- Modal -->

<div class="modal fade text-white" id="exampleModal" tabindex="-1" role="dialog"
aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="static"  data-keyboard="false" style="width:100%; background-color: rgba(241, 240, 242, 100%);">
<div class="modal-dialog" role="document">
    <div class="modal-content" style="">
        <div class="modal-header">
          <img src="{{asset('/img/e8025d7e05c8f3c49d06eee747b4a794-1920x400-c-center-min.jpg')}}" alt="" width="100%">
       
            <!-- <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                <span class="font-weight-bold" aria-hidden="true" style="columns: #000000;">Close &times;</span>
            </button> -->
        </div>
        <div class="modal-body">
            <h5 class="modal-title " id="exampleModalLabel">
              @if (session("type")=="vg")
                  <p class="text-center text-dark talk">@lang('main.addProject')</p>
              @else
                  <p class="text-center text-dark talk">@lang('main.addDeal')</p>                  
              @endif
    
</h5>
            <form method="POST" action="{{URL::asset('/user/add/project')}}" enctype="multipart/form-data">
              @csrf
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label text-dark">@lang('projects.addProjectTitle') *</label>
                    <input type="text" class="form-control" name="title" required id="recipient-name">
                    @error('title')
                        <span class="error" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="recipient-name" class="col-form-label text-dark">@lang('projects.provider')</label>
                    <select id="provider" name="provider" required class="form-control provider border-inbut @error('country') is-invalid @enderror" value="{{ old('provider') }}">
                        <option value="1" selected> @lang('projects.providerOption1')</option>
                        <option value="2" > @lang('projects.providerOption2')</option>
                        <option value="3" > @lang('projects.providerOption3')</option>
                    </select>
                    @error('provider')
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
                                  <input type="file" class="custom-file-input" multiple required name="studies[]" id="inputGroupFile03">
                                  <label class="custom-file-label " for="inputGroupFile03">@lang('main.labels.study')</label>
                                </div>
                                @error('studies')
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
                            @if (session("type")=="hmg")
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label text-dark">@lang('projects.period')</label>
                                <select id="period" name="period" required class="form-control period border-inbut @error('country') is-invalid @enderror" value="{{ old('period') }}">
{{--                                    <option selected>@lang('projects.period')</option>--}}
                                    <option value="30" selected>30 @lang('projects.days')</option>
                                    <option value="60">60 @lang('projects.days')</option>
                                    <option value="90">90 @lang('projects.days')</option>
                                </select>
                                @error('period')
                                <span class="error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            @endif
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
                                <select id="inputState" name="country" required class="form-control country border-inbut @error('country') is-invalid @enderror" value="{{ old('country') }}">
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
                                <select id="inputState" required name="city" class="form-control city border-inbut @error('city') is-invalid @enderror" value="{{ old('city') }}">
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
      <!-- Poll !-->
      @if (count($poll)>0)
        <div class="row mt-3 pt-4">
          <h4 style="margin:15px">{{$poll[0]->question}}</h4>
            <div class="col-md-12 col-sm-12">
              <div>
                @error("answer")
                  <span class="error" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
                <form action="{{URL::asset('/poll/'.$poll[0]->question_id.'/answer')}}" method="POST">
                  @csrf
                  @foreach ($poll as $i=>$p)   
                    <li class="li-edits"><span class="perc-back" style="width: @if(isset($pollVotes[$i]) && $pollVotes[$i]->answer_id == $p->id){{$pollVotes[$i]->count/$pollVotes[$i]->total*100}}% @else 0% @endif"></span>
                      <input class="inputs" type="radio" name="answer" id="answer{{$p->id}}" value="{{$p->id}}">
                      <label class="labels" style="line-height:22px" for="answer{{$p->id}}">{{$p->answer}}</label>
                      <span class="perc-number">
                        @if(isset($pollVotes[$i]) && $pollVotes[$i]->answer_id == $p->id)
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
        @if(count($proposed) > 0)
        <div class="col-md-12 col-sm-12 mt-3">
          <div class="title" style=" display: inline-block;">
            <h3 class="text-dark ">
              @lang('main.proposed')
            </h3>
          </div>
          {{--  <a class="slide__text-link text-dark mb-3" href="#" style="float: right;">View All</a>  --}}
        </div>
        @foreach ($proposed as $prop)
               
            <div class="col-md-4 col-sm-4 col-xs-4 col-lg-4 w-col">
                <a href="{{URL::asset('/projects/'.$prop->id)}}">
                  <div class="card text-white proposed card-sug">
                    <img class="card-img" src="{{asset($prop->image)}}" alt="Card image" width="100%">
                    <div class="card-img-overlay padd">
                    </div>
                    <div class="card-body" style="    padding: 5px;">
                      <h5 class="card-title text-dark media-h5">{{$prop->title}}</h5>
                      <p class="card-text  media-p" style="  color: gray;">{{$prop->description}} </p>
                    </div>
                  </div>
                </a>
            </div>
        @endforeach
        @endif
      </div>
    </div>
  </section>
  <!-- add project -->
  <div class="container">
    <div class="row mt-3">
      <div class="col-md-6 col-sm-12 offset-md-3 mt-3 ">
        <!-- Button trigger modal -->
        @if (session("type")=="vg")
            <button type="button" class="btn btn-primaryed  p-3" data-toggle="modal" data-target="#exampleModal">@lang('main.addProject')</button>
        @else
            <button type="button" class="btn btn-primaryed  p-3" data-toggle="modal" data-target="#exampleModal">@lang('main.addDeal')</button>            
        @endif

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
                <a href="{{URL::asset('/posts/'.$post->id)}}">
                    <div class="card">

                      <div class="card-img-overlay fonts">
                        <p class="card-text pedit">{{$post->title}}</p>

                      </div>
                      <img class="card-img-top img-fluid" src="https://www.vginv.com/vg-admin/public{{$post->image}}"
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
                  {{--  <a href="#"><i class="fas fa-share-alt"></i>123 share</a>  --}}

                  <a href="#"><i class="far fa-comments"></i> {{$project->comments}}</a>
                </div>

              </div>
            </div>
            @if($project->auth != Auth::user()->id)
                <div class="col-md-12 col-sm-12">
                @if (session("type")=="vg")
                  <button type="button" class="btn btn-primaryed  p-2 investModel" title="{{$project->id}}" style="width: 20%;    border-radius: 3px;">@lang('main.invest')</button>
                @else
                  <button type="button" class="btn btn-primaryed  p-2 investModel" title="{{$project->id}}" style="width: 20%;    border-radius: 3px;">@lang('main.deal')</button>
                @endif
                    <button type="button" class="btn btn-primaryed  p-2" style="width: 20%;    float:right;    background-color:  #fff;
                    color: rgba(74, 105, 255,100%); border: 1px solid #ccc">{{$project->investment}}$</button>
                </div>
            @endif
          @endforeach
      </div>
    </div>
  </section>

  @section('script')
    <script src="https://www.gstatic.com/firebasejs/6.2.0/firebase-app.js"></script>

  <script src="https://www.gstatic.com/firebasejs/6.2.0/firebase-messaging.js"></script>
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
  <script>



    var firebaseConfig = {
        apiKey: "AIzaSyB7PCZjvS9pHK18p3ssHuFdskGAHuiil7g",
        authDomain: "webpush-3733d.firebaseapp.com",
        databaseURL: "https://webpush-3733d.firebaseio.com",
        projectId: "webpush-3733d",
        storageBucket: "webpush-3733d.appspot.com",
        messagingSenderId: "611471641205",
        appId: "1:611471641205:web:e3f9a46e9f4087b1"
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);

    // Retrieve Firebase Messaging object.

    const messaging = firebase.messaging();
    // Add the public key generated from the console here.
    // Add the public key generated from the console here.
    messaging.usePublicVapidKey("BNScm2e-PrYSzWouqr7YcrN2EWfSDG-MSYex_jB0wsMdkvtm4dcAzJOExKrsuzoBrbg_HXrCSWG89Q_jAVOh77A");
    Notification.requestPermission().then((permission) => {
        if (permission === 'granted' && !isTokenSentToServer()) gettoken();
        else console.log('Unable to get permission to notify.');

        // if (permission === 'granted') {
        //
        //     if (isTokenSentToServer()) {
        //
        //     } else {
        //         gettoken();
        //     }
        // } else {
        //     console.log('Unable to get permission to notify.');
        // }
    });


    //get end point from user
    function gettoken() {

        // Get Instance ID token. Initially this makes a network call, once retrieved
// subsequent calls to getToken will return from cache.
        messaging.getToken().then((currentToken) => {
            if (currentToken) {
                console.log(currentToken);
                sndtokentoserver(true);
                savetoken(currentToken);
                // sendTokenToServer(currentToken);
                // updateUIForPushEnabled(currentToken);
            } else {
                sndtokentoserver(false);
                // Show permission request.
                console.log('No Instance ID token available. Request permission to generate one.');
                // Show permission UI.
                // updateUIForPushPermissionRequired();
                // setTokenSentToServer(false);
            }
        }).catch((err) => {
            console.log('An error occurred while retrieving token. ', err);
//   showToken('Error retrieving Instance ID token. ', err);
//   setTokenSentToServer(false);
        });

    }

    function sndtokentoserver(token) {
        window.localStorage.setItem('sentToServer', token ? '1' : '0')
    }

    function isTokenSentToServer() {
        return window.localStorage.getItem('sentToServer') === '1';
    }

    function savetoken(token) {
        $.ajax({
            url: 'action.php',
            method: 'post',
            data: 'tocen=' + token,
        }).done(function (res) {
            console.log(res);
        });
    }

    messaging.onMessage((payload) => {
        console.log('Message received. ', payload);
        // ...
        title = payload.data.title;
        option = {
            body: payload.data.body,
            icon: payload.data.icon
        }
        var notfi = new Notification(title, option);
    });

</script>
  @endsection
@endsection