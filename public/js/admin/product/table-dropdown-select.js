"use strict";

function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
        throw new TypeError("Cannot call a class as a function");
    }
}

function _defineProperties(target, props) {
    for (var i = 0; i < props.length; i++) {
        var descriptor = props[i];
        descriptor.enumerable = descriptor.enumerable || false;
        descriptor.configurable = true;
        if ("value" in descriptor) descriptor.writable = true;
        Object.defineProperty(target, descriptor.key, descriptor);
    }
}

function _createClass(Constructor, protoProps, staticProps) {
    if (protoProps) _defineProperties(Constructor.prototype, protoProps);
    if (staticProps) _defineProperties(Constructor, staticProps);
    return Constructor;
}

// DataTables Demo
// =============================================================
var ProductTable =
    /*#__PURE__*/
    (function() {
        function ProductTable() {
            _classCallCheck(this, ProductTable);
            this.init();
        }

        _createClass(ProductTable, [
            {
                key: "init",
                value: function init() {
                    this.handleSelecter();
                }
            },
            {
                key: "handleSelecter",
                value: function handleSelecter() {
                    var self = this;
                    $(document)
                        .on("change", "#check-handle", function() {
                            var isChecked = $(this).prop("checked");
                            var selectedRow = $(
                                'input[name="selectedRow[]"]'
                            ).prop("checked", isChecked);

                            self.getSelectedInfo();
                        })
                        .on(
                            "change",
                            'input[name="selectedRow[]"]',
                            function() {
                                var $selectors = $(
                                    'input[name="selectedRow[]"]'
                                );
                                var $selectedRow = $(
                                    'input[name="selectedRow[]"]:checked'
                                ).length;
                                var prop =
                                    $selectedRow === $selectors.length
                                        ? "checked"
                                        : "indeterminate"; // reset props

                                $("#check-handle")
                                    .prop("indeterminate", false)
                                    .prop("checked", false);

                                if ($selectedRow) {
                                    $("#check-handle").prop(prop, true);
                                }

                                self.getSelectedInfo();
                            }
                        )
                        .on("click", "#delete-selected", function() {
                            var selectedRowSet = new Set();
                            var selectedRow = $(
                                'input[name="selectedRow[]"]:checked'
                            );
                            $.each(selectedRow, function(k, v) {
                                selectedRowSet.add($(v).data("id"));
                            });
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
                                message:
                                    "<p class='mt-2'>Bạn chắc chắn muốn xoá sản phẩm đã chọn?</p>",
                                callback: function(result) {
                                    if (result === true) {
                                        selectedRowSet.forEach(function(v) {
                                            $.ajax({
                                                type: "GET",
                                                url:
                                                    "/admin/product/delete/" +
                                                    v,
                                                success: function(d) {
                                                    isSuccess(d);
                                                    $("[data-id='" + v + "']")
                                                        .parents("tr")
                                                        .remove();
                                                },
                                                error: function(
                                                    xhr,
                                                    status,
                                                    error
                                                ) {
                                                    // isError(xhr);
                                                    continue;
                                                }
                                            });
                                        });
                                        location.reload();
                                    }
                                }
                            });
                        });
                }
            },
            {
                key: "getSelectedInfo",
                value: function getSelectedInfo() {
                    var $selectedRow = $('input[name="selectedRow[]"]:checked')
                        .length;
                    var $info = $(".thead-btn");
                    var $badge = $("<span/>")
                        .addClass("selected-row-info text-muted pl-1")
                        .text("Đã chọn ".concat($selectedRow)); // remove existing info

                    $(".selected-row-info").remove(); // add current info

                    if ($selectedRow) {
                        $info.prepend($badge);
                    }
                }
            },
            {
                key: "clearSelectedRows",
                value: function clearSelectedRows() {
                    $("#check-handle")
                        .prop("indeterminate", false)
                        .prop("checked", false)
                        .trigger("change");
                }
            }
        ]);

        return ProductTable;
    })();
/**
 * Keep in mind that your scripts may not always be executed after the theme is completely ready,
 * you might need to observe the `theme:load` event to make sure your scripts are executed after the theme is ready.
 */

$(document).on("theme:init", function() {
    new ProductTable();
});
