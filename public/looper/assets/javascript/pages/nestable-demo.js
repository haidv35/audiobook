"use strict";

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

// Nestable Demo
// =============================================================
var NestableDemo =
/*#__PURE__*/
function () {
  function NestableDemo() {
    _classCallCheck(this, NestableDemo);

    this.init();
  }

  _createClass(NestableDemo, [{
    key: "init",
    value: function init() {
      // event handlers
      this.handleNestable();
    }
  }, {
    key: "handleNestable",
    value: function handleNestable() {
      var _this = this;

    //   $('#nestable').on('change',this.output);
      this.getData().done(function (data) {

        var items = '';
        $.each(data, function (index, item) {
          items += _this.buildItem(item);
        });
        $('#nestable').children().html(items).parent().nestable().on('change', _this.output);

      });
    }
  }, {
    key: "getData",
    value: function getData() {
      return $.getJSON('/admin/category/getJson');
    }
  }, {
    key: "buildItem",
    value: function buildItem(item) {
      var _this2 = this;

      var html = "<li class=\"dd-item\" data-parent_id=\"".concat(item.parent_id, "\" data-rgt=\"").concat(item.rgt, "\" data-lft=\"").concat(item.lft, "\" data-name=\"").concat(item.name, "\" data-id=\"").concat(item.id,"\"").concat(">\n      <div class=\"dd-handle\">\n        <span class=\"drag-indicator\"></span>\n        <div>").concat(item.name, "</div>\n        <div class=\"dd-nodrag btn-group ml-auto\">\n          <a href=\"/admin/category/edit/").concat(item.id,"\" class=\"btn btn-sm btn-secondary\">Sửa</a>\n          <a href=\"/admin/category/delete/").concat(item.id,"\" class=\"btn btn-sm btn-secondary\"><i class=\"far fa-trash-alt\"></i></a>\n        </div>\n      </div>");

      if (Object.keys(item.children).length != 0) {
        html += '<ol class="dd-list">';
        $.each(item.children, function (index, sub) {
          html += _this2.buildItem(sub);
        });
        html += '</ol>';
      }

      html += '</li>';
      return html;
    }
  }
]);

  return NestableDemo;
}();
/**
 * Keep in mind that your scripts may not always be executed after the theme is completely ready,
 * you might need to observe the `theme:load` event to make sure your scripts are executed after the theme is ready.
 */


$(document).on('theme:init', function () {
  new NestableDemo();
});
