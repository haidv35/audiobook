$("#add_product_links").click(function(e) {
    $("#product_links").append(
        '<input class="form-control mb-1" name="product_links[]" type="text" placeholder="http://example.com/file.mp3">'
    );
});
$("#btn-submit").click(function(e) {
    e.preventDefault();
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });
    var getFormData = new FormData($("#upload-form")[0]);
    var getCheckboxValue = $("#upload-form").find("input[type=checkbox]");
    $.each(getCheckboxValue, function(key, val) {
        getFormData.append($(val).attr("name"), $(val).is(":checked") ? 1 : 0);
    });
    let editorData = myEditor.getData();
    getFormData.append("description", editorData);
    $.ajax({
        type: "POST",
        url: admin_product_update,
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
            isError(xhr);
        }
    });
});
