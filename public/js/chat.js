$(document).ready(function(){

    function request( type ,url , data){
        return new Promise(function(resolve, reject) {
            $.ajax({
                url:url,
                type:type,
                data:data
            }).done(function(response){
                resolve(response);
            })
        })
    }



    // send new smessage 
    $(".prepend").click(function(e){
        e.preventDefault();
        var data = $("#fmsg").serialize();
        request("post", '/user/chats/send/message', data).then(res=>{
                if(res['status']=="sent"){
                    var msg ='<div<div class="msg-container sender"><div class="message">'+res.message.content+'</div><br><p class="msg-time" style="color: #bdbac2;">'+res.message.time+'</p></div>';
                    console.log(msg);
                    $("#messages").append(msg);
                    $("#message").val("");
                }
        });
    });
 
 
 // load unread messages
    setInterval(() => {
        var friend_id = $("#friend_id").val();
        request("get" ,'/user/chats/'+friend_id+'/unread',null).then(res=>{
            if(res.status=="found"){
                res.messages.forEach(message=>{
                    var msg ='<div class="msg-container"><div class="message">'+message.message+'</div><br><p class="msg-time" style="color: #bdbac2;">'+message.created_at+'</p></div>';
                    $("#messages").append(msg);
                });
                
            }
        });
    }, 5000);

});