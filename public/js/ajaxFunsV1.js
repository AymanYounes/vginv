$(document).ready(function(){
 // $('#exampleModal').modal({backdrop: 'static'});



    var baseURL = $("#baseURL").val();


    function request( type ,url , data){
        return new Promise(function(resolve, reject) {
            $.ajax({
                // url:"/app/public" +url,
                url:baseURL +url,
                type:type,
                data:data
            }).done(function(response){
                resolve(response);
            })
        })
    }

    // alert("sasda");

    ////////////////////////// get Countries and Cities/////////////////////////////////////
    function getCountries(){
        request('get','/countries',null)
        .then(res=>{
            $(".country").html('');
            $(".country").append("<option value='' selected>Country</option>");
            res.forEach(country => {
                $(".country").append('<option value="'+country.id+'">'+country.name+'</option>');
            });
            $(".country option[value='94']").attr('selected',true);
        });
    }

    function getCities(country_id){
        request('get','/countries/'+country_id+'/cities',null)
            .then(res=>{
                $(".city").html('');
            $(".city").append("<option value='' selected>City</option>");
                res.forEach(city => {
                    $(".city").append('<option value="'+city.id+'">'+city.city_name+'</option>');
                });
            });
    }

    function getDepartments(){
        request('get','/countries/'+country_id+'/cities',null)
            .then(res=>{
                $(".deps").html('');
                $(".deps").append("<option value='' selected>Choose...</option>");
                res.forEach(dep => {
                    if($("meta[name='lang']")[0].lang == "ar"){
                        $(".deps").append('<option value="'+dep.id+'">'+dep.dep_ar+'</option>');
                    }else{
                        $(".deps").append('<option value="'+dep.id+'">'+dep.dep_en+'</option>');
                    }
                });
            });


            // $.ajax({
            //
            //     url:baseURL +"/departments",
            //     // url:"/vg/public/departments",
            //     type:"get",
            // }).done(function(res){
            //     $(".deps").html('');
            //     $(".deps").append("<option value='' selected>Choose...</option>");
            //     console.log(res);
            //     res.forEach(dep => {
            //         if($("meta[name='lang']")[0].lang == "ar"){
            //             $(".deps").append('<option value="'+dep.id+'">'+dep.dep_ar+'</option>');
            //         }else{
            //             $(".deps").append('<option value="'+dep.id+'">'+dep.dep_en+'</option>');
            //         }
            //     });
            // })

    }
    ////////////////////////// get Countries and Cities/////////////////////////////////////


    ////////////////////////// add Project /////////////////////////////////////
    $("#exampleModal").on("show.bs.modal",function(){
        getCountries();
        getCities(94);
        getDepartments();

    })

    $(".country").change(function(){
        var country_id =  $(".country option:selected").val();
        getCities(country_id);

    });
    ////////////////////////// add Project /////////////////////////////////////
    
    
   /////////// comment //////////
   $("#comment").keypress(function(e){
        if(e.which == '13'){
            var data = $("#commForm").serialize();
            $("#comment").val("").empty();
            request("post" , '/project/add/comment',data).then(res=>{
                if(res.status == "added"){
                    var uImage = $("#avatar")[0].attributes.src.nodeValue;
                    var userName = $(".name-user").text();
                    var comHtml = '<div class="post-comment"><div class="title mb-3" style=" display: inline-block;"><div class="users-thumb-list" style="margin-top: 5px"><a href="/user/"'+res.comment.user_id+'"/profile" class="head-project  pl-2  " style="font-size:19px; color: rgba(74, 105, 255,100%)" title="" data-toggle="tooltip"data-original-title="Anderw"><img src="'+uImage+'" width="50px" height="50px" alt="">'+userName+'</a></div>';
                        comHtml +='</div><div class="we-comment mb-3 mt-3" style="width:10%"><div class="coment-head"><span>Just Now</span></div>';
                        comHtml +='<p>'+res.comment.comment+'</p>';
                        comHtml +='<div class="news-post-meta"></div></div><br></br>';
                    
                    $(".comments").prepend(comHtml);
                }
            })
        }
    })


    $("#postCommnet").keypress(function(e){
        if(e.which == '13'){
            var data = $("#postForm").serialize();
            $("#postCommnet").val("").empty();
            request("post" , '/posts/add/comment',data).then(res=>{
                if(res.status == "added"){
                    var uImage = $("#avatar")[0].attributes.src.nodeValue;
                    var userName = $(".name-user").text();
                    var comHtml = '<div class="title mb-3" style=" display: inline-block;"><div class="users-thumb-list" style="margin-top: 5px"><a href="/user/"'+res.comment.user_id+'"/profile" class="head-project  pl-2  " style="font-size:19px; color: rgba(74, 105, 255,100%)" title="" data-toggle="tooltip"data-original-title="Anderw"><img src="'+uImage+'" width="50px" height="50px" alt="">'+userName+'</a></div>';
                        comHtml +='</div><div class="we-comment mb-3 mt-3" style="width:100%;; border:none;    border-radius: 10px;background-color: #000000;color:#fff;"><div class="coment-head"><span>Just Now</span></div>';
                        comHtml +='<p>'+res.comment.comment+'</p>';
                        comHtml +='<br></br>';
                    
                    $(".comments").prepend(comHtml);
                }
            })
        }
    })

/////////// comment //////////



/////////// like Project //////////
    $("#proLike").click(function(){
        var pro_id = this.title;
        console.log(pro_id);
        
        request("post" , '/project/'+pro_id+'/like',{'_token':$("meta[name='_token']")[0].content}).then(res=>{
            if(res.status == "done"){
                $("#proLike").removeClass('far').addClass('fas');
                $("#likes").text(Number($("#likes").text())+1);
            }
        })
    })

/////////// like Project //////////

/////////// invest  //////////

    $(".investModel").click(function(){
          $("#exampleModalCenter").modal("show");
          $("#project_id").val(this.title);
    })

    $("#invest").click(function(){
          var data = $("#investForm").serialize();
          request("post" , '/project/invest' ,data).then(res=>{
            if(res.status =="exists"){
                $(".exists").css('display' , 'block');
            }else if(res.status == "done"){
                $(".done").css('display' , 'block');
            }else{
                $(".error").css('display' , 'block');
            }
          });
    });
      
      
/////////// invest //////////

/////////// deps //////////
    $("#deps").change(function(){
        var dep_id =  $("#deps option:selected").val();
        window.location.href='/app/projects/dep/'+dep_id;        
    });
/////////// deps //////////
})
