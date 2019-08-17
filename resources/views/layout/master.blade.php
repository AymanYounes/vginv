<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="_token" content="{{csrf_token()}}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
        integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{URL::asset('/css/style.css')}}">
    <link rel="stylesheet" href="{{URL::asset('/css/media.css')}}">
    @toastr_css
    @yield('styles')
    <style>
        .fa-bell{
            position: relative !important;
        }
        .badge{
            display: block !important;
            color: #FFF;
            position: absolute;
            top: 10px;
            margin-right: 5px !important;  
            font-size: 16px
        }
    </style>
    <title>VG</title>
</head>

<body>

    <!-- Modal -->
    <div id="hmgModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">HMG Membership</h4>
            </div>
            <div class="modal-body">
                <p>مجموعة عمل المال الساخن
HMG work- group 


تم انشاء مجموعة عمل مستقلة متفرعة من التجمع الإفتراضي الرئيسي وتم اطلاق اسم مجموعة المال الساخن 
على هذه المجموعة ليتطابق الأسم مع النشاط وطريقة عمل هذه المجموعة الفرعية, 
فالتجمع الإفتراضي الرئيسي معني بالتعامل مع مختلف الاستثمارات والفرص على المدى المتوسط والطويل, ولكن تتوفر احيانا فرص استثمارية مميزة و نادرة اي تأخذ شكل " الصفقة " لكنها قصيرة الأجل وتتطلب اخذ قرار فوري للدخول بها من عدمه, وعليه قررت شركة التجمع الإفتراضي للإستثمار بعد نقاشات ومداولات مكثفة بين اعضاء التجمع الإفتراضي انشاء مجموعة عمل تعمل بصورة مستقلة عن التجمع الافتراضي الرئيسي ولكن يوجد بينهما ارتباط من ناحية تواجد الاعضاء بين المجموعتين, بحيث يحق لأعضاء مجموعة المال الساخن الانضمام تلقائياً للتجمع الرئيسي الافتراضي بينما لايحق لأعضاء التجمع الافتراضي الرئيسي الإنضمام لمجموعة المال الساخن الا بعد التأكد من المقدرة المالية للعضو الراغب بالانضمام لمجموعة المال الساخن
ان مجموعة المال الساخن تتميز بالتالي:-
•	جذب وطرح وتبادل فرص وصفقات سريعة شبه جاهزة وينقصها فقط السيولة للتنفيذ بين اعضاء المجموعة
•	سرعة المداولة والبت واخذ قرار الدخول من عدمه بين اعضاء المجموعة عبر نظام تصويت سريع
•	تقليل المخاطر عبر دخول عدة شركاء يقتسمون رأس المال المطلوب والتمتع بالأرباح وان كانت قليلة
•	الدخول في عدة فرص وصفقات في اي وقت وفي اي مكان نظراً لتجانس اعضاء المجموعة وقوة الروابط بينهم 
•	احقية الإنسحاب من عضوية المجموعة في اي وقت دون اي تبرير ودون اي تبعات قد تلحق بالعضو لاننا تطبق مفهوم " الافتراضية " هنا وكذلك في التجمع الافتراضي الرئيسي

ملحوظات هامة جداً
*  ان مجموعة عمل المال الساخن وبالرغم من وجود اعضاء متمرسين بها و خبراء في شتى المجالات ولديهم كافة المهارات يظل عامل المخاطرة موجود ويبقى الدخول في اي صفقة او فرصة قرار يتحمل مسؤوليته وتبعاته العضو منفردا 

*   ان التجارة بصفة عامة والحياة بصفة خاصة و كذلك مجموعة عمل المال الساخن لايوجد بها شئ مضمون   ومؤكد اي ان توقعك لتحقيقك ارباح لابد ان يعقبه توقع حصول خسارة في اي وقت فلابد ان تكون مهيئاً لتقبل الخسارة اذا حصلت تماماً كما تقبلك للربح  



للانضمام الى مجموعة عمل المال الساخن, الرجاء قم بتسجيل رقم جوالك بالأسفل وستصلك رسالة تفعيل (رمز تحقق) , إدخلها في الخانة المخصصة, وستنتقل بعدها لصفحة تسجيل طلب الإنضمام</p>
                    <button class="btn btn-primary">طلب الانضمام</button>
        </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            </div>

        </div>
    </div>

    <section>

        <div class="container mt-3 ">
            <div class="row warb">
                <div class="col-md-3 col-sm-9 bg-dar">
                    <div class="new-box ">
                        <figure>
                            <img id="avatar" src="{{URL::asset(Auth::user()->image)}}" alt="" class="rad" style="    max-width: 100%;">
                        </figure>
                    </div>
                    <div class="row">
                            <div class="col-sm-8 marg">
                                    <a href="{{URL::asset('/user/settings/profile/')}}" class="name-user font-weight-bold ml-2"> {{Auth::user()->first_name ." ".Auth::user()->last_name}}</a>
                                    <p class="position">{{Auth::user()->position}}</p>
                            </div>
                        </div>
                </div>

             <!-- search -->
             <div class="col-md-6   d">
                    <form class="form-wrapper">
                            <input type="text" id="search" placeholder="@lang('main.searchInput')" required>
                            <input type="submit" value="@lang('main.search')" id="submit">
                           
                        </form>
            </div>
            <!-- end search -->
                <div class="col-md-2   col-sm-3 bg-dange ">
                    <div class="circule ml-3">

                        
                        <a href="{{URL::asset('/user/settings')}}"> <i class="fas fa-cog text-white icon-contact"></i></a>
                    </div>
                </div>
            </div>

             <div class="row">
           <!-- search -->
           <div class="col-md-6  col-sm-12 d-none">
                <form class="form-wrapper">
                        <input type="text" id="search" placeholder="Search for..." required>
                        <input type="submit" value="go" id="submit">
                       
                    </form>
        </div>
        <!-- end search -->

            <div class="col-md-6 offset-md-4 col-sm-12 mr-3 text-center div-home-icon">
                <div class="collecated   text-center" style="display: flex;">
                    <div class="circule2 ml-3">
                        <a href="{{URL::asset('/')}}"> <i class="fas fa-home icon-contact2"></i></a></div>
                    <div class="circule2 ml-3"> <a href="{{URL::asset('/user/chats')}}"> <i class="fas fa-envelope icon-contact2"></i></a></div>
                    <div class="circule2 ml-3"> <a href="{{URL::asset('/group/chat')}}"> <i class="fas fa-users icon-contact2"></i></a></div>
                    <div class="circule2 ml-3"> <a href="{{URL::asset('/user/friends')}}"> <i class="fas fa-user icon-contact2"></i></a></div>
                     <div class="circule2 ml-3"> <a href="{{URL::asset('/user/friends/add')}}"> <i class="fas fa-user-plus icon-contact2"></i></a></div> 
                    <div class="circule2 ml-3"> <a href="{{URL::asset('/user/notifications')}}"><i class="fas fa-bell icon-contact2"></i><span class="badge">{{count(Auth::user()->unreadNotifications)}}</span></a></div>
                    <div class="circule2 ml-3"> <a data-toggle="modal" data-target="#hmgModal" href="#"><img height="40px" src="{{URL::asset('/img/hmg.png')}}"></a></div>
                    
                </div>
            </div>
        </div>
   
        </div>

    </section>

    <!-- <div class="row">
            <div class="col-md-4 offset-md-4 col-sm-12">

                <div class="collecated pt-5 text-center" style="display: flex;">
                    <div class="circule ml-3">
                        <a href=""> <i class="fab fa-facebook-f icon-contact text-white"></i></a></div>
                    <div class="circule ml-3"> <a href=""> <i
                                class="fab fa-twitter icon-contact text-white"></i></a></div>
                    <div class="circule ml-3"> <a href=""> <i
                                class="fab fa-linkedin-in icon-contact text-white"></i></a></div>
                    <div class="circule ml-3"> <a href=""> <i
                                class="fab fa-youtube icon-contact text-white"></i></a>
                    </div>
                </div>

            </div>
        </div> -->
@yield('content')
    <script src="{{URL::asset('/js/jq.js')}}"></script>
    <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            var list = $('.f');
            console.log(list);

            function hideElm() {
                $("#form-reg").hide();
                $("#form-log").hide();


            }
            hideElm();

            function definit() {
                $("#form-reg").show();
            }
            definit();
            $("#signup").click(function () {
                hideElm();
                $("#form-reg").show();

            });


            $("#signin").click(function () {
                hideElm();
                $("#form-log").show();

            });





        })

    </script>
    <script src="{{URL::asset('/js/ajaxFuns.js')}}"></script>
    @yield('scripts')
    @toastr_js
    @toastr_render

</body>

</html>