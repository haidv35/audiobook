$(".remove-product-btn").click(function(t) {
    let id = $(this).attr("data-id");
    bootbox.confirm({
        size: "small",
        buttons: {
            confirm: {
                label: "OK",
                className: "btn-danger"
            },
            cancel: {
                label: "Huỷ",
                className: "btn-secondary"
            }
        },
        message: "<p class='mt-2'>Bạn chắc chắn muốn xoá sản phẩm này?</p>",
        callback: function(result) {
            if (result === true) {
                $.ajax({
                    type: "GET",
                    url: "/admin/product/delete/" + id,
                    success: function(d) {
                        isSuccess(d);
                        $("[data-id='" + id + "']")
                            .parents("tr")
                            .remove();
                    },
                    error: function(xhr, status, error) {
                        isError(xhr);
                    }
                });
            }
        }
    });
});
$(".product-filter").on("change", function(e) {
    window.location.replace(
        "/admin/product" +
            $(this)
                .find("option:selected")
                .val()
    );
});
$(".new_product").bind("change", function() {
    let product_id = $(this).val();
    let status = $(this).prop("checked");
    let type = "new_product";
    $.ajax({
        type: "POST",
        url: product_status,
        data: JSON.stringify({
            product_id: product_id,
            status: status,
            type: type
        }),
        dataType: "json",
        success: function(d) {
            isSuccess(d);
        },
        error: function(xhr, status, error) {
            isError(xhr);
        }
    });
});
$(".hot_product").bind("change", function() {
    let product_id = $(this).val();
    let status = $(this).prop("checked");
    let type = "hot_product";
    $.ajax({
        type: "POST",
        url: product_status,
        data: JSON.stringify({
            product_id: product_id,
            status: status,
            type: type
        }),
        dataType: "json",
        success: function(d) {
            isSuccess(d);
        },
        error: function(xhr, status, error) {
            isError(xhr);
        }
    });
});
