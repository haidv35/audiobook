$("#btn-submit").click(function(e) {
    e.preventDefault();

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
    let shortDescription = CKEDITOR.instances['short_description'].getData();
    getFormData.append("short_description", shortDescription);
    $.ajax({
        type: "POST",
        url: admin_product_configurable_store,
        data: getFormData,
        dataType: "JSON",
        contentType: false,
        cache: false,
        processData: false,
        success: function(d) {
            console.log(d);
            isSuccess(d);
            location.replace("/admin/product/configurable");
        },
        error: function(xhr, status, error) {
            console.log(xhr);
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
