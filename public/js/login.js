
$(document).ready(function() {

    var baseURL = $('#baseURL').val();


    function request( type ,url , data){
        return new Promise(function(resolve, reject) {
            $.ajax({
                url:baseURL + url,
                type:type,
                data:data
            }).done(function(response){
                resolve(response);
            })
        })
    }


    var countryId = $(".pro_country").attr("data-initId");
    var cityId = $(".pro_city").attr("data-initId");

    request('get','/countries',null)
    .then(res=>{
        $(".country").html('');
        $(".country").append("<option value='' selected>Country</option>");
        res.forEach(country => {
            $(".country").append('<option value="'+country.id+'" '+ ((countryId == country.id)?"selected":"") +'>'+country.name+'</option>');
        });
    });

    getCities(countryId);

    function getCities(country_id){
        request('get','/countries/'+country_id+'/cities',null)
        .then(res=>{
            $(".city").html('');
            $(".city").append("<option value='' selected>City</option>");
            res.forEach(city => {
                $(".city").append('<option value="'+city.id+'" '+((cityId == city.id)?"selected":"")+'>'+city.city_name+'</option>');
            });
        });
    }
    $(".country").change(function(){
       var country_id =  $( ".country option:selected" ).val();
       getCities(country_id);
    })


    ////////////// edit Profile ////////////////











     // var cityId = $("meta[name='city']").attr("content");
     //    request('get' , '/cities/'+cityId+'/country').then(res=>{
     //        $(".pro_country option[value='"+res.country_id+"']").attr("selected" ,true);
     //        getCities(res.country_id);
     //
     //    });
     //    setTimeout(() => {
     //        $(".city option[value='"+cityId+"']").attr('selected',true);
     //    }, 5000);
})