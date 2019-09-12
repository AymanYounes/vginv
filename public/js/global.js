$(document).ready(function(){

    var baseURL = $("#baseURL").val();

    // tool tips initialize
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });


    // print file or image name for input file
    $(".custom-file-input").on('change',function (e) {
        var path = this.value;
        path = path.substring(12, path.length);

        $(this).next('.custom-file-label').html(path);
    })


})
