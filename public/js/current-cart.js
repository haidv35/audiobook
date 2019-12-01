let subtotal = 0,
    discount = 0,
    total = 0;
// let cart = JSON.parse(localStorage.getItem("shoppingCart"));
if (cart == null) {
    cart = [];
}
if (cart == null || cart.length == 0) {
    $(".title-page").remove();
    $(".section-content").remove();
    $(".app-main").append(
        '<div class="container my-5"> <div class="row justify-content-center"> <h2 class="text-muted">Chưa có sản phẩm</h2> </div><div class="row justify-content-center mt-5"> <a href="/" class="btn btn-outline-success"><i class="fas fa-arrow-left"></i> Tiếp tục mua hàng</a> </div></div>'
    );
}
$.each(cart, function(k, v) {
    $(".cart-products-list").append("<tr>");
    $(".cart-products-list").append(
        '<td><figure class="itemside"> <figcaption class="info"> <a href="#" class="title text-dark">' +
            v.title +
            "</a> </figcaption> </figure> </td>"
    );
    $(".cart-products-list").append(
        '<td><div class="price-wrap"> <var class="price">' +
            v.price +
            '</var> <p><small class="text-muted price" style="text-decoration: line-through;">' +
            v.regular_price +
            "</small></p></div></td>"
    );
    $(".cart-products-list").append(
        '<td class="text-right"> <button onclick="deleteProductFromCart(' +
            v.id +
            ')" class="btn btn-light" id="delete-product" name="delete-product[]" data-id="' +
            v.id +
            '" data-title="' +
            v.title +
            '"> Xoá</button> </td>'
    );
    $(".cart-products-list").append("</tr>");
});
$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
    }
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
        subtotal += cart[i].regular_price;
        discount += cart[i].discount_price;
        total += cart[i].price;
    }
    discount != 0 ? (discount = subtotal - total) : 0;
}
function _saveCart() {
    localStorage.setItem("shoppingCart", JSON.stringify(cart));
}

function resetCart() {
    localStorage.clear();
    location.reload();
}
function _removeItemfromCart(id) {
    for (var i in cart) {
        if (cart[i].id == id) {
            cart.splice(i, 1);
            break;
        }
    }
    _saveCart();
    location.reload();
}
function deleteProductFromCart(id) {
    _removeItemfromCart(id);
}
function addClassPrice(k, v) {
    parseInt(v) != 0 ? $("#" + k).addClass("price") : "";
}
this.calc();
$("#subtotal").text(subtotal);
this.addClassPrice("subtotal", subtotal);
$("#discount").text(discount);
this.addClassPrice("discount", discount);
$("#total").text(total);
this.addClassPrice("total", total);
