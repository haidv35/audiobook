let cart = JSON.parse(localStorage.getItem("shoppingCart"));
if (cart != null) {
    $("#cart").text(cart.length);
}
