$(document).ready(function(){

    var baseURL = $('#baseURL').val();

    function request( type ,url , data){
        return new Promise(function(resolve, reject) {
            $.ajax({
                url:baseURL +url,
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
        var message   = $("#message").val();
        var friend_id = $("#friend_id").val();
        var conv_id = $("#conv_id").val();
        var data = new FormData();
        data.append('_token' , $("meta[name='_token']")[0].content);
        data.append('message', message);
        data.append('friend_id', friend_id);
        data.append('conv_id', conv_id);
        request("post", '/user/chats/send/message', data).then(res=>{
                if(res['status']=="sent"){
                    var msg ='<div class="msg-container sender"><div class="message">'+res.message.content+'</div><p class="msg-time" style="color: #bdbac2;">'+res.message.time+'</p></div>';
                    console.log(msg);
                    $("#messages").append(msg);
                    $("#message").val("");
                    $(".sent").scrollTop($(".sent")[0].scrollHeight);

                }
        });
    });
 
 
 // load unread messages
    setInterval(() => {
        var friend_id = $("#friend_id").val();
        request("get" ,'/user/chats/'+friend_id+'/unread',null).then(res=>{
            if(res.status=="found"){
                res.messages.forEach(message=>{
                    if(message.type == "text"){

                        var msg ='<div class="msg-container"><div class="message">'+message.message+'</div><br><p class="msg-time" style="color: #bdbac2;">'+message.created_at+'</p></div>';
                        $("#messages").append(msg);
                    }
                    else if(message.type == 'video'){
                        var video = '<div class="msg-container"><div class="message" style="background:none;padding:0 !important"><video controls width="250px" height="250px" src="/app/public'+message.message+'"></video></div><p class="msg-time mt-2" style="color: #bdbac2;">'+message.created_at+'</p></div>';
                        $("#messages").append(video);
                    }
                    else if(message.type == "image"){
                        // alert("dsadsa");
                        var img = '<div class="msg-container"><div class="message" style="background:none;padding:0 !important"><img width="150px" height="150px" src="/app/public'+message.message+'"></img></div><p class="msg-time mt-2" style="color: #bdbac2;">'+message.created_at+'</p></div>';
                        $("#messages").append(img);
                    }else if(message.type == "application"){
                        var file = '<div class="msg-container"><div class="message" style="background:none;padding:0 !important"><a href="/app/public'+message.message+'">Attachment</a></div><p class="msg-time mt-2" style="color: #bdbac2;">'+message.created_at+'</p></div>';
                        $("#messages").append(file);
                    }
                    $(".sent").scrollTop($(".sent")[0].scrollHeight);

                });
                
            }
        });
    }, 5000);


    $(".choose").click(function(){
        $("#attach").click();
    });
    $("#attach").change(function(){
        if($("#attach").val() != ''){
            uploadAttach(this)
        }
    });


    function uploadAttach(item){
        var data = new FormData();
        data.append('_token' , $("meta[name='_token']")[0].content);
        data.append('file', item.files[0]);
        data.append('friend_id', $("#friend_id").val());
        
        request('post' , '/single/chat/send/file',data).then(res=>{
            if(res.type == 'video'){
                var video = '<div class="msg-container sender"><div class="message" style="background:none;padding:0 !important"><video controls width="250px" height="250px" src="/app/public'+res.url+'"></video></div></div>';
                $("#messages").append(video);
            }
            else if(res.type == "image"){
                var img = '<div class="msg-container sender"><div class="message" style="background:none;padding:0 !important"><img width="150px" height="150px" src="/app/public'+res.url+'"></img></div></div>';
                $("#messages").append(img);
            }else if(res.type == "application"){
                var file = '<div class="msg-container sender"><div class="message" style="background:none;padding:0 !important"><a href="/app/public'+res.url+'">Attachment</a></div></div>';
                $("#messages").append(file);

            }
        $(".sent").scrollTop($(".sent")[0].scrollHeight);

        })
    }


    var recorder, gumStream;
    var recordButton = document.getElementById("recordButton");
    recordButton.addEventListener("click", toggleRecording);


    function toggleRecording() {
        if (recorder && recorder.state == "recording") {
            recorder.stop();
            gumStream.getAudioTracks()[0].stop();
        } else {
            navigator.mediaDevices.getUserMedia({
                audio: true
            }).then(function(stream) {
                gumStream = stream;
                recorder = new MediaRecorder(stream);
                recorder.ondataavailable = function(e) {
                    var url = URL.createObjectURL(e.data);
                    console.log(url);
                    var data = new FormData();
                    data.append("_token" , $("meta[name='_token']")[0].content );
                    data.append('file' , e.data);
                    request('post' , '/group/chat/send/file', data).then(res=>{
                        var audio = '<div class="msg-container sender"><div class="message" style="background:none;padding:0 !important"><audio controls width="250px" height="250px" src="/app/public'+res.url+'"></audio></div></div>';
                        $("#messages").append(audio);
                    });
                };
                recorder.start();
            });
        }
    }

    $(document).on('click', '.delete-message', function(e) {
        e.preventDefault();
        var result = confirm("are you sure to delete this message?");

        if(result){

            var message_id   = $(this).attr('data-delete');
            var data = new FormData();
            data.append('_token' , "{{ csrf_token() }}");
            data.append('message_id', message_id);
            request("get", '/user/chats/delete-message/'+message_id, data).then(res=>{
                if(res['status']=="success"){
                    $(this).parents('.msg-container').hide();
                }
            });
        }

    });






});