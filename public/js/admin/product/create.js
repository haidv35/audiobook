$("#btn-submit").click(function(e) {
    e.preventDefault();
    var getFormData = new FormData($("#upload-form")[0]);
    var getCheckboxValue = $("#upload-form").find("input[type=checkbox]");
    $.each(getCheckboxValue, function(key, val) {
        getFormData.append($(val).attr("name"), $(val).is(":checked") ? 1 : 0);
    });
    let editorData = myEditor.getData();
    getFormData.append("description", editorData);
    $.ajax({
        type: "POST",
        url: admin_product_store,
        data: getFormData,
        dataType: "JSON",
        contentType: false,
        cache: false,
        processData: false,
        success: function(d) {
            isSuccess(d);
            location.replace("/admin/product");
        },
        error: function(xhr, status, error) {
            let errorsData = JSON.parse(xhr.responseText).errors;
            const s = new Set();
            $.each(errorsData, function(key, value) {
                s.add(String(value));
            });
            s.forEach(function(val) {
                showStackBottomRight("error", "", val);
            });
        }
    });
});
