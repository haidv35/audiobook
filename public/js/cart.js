(function($, window, document, undefined) {
    var defaults = {
        cart: [],
        addtoCartClass: ".add-to-cart",
        cartProductListClass: ".cart-products-list",
        totalCartCountClass: ".total-cart-count",
        totalCartCostClass: ".total-cart-cost",
        showcartID: "#show-cart",
        cartCounter: "#cart",
        itemCountClass: ".item-count"
    };

    function Item(
        id,
        title,
        category,
        regular_price,
        discount_price,
        price,
        count
    ) {
        this.id = id;
        this.title = title;
        this.category = category;
        this.regular_price = regular_price;
        this.discount_price = discount_price;
        this.price = price;
    }
    function simpleCart(domEle, options) {
        this.options = $.extend(true, {}, defaults, options);
        this.cart = [];
        this.cart_ele = $(domEle);
        this.init();
    }

    /*plugin functions */
    $.extend(simpleCart.prototype, {
        init: function() {
            this._loadCart();
            this._setEvents();
        },
        _loadCart: function() {
            this.cart = JSON.parse(localStorage.getItem("shoppingCart"));
            if (this.cart == null) {
                this.cart = [];
            }
        },
        _setEvents: function() {
            let mi = this;
            $(this.options.addtoCartClass).bind("click", function(e) {
                e.preventDefault();
                let id = $(this).attr("data-id");
                if (cart != null) {
                    for (i = 0; i < cart.length; i++) {
                        if (id == cart[i].id) {
                            showStackTopRight(
                                "error",
                                "Error!",
                                "Sản phẩm đã có trong giỏ"
                            );
                            $(".ui-pnotify").click(function() {
                                $(this).remove();
                            });
                            return 0;
                        }
                    }
                }
                let category = $(this).attr("data-category");
                let title = $(this).attr("data-title");
                let discount_price = Number(
                    $(this).attr("data-discount_price")
                );
                let regular_price = Number($(this).attr("data-regular_price"));
                let price = 0;
                if (discount_price.val == 0) {
                    price = regular_price;
                } else {
                    price = discount_price;
                }
                mi._addItemToCart(
                    id,
                    title,
                    category,
                    regular_price,
                    discount_price,
                    price
                );
                showStackTopRight(
                    "success",
                    "Success!",
                    "Thêm vào giỏ hàng thành công"
                );
                $(".ui-pnotify").click(function() {
                    $(this).remove();
                });
            });

            $(this.options.showcartID).on(
                "change",
                this.options.itemCountClass,
                function(e) {
                    let ci = this;
                    e.preventDefault();
                    let id = $(this).attr("data-id");
                    let category = $(this).attr("data-category");
                    let title = $(this).attr("data-title");
                    let discount_price = Number(
                        $(this).attr("data-discount_price")
                    );
                    let regular_price = Number(
                        $(this).attr("data-regular_price")
                    );
                    let price = 0;
                    if (discount_price.val == 0) {
                        price = regular_price;
                    } else {
                        price = discount_price;
                    }
                    mi._removeItemfromCart(
                        id,
                        title,
                        category,
                        regular_price,
                        discount_price,
                        price
                    );
                }
            );
        },
        /* Helper Functions */
        _addItemToCart: function(
            id,
            title,
            category,
            regular_price,
            discount_price,
            price
        ) {
            for (var i in this.cart) {
                if (this.cart[i].title === title) {
                    if (discount_price.val == 0) {
                        this.cart[i].price = regular_price;
                    } else {
                        this.cart[i].price = discount_price;
                    }
                    this._saveCart();
                    return;
                }
            }
            var item = new Item(
                id,
                title,
                category,
                regular_price,
                discount_price,
                price
            );
            this.cart.push(item);
            this._saveCart();
            $("#cart").text(this.cart.length);
        },
        _removeItemfromCart: function(title, short_description, price) {
            for (var i in this.cart) {
                if (this.cart[i].title === title) {
                    this.cart[i].price = price;
                    this.cart.splice(i, 1);
                    break;
                }
            }
            this._saveCart();
        },
        _clearCart: function() {
            this.cart = [];
            this._saveCart();
        },
        _totalCartCount: function() {
            return this.cart.length;
        },
        _listCart: function() {
            var cartCopy = [];
            for (var i in this.cart) {
                var item = this.cart[i];
                var itemCopy = {};
                for (var p in item) {
                    itemCopy[p] = item[p];
                }
                cartCopy.push(itemCopy);
            }
            return cartCopy;
        },
        _saveCart: function() {
            localStorage.setItem("shoppingCart", JSON.stringify(this.cart));
        }
    });
    /* Defining the Structure of the plugin 'simpleCart'*/
    $.fn.simpleCart = function(options) {
        return this.each(function() {
            $.data(this, "simpleCart", new simpleCart(this));
            console.log($(this, "simpleCart"));
        });
    };
})(jQuery, window, document);
