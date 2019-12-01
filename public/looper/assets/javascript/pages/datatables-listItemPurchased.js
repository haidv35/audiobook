"use strict";

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

// =============================================================
var DataTablesListItemPurchased =
/*#__PURE__*/
function () {
  function DataTablesListItemPurchased() {
    _classCallCheck(this, DataTablesListItemPurchased);

    this.init();
  }

  _createClass(DataTablesListItemPurchased, [{
    key: "init",
    value: function init() {
      this.searchRecords();
      this.selecter();
      this.clearSelected();
      this.table(); // add buttons

      this.table.buttons().container().appendTo('#dt-buttons').unwrap();
    }
  }, {
    key: "searchRecords",
    value: function searchRecords() {
      var self = this;
      $('#table-search, #filterBy').on('keyup change focus', function (e) {
        var filterBy = $('#filterBy').val();
        var hasFilter = filterBy !== '';
        var value = $('#table-search').val(); // clear selected rows

        if (value.length && (e.type === 'keyup' || e.type === 'change')) {
          self.clearSelectedRows();
        } // reset search term


        self.table.search('').columns().search('').draw();

        if (hasFilter) {
          self.table.columns(filterBy).search(value).draw();
        } else {
          self.table.search(value).draw();
        }
      });
    }
  }, {
    key: "getSelectedInfo",
    value: function getSelectedInfo() {
      var $selectedRow = $('input[name="selectedRow[]"]:checked').length;
      var $info = $('.thead-btn');
      var $badge = $('<span/>').addClass('selected-row-info text-muted pl-1').text("".concat($selectedRow, " selected")); // remove existing info

      $('.selected-row-info').remove(); // add current info

      if ($selectedRow) {
        $info.prepend($badge);
      }
    }
  }, {
    key: "selecter",
    value: function selecter() {
      var self = this;
      $(document).on('change', '#check-handle', function () {
        var isChecked = $(this).prop('checked');
        $('input[name="selectedRow[]"]').prop('checked', isChecked); // get info

        self.getSelectedInfo();
      }).on('change', 'input[name="selectedRow[]"]', function () {
        var $selectors = $('input[name="selectedRow[]"]');
        var $selectedRow = $('input[name="selectedRow[]"]:checked').length;
        var prop = $selectedRow === $selectors.length ? 'checked' : 'indeterminate'; // reset props

        $('#check-handle').prop('indeterminate', false).prop('checked', false);

        if ($selectedRow) {
          $('#check-handle').prop(prop, true);
        } // get info


        self.getSelectedInfo();
      });
    }
  }, {
    key: "clearSelected",
    value: function clearSelected() {
      var self = this; // clear selected rows

      $('#listItemPurchased').on('page.dt', function () {
        self.clearSelectedRows();
      });
      $('#clear-search').on('click', function () {
        self.clearSelectedRows();
      });
    }
  }, {
    key: "clearSelectedRows",
    value: function clearSelectedRows() {
      $('#check-handle').prop('indeterminate', false).prop('checked', false).trigger('change');
    }
  }, {
    key: "table",
    value: function table2() {
      $('#listItemPurchased').DataTable({
        dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>\n        <'table-responsive'tr>\n        <'row align-items-center'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 d-flex justify-content-end'p>>",
        language: {
          paginate: {
            previous: '<i class="fa fa-lg fa-angle-left"></i>',
            next: '<i class="fa fa-lg fa-angle-right"></i>'
          }
        },
        autoWidth: false,
        ajax: '/user/getItemPurchasedJson',
        deferRender: true,
        order: [1, 'asc'],
        columns: [{
          data: 'image',
          className: 'align-middle',
          orderable: false,
          searchable: false
        }, {
          data: 'title',
          className: 'align-middle'
        },
        {
            className: 'align-middle',
        }],
        columnDefs: [{
          targets: 0,
          render: function render(data, type, row, meta) {
            return "<img class='img-fluid' style='width:5rem;height:6rem;' src=".concat(row.image,"\ />");
          }
        }, {
          targets: 2,
          render: function render(data, type, row, meta) {
            return "<a class=\"btn btn-sm btn-icon btn-secondary\" href=\"/user/purchased/".concat(row.id, "\"><i class=\"fa fa-eye\"></i></a>");
          }
        }]
      });
    }
  }]);

  return DataTablesListItemPurchased;
}();

$(document).on('theme:init', function () {
  new DataTablesListItemPurchased();
});
