PNotify.defaults.styling = 'bootstrap4';
PNotify.modules.History.defaults.maxInStack = 1;
function showStackTopRight(type,title,message) {
    if (typeof window.stackTopRight === 'undefined') {
        window.stackTopRight = {
            'dir1': 'down',
            'dir2': 'left',
            'firstpos1': 100,
            'firstpos2': 20,
            'push': 'top'
        };
    }
    var opts = {
        title: '',
        text: "",
        stack: window.stackTopRight
    };
    switch (type) {
        case 'error':
            opts.title = title;
            opts.text = message;
            opts.type = 'error';
            break;
        case 'success':
            opts.title = title;
            opts.text = message;
            opts.type = 'success';
            break;
    }
    PNotify.alert(opts);
}

function isSuccess(d){
    if(d.status === 200)
    {
        showStackTopRight('success','Success!',d.message);
    }
    else{
        showStackTopRight('error','Errors',d.message);
    }
    $(".ui-pnotify").click(function(){
        $(this).remove();
    });
}
function isError(xhr){
    let errorsData = JSON.parse(xhr.responseText).errors;
    $.each(errorsData,function(key,value){
        showStackTopRight('error',key,value);
    });
    $(".ui-pnotify").click(function(){
        $(this).remove();
    });
}
