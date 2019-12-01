let total = 0;
if (cart == null) {
    $("#main-checkout").append(
        '<div class="row justify-content-center"><h2>Chưa có sản phẩm nào để thanh toán</h2></div><div class="row justify-content-center"><a href="/" class="btn btn-primary">Mua hàng</a></div>'
    );
} else {
    $("#main-checkout").append(
        '<div class="card"> <table class="table table-borderless table-shopping-cart"> <thead class="text-muted"> <tr class="small text-uppercase"> <th scope="col">Tên sách</th> <th scope="col" width="150">Số tiền</th> </tr></thead> <tbody class="cart-products-list"> </tbody> </table> <div class="card-body border-top"> <div class="row justify-content-center"> <div class="col-lg-4 d-flex justify-content-center"> <h2>Tổng thanh toán: </h2> </div><div class="col-lg-4 d-flex justify-content-center"> <h2 style="color:red;" id="total" class="float-md-right"></h2> </div></div></div><div class="card-footer border-0"> <button type="button" class="btn btn-lg btn-outline-success float-md-right mb-3 checkout"> Thanh toán <i class="fa fa-chevron-right"></i></button> </div></div>'
    );
    $.each(cart, function(k, v) {
        $(".cart-products-list").append("<tr>");
        $(".cart-products-list").append("<td>" + v.title + " </td>");
        $(".cart-products-list").append(
            '<td><div class="price-wrap"> <var class="price">' +
                v.price +
                '</var> <p><small class="text-muted price" style="text-decoration: line-through;">' +
                v.regular_price +
                "</small></p></div></td>"
        );
        $(".cart-products-list").append("</tr>");
    });
    $(".cart-products-list").on("change", ".item-count", function(e) {
        let count = $(this).val();
        let id = $(this).attr("data-id");
        for (var i in cart) {
            if (cart[i].id === id) {
                if (count == 0) {
                    cart.splice(i, 1);
                    _saveCart();
                    location.reload();
                    break;
                }
            }
        }
    });

    function calc() {
        for (var i in cart) {
            total += cart[i].price;
        }
    }
    function addClassPrice(k, v) {
        parseInt(v) != 0 ? $("#" + k).addClass("price") : "";
    }
    this.calc();
    $("#total").text(total);
    this.addClassPrice("total", total);

    $(".checkout").click(function(e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            }
        });
        if (cart != null) {
            $.ajax({
                type: "POST",
                url: checkoutUrl,
                data: JSON.stringify(cart),
                dataType: "JSON",
                contentType: false,
                cache: false,
                processData: false,
                success: function(d) {
                    if (d.status === 200) {
                        localStorage.clear();
                        showStackTopRight("success", "Success!", d.message);
                        setTimeout(function() {
                            window.location.replace(d.redirect_url);
                        }, 500);
                    } else {
                        localStorage.clear();
                        showStackTopRight("error", "Errors", d.message);
                        setTimeout(function() {
                            window.location.replace(d.redirect_url);
                        }, 1000);
                    }
                },
                error: function(xhr, status, error) {
                    console.log(xhr);
                }
            });
        }
    });
}
