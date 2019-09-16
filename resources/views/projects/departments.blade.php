@extends('layout.master')
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
        <!-- filter project -->
        <div class="row">
            <div class="col-md-4 col-sm-12 offset-md-3 mt-3 pt-3">
            
                <select id="deps" class="custom-select deps" style="    border: 0px solid #CCC;">
                    <option selected value="0"> @lang('projects.chooseFavProject')</option>
                    @foreach ($departments as $dep)
                        @if (session('locale')=="ar")
                            <option {{(isset($department_id) && $dep->id == $department_id)?'selected':'' }} value="{{$dep->id}}">{{$dep->dep_ar}}</option>
                        @else
                            <option {{(isset($department_id) && $dep->id == $department_id)?'selected':'' }} value="{{$dep->id}}">{{$dep->dep_en}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
                <div class="col-md-2 col-sm-12  mt-3 pt-3">
                <select id="deps_status" class="custom-select deps" style="    border: 0px solid #CCC;">
                    <option value="" selected> @lang('projects.allStatus') </option>
                        <option value="1" {{(isset($status) && $status == 1)?'selected':'' }}>@lang('projects.uncompleted')</option>
                        <option value="0" {{(isset($status) && $status == 0)?'selected':'' }}>@lang('projects.completed')</option>

                </select>

            </div>
        </div>
        <!-- end filter project -->
        <div class="row" style="margin-top:50px">
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

@section('scripts')
    
@endsection
@endsection