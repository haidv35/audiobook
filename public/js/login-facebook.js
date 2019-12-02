$("#continue").on('click',function(){
    if($("input[name=password]").val() == $("input[name=password_confirmation]").val()){
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            }
        });
        var getFormData = new FormData($("#facebook-form")[0]);
        $.ajax({
            type: "POST",
            url: loginUrl,
            data: getFormData,
            dataType: "JSON",
            contentType: false,
            cache: false,
            processData: false,
            success: function(d) {
                if(d.status == 200){
                    showStackTopRight('success','Success!',d.message);
                    setTimeout(function() {
                        window.location.replace('/');
                    }, 500);
                }
                else{
                    $.each(d.message,function(k,v){
                        showStackTopRight('error','Error!',v);
                    });
                }
            }
        });
    }
    else{
        showStackTopRight('error',"Error","Mật khẩu xác nhận không đúng");
    }
});