$("#importBtn").click(function(e) {
    e.preventDefault();
    var getFormData = new FormData($("#upload-form")[0]);
    $.ajax({
        type: "POST",
        url: admin_category_import,
        data: getFormData,
        dataType: "JSON",
        contentType: false,
        cache: false,
        processData: false,
        success: function(d) {
            if (d.status === 200) {
                isSuccess(d);
            } else {
                isError(d);
            }
        },
        error: function(xhr, status, error) {
            if (JSON.parse(xhr.responseText).message === "Server Error") {
                showStackBottomRight("error", "", "File bạn nhập không đúng");
            } else {
                let errorsData = JSON.parse(xhr.responseText).errors;
                const s = new Set();
                $.each(errorsData, function(key, value) {
                    s.add(String(value));
                });
                s.forEach(function(val) {
                    showStackBottomRight("error", "", val);
                });
            }
        }
    });
});
