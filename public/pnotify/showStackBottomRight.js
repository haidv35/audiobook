PNotify.defaults.styling = 'bootstrap4';
PNotify.modules.History.defaults.maxInStack = 1;

function showStackBottomRight(type, title, message) {
    if (typeof window.stackBottomRight === 'undefined') {
        window.stackBottomRight = {
            'dir1': 'up',
            'dir2': 'left',
            'firstpos1': 25,
            'firstpos2': 25,
            'push': "top"
        };
    }
    var opts = {
        title: '',
        text: "",
        stack: window.stackBottomRight,
    };
    switch (type) {
        case 'error':
            opts.title = title;
            opts.text = message;
            opts.type = 'error';
            break;
        case 'info':
            opts.title = title;
            opts.text = message;
            opts.type = 'info';
            break;
        case 'success':
            opts.title = title;
            opts.text = message;
            opts.type = 'success';
            break;
    }
    PNotify.alert(opts);
}
function isSuccess(d) {
    if (d.status === 200) {
        showStackBottomRight('success', 'Success!', d.message);
    }
    else {
        showStackBottomRight('error', 'Errors', d.message);
    }
    $(".ui-pnotify").click(function(){
        $(this).remove();
    });
}
function isError(xhr) {
    let errorsData = JSON.parse(xhr.responseText);
    if (errorsData.errors != undefined) {
        $.each(errorsData.errors, function (key, value) {
            showStackBottomRight('error', key, value);
        });
    }
    else {
        showStackBottomRight('error', "Error", "Lỗi không xác định!");
    }
    $(".ui-pnotify").click(function(){
        $(this).remove();
    });
}
