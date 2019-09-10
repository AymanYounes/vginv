
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
        integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{secure_asset('/css/login.css')}}">
    <link rel="stylesheet" href="{{secure_asset('/css/media/login.css')}}">
    @toastr_css
    <title>VG</title>
</head>

<body>
    <!-- modal -->
    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="col-md-4 offset-md-4 col-sm-12 text-center mt-3">
                        <a class="navbar-brand" href="index.html"><img src="{{asset('/img/logo.png')}}"
                                class="img-logo" style="height:50px;"></a>
                        <br>
                        <span class="text-dark font-weight-bold mr-3 " style="   font-size: 35px;">VG
                            <span class="text-dark " style=" font-size: 26px;">INV</span>
                        </span>
                        <p>Tarm & Condition</p>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4 model-content">
                    <h3>Article 1</h3>
                    <p>
                            <mark>     • Step 1 </mark>: You may use the Services only if you agree to form a binding contract with us and are
                        not a person barred from receiving services under the laws of the applicable jurisdiction.
                        <br>
                    <mark>  • Step 2 </mark>: Our Priv
                        <br>
                        <mark>    • Step 3 </mark>: You may use the Services only if you agree to form a binding contract with us and are
                        not a person barred from receiving services under the laws of the applicable jurisdiction.
                        <br>
                        <mark>     • Step 4 </mark>: Our Priv</p>
                </div>
                <div class="modal-footer ">
                    <input type="submit" class="btn btn-primary btn-cont mt-3 mb-3 p-2" data-dismiss="modal"
                        value="CONTINUE & AGREE">
                </div>
            </div>
        </div>
    </div>
    <!-- end modal -->
    <section>
        <div class="overlay">
            <div class="container">
                <div class="row mb-3">
                    <div class="col-md-2 offset-md-5 col-sm-12 text-center mt-3 pt-4">
                        <a class="navbar-brand" href="index.html"><img src="{{asset('/img/logo.png')}}"
                                class="img-logo" style="height:50px;"></a>
                        <br>
                        <span class="text-white font-weight-bold mr-3 " style="   font-size: 35px;">VG
                            {{--  <span class="text-white " style=" font-size: 26px;">INV</span>  --}}
                        </span>
                    </div>
                    <div class="col-md-5"></div>
                </div>
                <!-- form -->
                <div class="row mt-3" id="form-reg">
                    <div class="col-md-4 offset-md-4 col-sm-12">
                        <div class="form-back">
                            <form method="POST" action="{{URL::asset('/user/'.$user_id.'/register')}}">
                                @csrf
                                <div class="form-group bottom-m" >
                                    <input disabled type="email" class="form-control border-inbut @error('email') is-invalid @enderror" name="email" value="{{$email}}" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" placeholder="@lang('main.labels.email')">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                     @enderror                              
                                </div>
                                <div class="form-group bottom-m" >
                                    <input type="password" required class="form-control border-inbut @error('password') is-invalid @enderror" name="password" id="exampleInputPassword1"
                                        placeholder="@lang('main.labels.password')">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                     @enderror                                
                                </div>
                                <div class="form-group bottom-m" >
                                    <input type="password" required class="form-control border-inbut" name="password_confirmation" id="exampleInputPassword1"
                                        placeholder="@lang('main.labels.confirmPass')">                           
                                </div>
                                <input type="submit" class="btn btn-primary btn-cont mt-3 mb-3 p-2" value="@lang('main.labels.continue')">
                            </form>
                        </div>

                    </div>
                </div>
                <!-- endform -->
            </div>
        </div>

    </section>

    <script src="{{asset('/js/jq.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    <script src="{{asset('/js/ajaxFuns.js')}}"></script>
    <script src="{{asset('/js/login.js')}}"></script>
     @toastr_js
    @toastr_render
</body>

</html>