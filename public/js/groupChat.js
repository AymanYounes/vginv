$(document).ready(function(){

    function request( type ,url , data){
        return new Promise(function(resolve, reject) {
            $.ajax({
                url:"https://vginv.com/app" +url,
                type:type,
                data:data,
                processData: false,
                contentType: false,
            }).done(function(response){
                resolve(response);
            })
        })
    }

    var uImage = $("#avatar")[0].attributes.src.nodeValue;     
    var userName = $(".name-user").text();

    // send new smessage 
    $(".prepend").click(function(e){
        e.preventDefault();
        var message = $("#message").val(); 
        var uImage = $("#avatar")[0].attributes.src.nodeValue;     
        var userName = $(".name-user").text();
         var data = new FormData();
        data.append('_token' , $("meta[name='_token']")[0].content);
        data.append('message', message);
        request("post", '/group/chat/send/message', data).then(res=>{
                if(res['status']=="sent"){                    
                    var msg = '<div class="msg-container sender"><div class="headline" style="margin-left:10px"><span>'+userName+'</span><img width="35px" height="35px" src="'+uImage+'" alt="avatar"></div><div class="message">'+message+'</div><br><p class="msg-time" style="color: #bdbac2;">just now</p></div>';
                    $("#messages").append(msg);
                    $("#message").val("");
                    $(".sent").scrollTop($(".sent")[0].scrollHeight);

                }
        });
    });
 
 
 // load unread messages
    setInterval(() => {
        request("get" ,'/group/chat/unread',null).then(res=>{
            if(res.status=="found"){
                res.messages.forEach(message=>{
                    if(message.type == "text"){
                        var text = '<div class="msg-container sender"><div class="headline" style="margin-left:10px"><span>'+message.fname+" "+message.lname+'</span><img width="35px" height="35px" src="/app/public'+message.image+'" alt="avatar"></div><div class="message sender" style="background:none;padding:0 !important">'+message.message+'</div></div>';
                        $("#messages").append(text);
                    }
                    else if(message.type == 'video'){
                        var video = '<div class="msg-container sender"><div class="headline" style="margin-left:10px"><span>'+message.fname+" "+message.lname+'</span><img width="35px" height="35px" src="/app/public'+message.image+'" alt="avatar"></div><div class="message sender" style="background:none;padding:0 !important"><video controls width="250px" height="250px" src="/app/public'+message.message+'"></video></div></div>';
                        $("#messages").append(video);
                    }
                    else if(message.type == "image"){
                        var img = '<div class="msg-container sender"><div class="headline" style="margin-left:10px"><span>'+message.fname+" "+message.lname+'</span><img width="35px" height="35px" src="/app/public'+message.image+'" alt="avatar"></div><div class="message" style="background:none;padding:0 !important"><img width="150px" height="150px" src="/app/public'+message.message+'"></img></div></div>';
                        $("#messages").append(img);
                    }else if(message.type == "application"){
                        var file = '<div class="msg-container sender"><div class="headline" style="margin-left:10px"><span>'+message.fname+" "+message.lname+'</span><img width="35px" height="35px" src="/app/public'+message.image+'" alt="avatar"></div><div class="message" style="background:none;padding:0 !important"><a href="/app/public'+message.message+'">Attachment</a></div></div>';
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
            if(res.type == 'video'){
                var video = '<div class="msg-container sender"><div class="headline" style="margin-left:10px"><span>'+userName+'</span><img width="35px" height="35px" src="'+uImage+'" alt="avatar"></div><div class="message sender" style="background:none;padding:0 !important"><video controls width="250px" height="250px" src="/app/public'+res.url+'"></video></div></div>';
                $("#messages").append(video);
            }
            else if(res.type == "image"){
                var img = '<div class="msg-container sender"><div class="headline" style="margin-left:10px"><span>'+userName+'</span><img width="35px" height="35px" src="'+uImage+'" alt="avatar"></div><div class="message" style="background:none;padding:0 !important"><img width="150px" height="150px" src="/app/public'+res.url+'"></img></div></div>';
                $("#messages").append(img);
            }else if(res.type == "application"){
                var file = '<div class="msg-container sender"><div class="headline" style="margin-left:10px"><span>'+userName+'</span><img width="35px" height="35px" src="'+uImage+'" alt="avatar"></div><div class="message" style="background:none;padding:0 !important"><a href="/app/public'+res.url+'">Attachment</a></div></div>';
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
                        var audio = '<div class="msg-container sender"><div class="headline" style="margin-left:10px"><span>'+userName+'</span><img width="35px" height="35px" src="/app/public'+uImage+'" alt="avatar"></div><div class="message sender" style="background:none;padding:0 !important"><audio controls width="250px" height="250px" src="/app/public'+res.url+'"></audio></div></div>';
                        $("#messages").append(audio);
                    });
                };
                recorder.start();
            });
        }
    }

});