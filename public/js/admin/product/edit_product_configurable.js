$("#btn-submit").click(function(e) {
    e.preventDefault();
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });
    let product_list = Array();
    let get_product_list = $('.selectpicker').selectpicker()[0].selectedOptions;
    $.each(get_product_list,function(k,v){
        product_list.push(v.value);
    });
    if(product_list.length == 0){
        product_list.pop();
    }
    else{
        product_list = JSON.stringify(product_list);
    }

    var getFormData = new FormData($("#upload-form")[0]);
    getFormData.append("product_list", product_list);
    $.ajax({
        type: "POST",
        url: update_product_configurable_url,
        data: getFormData,
        dataType: "JSON",
        contentType: false,
        cache: false,
        processData: false,
        success: function(d) {
            isSuccess(d);
            location.replace("/admin/product/configurable");
        },
        error: function(xhr, status, error) {
            isError(xhr);
        }
    });
});
