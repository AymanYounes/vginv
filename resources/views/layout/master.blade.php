<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="lang" charset="UTF-8" lang="{{session('locale')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="_token" content="{{csrf_token()}}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
        integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{secure_asset('/css/style.css')}}">
    <link rel="stylesheet" href="{{secure_asset('/css/media.css')}}">
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
        .div-home-icon{
            margin:  0 auto !important;
        }
    </style>
    <title>VG</title>
</head>

<body>

    <!-- Modal -->
    <div id="hmgModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

           <div class="modal-content">
      <div class="modal-header text-center">
        <h5 class="modal-title  align-center " id="exampleModalLongTitle">
                شركة التجمع الافتراضي vginv.com
        <br>
    اتفاقية " الضوابط و الأحكام "
        </h5>
     
        
        <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
        <!--  <span aria-hidden="true">&times;</span>-->
        <!--</button>-->
        
        <div> 
            {{-- <a class="navbar-brand" href=""><img src="img/Layer1.png" class="img-logo"> --}}
                 
            <!--<span class="text-white font-weight-bold " style="   font-size: 32px;">VG</span>-->
            <!-- <span class="text-white  font-weight-bold" style="   font-size: 23px;">INV</span> -->
        </a> </div>
      </div>
      <div class="modal-body">



<h3 class="text-center">(تطبيق VG) المشروعات قصيرة،متوسطة،طويلة الاجل
</h3>

<h3>
أوافق أنا
     
    <span id="fulename" >{{Auth::user()->first_name." ".Auth::user()->last_name}}</span></h3>
<span>انه فى تاريخ</span>
<span id="datem">{{date('y-m-d H:i:s' ,time())}}</span>
<span>قد وافقت على التالى </span>


     <ul>
         -	ان العناصر المكونة لمشروع التجمع الإفتراضي هي على النحو التالي:- 
         <li>•	شركة التجمع الافتراضي للإستثمار, مقرها الرئيسي (مدينة الرياض،المملكة العربية السعودية)وجاري التوسع محلياً و دولياً </li>
         
         <li> •	موقع شركة التجمع الإفتراضي على الانترنت www.vginv.com  </li>
         
         <li> •	تطبيق التجمع الإفتراضي على منصات ابل ستور و اندرويد تحت اسم ( vg ) بقسميه (HMG & VG)
         
         </li>
         
         
     </ul>
     
     <p>» ان هذه العناصر مجتمعه او منفردة تمثل أصل وروح مشروع (شركة التجمع الإفتراضي) التي طرحها وتبناها المهندس/ سالم المسرحي, وبالتالي فإن قبولك بالإنضمام والتوقيع على هذه الوثيقة (الكترونياً) عبر تطبيق او موقع شركة التجمع الافتراضي للاستثمار على الانترنت يعني قبولك بما جاء في هذه الإتفاقية من ضوابط واحكام. 
   
   <br>
   حيث ان (اعضاء التجمع الإفتراضي) يخضعون لضوابط وأحكام هذه الإتفاقية وافق جميع الاعضاء على اعتبار هذه الإتفاقية بمثابة المرجع الذي يضبط وينظم طريقة عمل شركة التجمع الافتراضي. 
   
     </p>
     <p>
        » الهدف الرئيسي: من إنشاء واطلاق شركة التجمع الافتراضي هو جمع أكبر عدد من الأعضاء المؤمنين بفكرة التعامل بالإفتراضية في (عالم المال والأعمال) وبالتالي قامت (شركة التجمع الافتراضي للاستثمار) بتوفير بيئة افتراضية مثالية تتكون من أعضاء مميزون يتوفر لديهم رؤوس اموال حاضرة قادرة على الدخول في مختلف الفرص الاستثمارية المطروحة والتي قد تناسبهم جماعيا او من خلال تكتلات جانبية بين الاعضاء.  
     </p>
     <p>
         » استوعب جميع الأعضاء ووافقوا واعتمدوا اساس وطريقة عمل (شركة التجمع الإفتراضي) وهي (الإفتراضية)
         
         
         <br>
         اي انه لايوجد الزام ولا التزام لأي عضو من ناحية قبول ما يعرض من مشروعات،أو افكار،او فرص استثمارية،وكذلك حضور اجتماعات العمل من عدمه،فلكل عضو كامل حرية القبول او الرفض دون الحاجة لابداء الاسباب او التبرير.
     </p>
     
     <p>
        » في حال رغب اياً من الأعضاء مغادرة (التجمع الإفتراضي) والخروج من تلقاء نفسه فإن له كامل الحق في ذلك وقتما يشاء ودون الحاجة للتبرير ودون أي مسائلة أو تبعات. 
         
         
     </p>
     <p>
         » يحق لأي عضو طرح مايشاء من فرص وأفكار وتصورات واقتراحات استثمارية وفق السياسات والضوابط،شريطة مراعاة الدقة والمصداقية فيما يطرحه،ويكون مايعرضه واقعي وقابل للتطبيق ويفضل الجهوزية الكاملة عند طرح المشاريع اي توفر(الدراسات، وملخصات، وميزانيات، والعوائد، والمخاطر، والارباح،ومستندات ملكية المشروع ، وغيرها من الأمور الإعتيادية ذات الصلة) 
         
     </p>
     <p>
         » ان كل مايطرحه أي عضو (بالتجمع الإفتراضي)من فرص وأفكار وتصورات واقتراحات استثمارية، تعتبر حقاً مشاعاً لجميع الاعضاء من ناحية التصرف بها منذ اللحظة التي تم طرحها فيها, ولا يحق لمن طرح هذه العروض الاعتراض أو طلب تعويض إذا تصرف اي عضو او أعضاء بهذه العروض واستغلوها وحققوا فوائد مادية ومعنوية من ورائها.
         
     </p>
     
     <p>
         » يلتزم الاعضاء بتقديم الافكار او المشروعات او الفرص الاستثمارية من خلال بند (انشاء مشروع)من داخل التطبيق الالكتروني او الموقع الالكتروني،وسيتم مراجعة كامل البيانات من ادارة (شركة التجمع الافتراضي)ومن ثم يتم عرضه علي الاعضاء بعد مراجعه كافة الشروط للمشروع،والتأكد من جاهزية المشروع لعدم ازعاج او تشتيت الاعضاء بمشروعات وهميه او مشروعات غير مكتملة البيانات.
         
     </p>
     
     <p>
         » يحق لأي عضو العمل منفرداً وكذلك بحق له العمل جماعيا ويحق له كذلك الإتحاد والتضامن ومقابلة من يشاء من أعضاء التجمع الافتراضي عبر مختلف المجالات والوسائل المتاحة سواء الكترونيا او شخصياً.
     </p>
     <p>
         » إذا توافق عضو أو مجموعة من الأعضاء على تنفيذ مشروع أو صفقة ما في أي موقع جغرافي بالعالم وتم دراستها والتأكد من كافة نواحيها الاقتصادية والمالية وتم اعتمادها للتنفيذ، يقرر الجميع الطريقة الأكثر أماناً وقانونية لرصد و جمع ونقل المال المطلوب للدخول في هذا المشروع أو الصفقة، أي أنه يتم التعامل مع كل حالة وفقاً لما يتم الإتفاق عليه بين الأعضاء المساهمون في هذه العملية التجارية.
         
     </p>
     
     <p>
         » علم جميع الأعضاء أن تطبيق التجمع الافتراضي على الابل ستور والاندرويد (VG) هو المنصة الرسمية الوحيدة التي تتم من خلالها كافة النقاشات وطرح الأفكار والتصورات والاقتراحات وكذلك مناقشة الاستفسارات الموجودة لدى الأعضاء.
         
     </p>
     <p>
         » لا يتحمل طارح الفكرة ومتبنيها ولا إدارة شركة التجمع الافتراضي ولا أي عضو في التجمع الإفتراضي أخطاء الغير وكذلك لايتحملون أي نتائج سلبية قد يحدثها أحد الأعضاء عن عمد او غير عمد سواء بطريقة مباشرة أو غير مباشرة، فكل عضو يتحمل مسؤلية نفسه ومسؤلية تصرفاته.
     </p>
     
     <p>
         » دخول شركاء مساهمون بالتأسيس – على من يرغب الدخول – شريكًا مساهمًا في شركة التجمع الافتراضي للإستثمار، قراءة كافة التفاصيل الخاصة بهذه النقطة عبر الموقع الرسمي لشركة التجمع الافتراضي للاستثمار على الانترنت وكذلك تقديم طلب الحصول على أسهم التأسيس (إذا كانت متاحة) من خلال نفس الموقع.
         
     </p>
     
     <p>
         » يتحمل أي عضو من أعضاء (التجمع الإفتراضي) منفردًا أي مسؤولية قانونية او ادعائات اجرائية من الجهات المختصة ذات الصلة في حال ثبت بأنه قدم فكرة مشروع أو صفقة مشبوهة او مسروقة أو غير معلومة المصدر ونسبها الى نفسه، ولا يتحمل أي عضو مساهم أو مشارك في هذه العملية المسؤولية عن ذلك وكذلك لا تتحمل  شركة التجمع الافتراضي أو من يمثلها المسؤولية عنها.
     </p>
     
     <p>
         »  يتحمل أي عضو قدم بيانات شخصية غير حقيقة أو مزيفة أو ليست عائده له او انتحل صفة ليست به، المسؤولية كاملة إذا ما تم فتح تحقيق في ذلك عبر الجهات المختصة ويخلي كافة (اعضاء التجمع الإفتراضي) وشركة التجمع الافتراضي أو من يمثلها أنفسهم من أي مسؤولية قد تترتب على ذلك.
     </p>
     <p>
         » يحق لشركة التجمع الافتراضي للاستثمار او من يمثلها حذف أي بيانات غير صحيحة أو مشتبه بها أو غير كاملة او لا تحوى اسمًا كاملاً صريحاً تم تسجيلها من خلال جميع الوسائل الموضحة بمقدمة هذه الاتفاقية.
     </p>
     
     <p>
         » يلتزم كل عضو من الأعضاء بقواعد وقوانين المحادثات عبر الشات الجماعي أو الخاص من داخل التطبيق او الموقع الالكتروني.
         
     </p>
     <ul>
         <li>
             ــ طرح المشروعات يكون من خلال القسم المخصص لها بالتطبيق، وليس عبر الشات الجماعي.
             
         </li>
         
             <li>
                    ــ عدم التعرض للسخرية لشعب،او لعرق، او دين، او حكومة،أو أشخاص.
                
            </li>
            
         <li>
             ــ عدم التعرض للأعضاء بالسباب أو الخروج عن الأدب أو الخروج عن المناقشات المتحضرة.
             
         </li>
         
                 <li>
                          ــ الشات الخاص بالشركة مخصص للمال والاعمال فقط.
                      
                      
                  </li>
                         
                  <li>    ـــ لا يسمح بنشر الادعية أو المباركات او الصور الغير مخصصة للمال والاعمال.</li>
   
                          <li>
                 ــ لا يسمح بنشر او عرض وظائف داخل التطبيق.
             
         </li>
        
         
            
   <li>
       
       ولادارة الشركة كامل الحق في اتخاذ الإجراء المناسب في حال حصول هذه المخالفات. 
       
   </li>
   
        
     </ul>
     
          
     <p>
       » يحق لإدارة شركة التجمع الافتراضي التصرف في الغاء عضوية أي عضو وإخراجه من (التجمع الإفتراضي) في حال تأكد له قيام هذا العضو بمخالفات، ومنها قيامه بالتشويش والشوشرة، أو التضليل والتدليس، أو إعطاء بيانات غير صحيحة، أو بقاء العضو مجمد ومتوقف عن الحركة لفترة طويلة دون أي تفاعل او مشاركة وكذلك عدم تمكنه من إثبات كفائته المالية عند الطلب.
     </p>
     <p>
         » يحق لإدارة شركة التجمع الافتراضي التحقق من هوية أو طلب بيانات ومستندات إثبات شخصية أي عضو من الأعضاء، وذلك للتأكد من شخصية العضو والحفاظ علي سلامة باقي الاعضاء.
     </p>
     
     <p>
         » إن الحد الأدنى لقبول واستمرارية العضوية لكافة أعضاء (شركة التجمع الإفتراضي) هو توفر كفاءة مالية بمبلغ 500 ألف ريال سعودي أو مايعادلها بالعملات الأخرى كحد أدنى، ويحق لإدارة شركة التجمع الافتراضي التحقق من الكفاءة المالية من كافة الأعضاء في أي وقت لضمان جودة مستوى الأعضاء والتأكد أن الجميع هم على نفس المستوى والكفاءة والجهوزية المالية .
     </p>
     <p>
         » شركة التجمع الافتراضي غير ملزمة بأي ضمان أو التدخل في أي خلافات في حال إتمام الاتفاق علي صفقات خارج مظلة شركة التجمع الافتراضي.
         
     </p>
     <p>
         » وافق الأعضاء على استقطاع ما نسبته 5% من صافي أرباح أي عملية كان التجمع الإفتراضي طرفًا مباشراً أو غير مباشر بها،أي سواء عبر الأعضاء الحاليين أو من خلال أشخاص (خارج التجمع الإفتراضي) غير أعضاء و دخلوا في مشاريع كان لأحد أعضاء التجمع الإفتراضي صله بها، وتبقى هذه النسبة حق و ذمة حتى يتم دفعها لشركة التجمع الإفتراضي للاستثمار.
     </p>
     
     <p>
         » قررت شركة التجمع الافتراضي للإستثمار استقطاع نسبة (1%) من نسبة صافي الارباح الـ(5%)  لصالح مختلف الأعمال الخيرية في أي مكان بالعالم وسنقوم بإنشاء مؤسسة خيرية لتتولى هذه المهمة بإذن الله.
     </p>
     
     <p>
         » علم جميع أعضاء (التجمع الافتراضي) أن اتفاقية الضوابط والأحكام هذه ليست لها فترة صلاحية محددة وتظل سارية المفعول إلا إذا تم إلغائها عبر إخطار جميع الأعضاء كتابياً، وسيتم تحديثها كلما دعت الحاجة الى ذلك.
     </p>
     
     
     
     
   
     
     
     
     
        <a href="{{URL::asset('/vg/condition')}}" class="btn btn-primary">موافق</a>
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
                            <img id="avatar" src="{{asset(Auth::user()->image)}}" alt="" class="rad" style="    max-width: 100%;">
                        </figure>
                    </div>
                    <div class="row">
                            <div class="col-sm-8 marg">
                                    <a href="{{URL::asset('/myProfile/')}}" class="name-user font-weight-bold ml-2"> {{Auth::user()->first_name ." ".Auth::user()->last_name}}</a>
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
            <!-- logout -->
            <div class="col-md-1 col-sm-3 bg-dange ">
                <a class="btn btn-primary" href="{{URL::asset('/logout')}}" role="button" style="    background-color: rgba(74, 105, 255,100%);">Log Out</a>
            </div>
            <!-- end logout -->
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
                    <div class="circule2 ml-3 {{(\Request::segment(1)=='' )?"menu-active":""}}" data-toggle="tooltip" title="@lang('main.home')">
                        <a href="{{URL::asset('/')}}"> <i class="fas fa-home icon-contact2"></i></a></div>
                    <div class="circule2 ml-3 {{(\Request::segment(1)=='projects' )?"menu-active":""}}" data-toggle="tooltip" title="@lang('main.categories')">
                        <a href="{{URL::asset('/projects/dep/all')}}"><i class="fas fa-tasks icon-contact2"></i></a>
                    </div>
                    <div class="circule2 ml-3 {{((\Request::segment(1)=='user' && \Request::segment(2)=='all-chats' )||(\Request::segment(1)=='user' && \Request::segment(2)=='chats' ))?"menu-active":""}}" data-toggle="tooltip" title="@lang('main.inbox')">
                        <a href="{{URL::asset('/user/all-chats')}}">
                            <i class="fas fa-envelope icon-contact2"></i>
                            <span class="badge">{{getUnreadMessages(Auth::user()->id)}}</span>
                        </a>
                    </div>
                    <div class="circule2 ml-3 {{(\Request::segment(1)=='group' )?"menu-active":""}}" data-toggle="tooltip" title="@lang('main.groupChat')">
                        <a href="{{URL::asset('/group/chat')}}"> <i class="fas fa-comments icon-contact2"></i></a>
                    </div>
                    <div class="circule2 ml-3 {{(\Request::segment(1)=='user' && \Request::segment(2)=='friends' && !\Request::segment(3) )?"menu-active":""}}" data-toggle="tooltip" title="@lang('main.friends')">
                        <a href="{{URL::asset('/user/friends')}}"> <i class="fas fa-users icon-contact2"></i></a>
                    </div>
                    <div class="circule2 ml-3 {{(\Request::segment(1)=='user' && \Request::segment(2)=='friends' && \Request::segment(3)=='add' )?"menu-active":""}}" data-toggle="tooltip" title="@lang('main.addFriends')">
                        <a href="{{URL::asset('/user/friends/add')}}"> <i class="fas fa-user-plus icon-contact2"></i></a>
                    </div>
                    <div class="circule2 ml-3 {{(\Request::segment(1)=='user' && \Request::segment(2)=='notifications' )?"menu-active":""}}" data-toggle="tooltip" title="@lang('main.settings.notify')">
                        <a href="{{URL::asset('/user/notifications')}}">
                            <i class="fas fa-bell icon-contact2"></i>
                            <span class="badge">{{count(Auth::user()->unreadNotifications)}}</span>
                        </a>
                    </div>
                    @if(session('type') == 'vg' && Auth::user()->type =="vg")
                        <div class="circule2 ml-3">
                            <a href="http://vginv.com/questionhmg.html?{{Auth::user()->phone}}">
                                <img height="40px" src="{{asset('/img/hmg.png')}}" data-toggle="tooltip" title="@lang('main.ToggleVG')">
                            </a>
                        </div>
                    @elseif(session('type') == 'vg' && Auth::user()->type =="hmg")
                        <div class="circule2 ml-3">
                            <a href="{{URL::asset('/type/toggle')}}">
                                <img height="40px" src="{{asset('/img/hmg.png')}}"  data-toggle="tooltip" title="@lang('main.ToggleHMG')">
                            </a>
                        </div>
                        @elseif(Auth::user()->condition == 0)
                        <div class="circule2 ml-3">
                            <a data-toggle="modal" data-target="#hmgModal" href="#" >
                                <img height="40px" src="{{asset('/img/vg.png')}}" data-toggle="tooltip" title="@lang('main.ToggleVG')">
                            </a>
                        </div>
                    @else
                    <div class="circule2 ml-3">
                            <a href="{{URL::asset('/type/toggle')}}">
                                <img height="40px" src="{{asset('/img/vg.png')}}" data-toggle="tooltip" title="@lang('main.ToggleVG')">
                            </a>
                        </div>
                    @endif
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


    @include('hiddens/global');
@yield('content')
    <script src="{{asset('/js/jq.js')}}"></script>
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
    <script src="{{asset('/js/ajaxFunsV1.js')}}"></script>
    <script src="{{asset('/js/global.js')}}"></script>
    @yield('scripts')
    @toastr_js
    @toastr_render

</body>

</html>