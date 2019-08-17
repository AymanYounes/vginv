$(document).ready(function(){

    function request( type ,url , data){
        return new Promise(function(resolve, reject) {
            $.ajax({
                url:url,
                type:type,
                data:data,
                processData: false,
                contentType: false,
            }).done(function(response){
                resolve(response);
            })
        })
    }



    // send new smessage 
    $(".prepend").click(function(e){
        e.preventDefault();
        var message = $("#message").val(); 
        var uImage = $("#avatar")[0].attributes.src.nodeValue;     
        var userName = $(".name-user").text();
        var data = $("#fmsg").serialize();
        request("post", '/group/chat/send/message', data).then(res=>{
                if(res['status']=="sent"){                    
                    var msg = '<div class="msg-container sender"><div class="headline" style="margin-left:10px"><span>'+userName+'</span><img width="35px" height="35px" src="'+uImage+'" alt="avatar"></div><div class="message">'+message+'</div><br><p class="msg-time" style="color: #bdbac2;">just now</p></div>';
                    $("#messages").append(msg);
                    $("#message").val("");
                }
        });
    });
 
 
 // load unread messages
    setInterval(() => {
        request("get" ,'/group/chat/unread',null).then(res=>{
            if(res.status=="found"){
                res.messages.forEach(message=>{
                    var msg = '<div class="msg-container"><div class="headline" style="margin-left:10px"><img width="35px" height="35px" src="'+message.image+'" alt="avatar"><span>'+message.first_name+' '+message.last_name+'</span></div><div class="message">'+message.message+'</div><br><p class="msg-time" style="color: #bdbac2;">just now</p></div>';
                    $("#messages").append(msg);
                });
                
            }
        });
    }, 5000);




    $("#choose").click(function(){
        $("#attach").click();
    });
    $("#attach").change(function(){
        if($("#attach").val() != ''){
            uploadAttach(this)
            // console.log(this.files[0]);
        }
    });


    function uploadAttach(item){
        console.log("item");
        console.log(item.files[0]);
        var data = new FormData();
        data.append('_token' , $("meta[name='_token']")[0].content);
        data.append('file', item.files[0]);
        request('post' , '/group/chat/send/file',data).then(res=>{
            console.log(res);
        })
    }

});