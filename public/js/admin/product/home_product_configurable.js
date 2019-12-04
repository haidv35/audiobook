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
                    url: "/admin/product/configurable/delete/" + id,
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
        "/admin/product/configurable" +
            $(this)
                .find("option:selected")
                .val()
    );
});

