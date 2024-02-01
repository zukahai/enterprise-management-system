/**
 * DataTables Basic
 */

'use strict';

let fv, offCanvasEl;
document.addEventListener('DOMContentLoaded', function (e) {
  (function () {
    const formAddNewRecord = document.getElementById('form-add-new-record');

    setTimeout(() => {
      const newRecord = document.querySelector('.create-new'),
        offCanvasElement = document.querySelector('#add-new-record');

      // To open offCanvas, to add new record
      if (newRecord) {
        newRecord.addEventListener('click', function () {
          offCanvasEl = new bootstrap.Offcanvas(offCanvasElement);
          // Empty fields on offCanvas open
          // (offCanvasElement.querySelector('.dt-name').value = ''),
          //   (offCanvasElement.querySelector('.dt-address').value = ''),
          //   (offCanvasElement.querySelector('.dt-mst').value = ''),
          //   (offCanvasElement.querySelector('.dt-phone_number').value = ''),
          //   (offCanvasElement.querySelector('.dt-time').value = ''),
          //   (offCanvasElement.querySelector('.dt-note').value = '');
          //   (offCanvasElement.querySelector('.dt-contact').value = '');
          // Open offCanvas with form
          offCanvasEl.show();
        });
      }
    }, 200);

    // Form validation for Add new record





    // FlatPickr Initialization & Validation
    // flatpickr(formAddNewRecord.querySelector('[name="basicDate"]'), {
    //   enableTime: false,
    //   // See https://flatpickr.js.org/formatting/
    //   dateFormat: 'm/d/Y',
    //   // After selecting a date, we need to revalidate the field
    //   onChange: function () {
    //     fv.revalidateField('basicDate');
    //   }
    // });
  })();
});

function getSearchParamFromURL() {
  var urlParams = new URLSearchParams(window.location.search);
  return urlParams.get('s') || '';
}


// datatable (jquery)
$(function () {
  var dt_basic_table = $('.datatables-basic'),
    dt_complex_header_table = $('.dt-complex-header'),
    dt_row_grouping_table = $('.dt-row-grouping'),
    dt_multilingual_table = $('.dt-multilingual'),
    dt_basic;

  // DataTable with buttons
  // --------------------------------------------------------------------

  if (dt_basic_table.length) {
    let authToken = localStorage.getItem('authToken') || "";
    var domain = document.documentElement.getAttribute('data-domain');
    // console.log('authtoken',authToken);
    dt_basic = dt_basic_table.DataTable({
      language: {
        url: 'https://cdn.datatables.net/plug-ins/1.10.21/i18n/Vietnamese.json'
      },
      ajax: {
        url: domain + '/api/v1/export-order',
        type: 'GET',
        headers: {
          'Authorization': 'Bearer ' + authToken,
        },
        done: function (data) {
          // console.log(data);
        }
      },
      order: [[1, 'desc']],
      columns: [
        { data: null, width: '1%' },
        { data: 'null', width: '10%' }, //trạng thái
        { data: 'customer.name', width: '10%' },
        { data: 'delivery_date', width: '10%' },
        { data: 'internal_code', width: '10%' },
        { data: 'finished_product.name', width: '30%' },
        { data: 'finished_product.ktdh_length', width: '10%' },
        { data: 'finished_product.ktdh_width', width: '10%' },
        { data: 'finished_product.ktdh_height', width: '10%' },
        { data: 'finished_product.ktsx_length', width: '10%' },
        { data: 'finished_product.ktsx_width', width: '10%' },
        { data: 'finished_product.ktsx_height', width: '10%' },
        { data: 'finished_product.song', width: '10%' },
        { data: 'finished_product.unit.name', width: '10%' },
        { data: 'finished_product.price', width: '10%' },
        { data: 'count', width: '10%' },
        { data: null, width: '10%' }, // thành tiền
        { data: 'finished_product.rose', width: '10%' },
        { data: 'finished_product.rose_percent', width: '10%' },
        { data: 'finished_product.note', width: '10%' },
        { data: 'finished_product.type', width: '10%' },
        { data: 'finished_product.delivered_enough', width: '10%' },
        { data: null, width: '10%' }, //xa
        { data: 'finished_product.mold', width: '10%' },
        { data: 'finished_product.n_color', width: '10%' },
        { data: null, width: '10%' }, //in
        { data: null, width: '10%' }, // mang
        { data: null, width: '10%' }, //be
        { data: null, width: '10%' }, //chap
        { data: null, width: '10%' }, //dong
        { data: null, width: '10%' }, //dán
        { data: 'finished_product.other', width: '10%' }, // khác
        { data: '', orderable: false, width: '20%' }
      ],
      search: {
        search: getSearchParamFromURL()
      },
      // scrollX: true,
      // scrollCollapse: true,
      Responsive: true,
      columnDefs: [
        { //tên
          targets: 0,
          render: function (data, type, full, meta){
            return '<input class="form-check-input" type="checkbox" name="eo' + full['id'] + '" value="' + full['id'] + '">';
          } 
        },
        { //trạng thái
          targets: 1,
          render: function (data, type, full, meta){
            let result = {
              "1": {
                "text": "Hoàn thành",
                "class": "badge bg-label-success"
              },
              "0": {
                "text": "Đang chờ",
                "class": "badge bg-label-warning"
              },
              "2": {
                "text": "Đã huỷ",
                "class": "badge bg-label-danger"
              }
            }
            return '<span class="badge bg-label-' + result[full['status']]['class'] + '">' + result[full['status']]['text'] + '</span>';
          } 
        },
        { //khách hàng
          targets: 2,
          render: function (data, type, full, meta){
            return '(' + full['customer']['id_custom'] + ')<br>'  +'<a href="../../../customer/' + full['customer']['id'] + '">' + data + '</a>';
          } 
        },
        { //đơn hàng xuất
          targets: 5,
          render: function (data, type, full, meta){
            return '(' + full['finished_product']['id_custom'] + ')<br>'+
             '<a href="../../../finished-product/' + full['finished_product']['id'] + '">' + data + '</a>';
          } 
        },
        { //xa
          targets: -11,
          render: function (data, type, full, meta){
            if (full['finished_product']['xa'] > 0)
              return formatNumber(full['finished_product']['xa']) +'<br>' +
                '<span class="badge bg-label-success">' + formatNumber(full['finished_product']['x'])+ '</span>';
            return "";
          } 
        },
        { //in
          targets: -8,
          render: function (data, type, full, meta){
            if (full['finished_product']['in'] > 0)
              return formatNumber(full['finished_product']['in']) + '<br>' +
              '<span class="badge bg-label-success">' + formatNumber(full['finished_product']['in_n']) + '</span>';
            return ""
          } 
        },
        { //mang
          targets: -7,
          render: function (data, type, full, meta){
            if (full['finished_product']['mang'] > 0)
            return formatNumber(full['finished_product']['mang']) + '<br>' +
            '<span class="badge bg-label-success">' + formatNumber(full['finished_product']['mang_n'])+ '</span>';
            return "";
          } 
        },
        { //be
          targets: -6,
          render: function (data, type, full, meta){
            if (full['finished_product']['be'] > 0)
              return formatNumber(full['finished_product']['be']) + '<br>' +
              '<span class="badge bg-label-success">' + formatNumber(full['finished_product']['be_n']) + '</span>';
            return "";
          } 
        },
        { //chap
          targets: -5,
          render: function (data, type, full, meta){
            if (full['finished_product']['chap'] > 0)
              return formatNumber(full['finished_product']['chap']) + '<br>' +
              '<span class="badge bg-label-success">' + formatNumber(full['finished_product']['chap_n'])+ '</span>';
            return "";
          } 
        },
        { //dong
          targets: -4,
          render: function (data, type, full, meta){
            if (full['finished_product']['dong'] > 0)
              return formatNumber(full['finished_product']['dong']) + '<br>' +
              '<span class="badge bg-label-success">' + formatNumber(full['finished_product']['dong_n']) + '</span>';
            return "";
          } 
        },
        { //dán
          targets: -3,
          render: function (data, type, full, meta){
            if (full['finished_product']['dan'] > 0)
              return formatNumber(full['finished_product']['dan']) + '<br>' +
              '<span class="badge bg-label-success">' + formatNumber(full['finished_product']['dan_n']) + '</span>';
            return "";
          } 
        },
        { //other
          targets: -2,
          render: function (data, type, full, meta){
            if (full['finished_product']['other'] > 0)
              return formatNumber(full['finished_product']['other']) + '<br>' +
              '<span class="badge bg-label-success">' + formatNumber(full['finished_product']['other_n']) + '</span>';
            return "";
          } 
        },
        {
          targets: 13,
          render: function (data, type, row){
            return '<a href="' + domain + '/unit/?s=' + data + '">' + data + '</a>';
          } 
        },
        {
          targets: [14, 15],
          render: function (data, type, full, meta){
            return formatNumber(data);
          } 
        },
        {
          targets: 16,
          render: function (data, type, full, meta){
            let total_price_row = BigInt(BigInt(full['finished_product']['price']) * BigInt(full['count']));
            return formatNumber(total_price_row);
          } 
        },
        {
          // Actions
          targets: -1,
          title: 'Thao tác',
          orderable: false,
          searchable: false,
          render: function (data, type, full, meta) {
            return (
              '<div class="d-inline-block">' +
              '<a href="javascript:;" class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="text-primary ti ti-dots-vertical"></i></a>' +
              '<ul class="dropdown-menu dropdown-menu-end m-0">' +
              '<li><a href="'+ domain +'/export-order/' + full['id']+'" class="dropdown-item">Xem chi tiết</a></li>' +
              '<div class="dropdown-divider"></div>' +
              '<li><a href="javascript:;" class="dropdown-item text-danger delete-record" data-id=' + full['id'] + '>Xoá ' + full['name'] + '</a></li>' +
              '</ul>' +
              '</div>' +
              '<a href="javascript:;" class="btn btn-sm btn-icon item-edit" data-bs-toggle="modal" data-bs-target="#editObjectModal" onclick="editRecord(' + full['id'] + ')"><i class="text-primary ti ti-pencil"></i></a>'
            );
          }
        },
        {
          targets: [10],
          render: function (data, type, full, meta) {
            return formatNumber(data)
          }
        },
      ],
      dom: '<"card-header flex-column flex-md-row"<"head-label text-center"><"dt-action-buttons text-end pt-3 pt-md-0"B>><"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      displayLength: 7,
      lengthMenu: [7, 10, 25, 50, 75, 100],
      buttons: [
        {
          extend: 'collection',
          className: 'btn btn-label-primary dropdown-toggle me-2 waves-effect waves-light',
          text: '<i class="ti ti-file-export me-sm-1"></i> <span class="d-none d-sm-inline-block">Xuất</span>',
          buttons: [
            {
              extend: 'print',
              text: '<i class="ti ti-printer me-1" ></i>Print',
              className: 'dropdown-item',
              exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16,17, 18, 19, 20, 21, 22, 23],
                // prevent avatar to be display
                format: {
                  body: function (inner, coldex, rowdex) {
                    inner = String(inner);
                    if (inner.indexOf('<br>') !== -1) {
                      let text = inner.split('<br>')[0];
                      return text;
                    } else {
                      var tempElement = document.createElement('div');
                      tempElement.innerHTML = inner;
                      var anchorElement = tempElement.querySelector('a');
                      if (anchorElement) {
                        return anchorElement.textContent || anchorElement.innerText;
                      } else {
                        // xoá dấu phẩy
                        var regex = /^\d{1,3}(,\d{3})*$/;
                        if (regex.test(inner))
                          return parseFloat(inner.replace(/,/g, ''));
                        return inner;
                      }
                    }
                  }
                }
              },
            },
            {
              extend: 'excel',
              text: '<i class="ti ti-file-spreadsheet me-1"></i>Excel',
              className: 'dropdown-item',
              exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16,17, 18, 19, 20, 21, 22, 23],
                // prevent avatar to be display
                format: {
                  body: function (inner, coldex, rowdex) {
                    inner = String(inner);
                    if (inner.indexOf('<br>') !== -1) {
                      let text = inner.split('<br>')[0];
                      return parseFloat(text.replace(/[,\.]/g, ''));
                    } else {
                      var tempElement = document.createElement('div');
                      tempElement.innerHTML = inner;
                      var anchorElement = tempElement.querySelector('a');
                      if (anchorElement) {
                        return anchorElement.textContent || anchorElement.innerText;
                      } else {
                        // xoá dấu phẩy
                        var regex = /^(\d{1,3}(\.\d{3})*(,\d{3})*|\d+)$/;
                        if (regex.test(inner))
                          return parseFloat(inner.replace(/[,\.]/g, ''));
                        return inner;
                      }
                    }
                  }
                }
              }
            },
            {
              extend: 'pdf',
              text: '<i class="ti ti-file-description me-1"></i>Pdf',
              className: 'dropdown-item',
              exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16,17, 18, 19, 20, 21, 22, 23],
                // prevent avatar to be display
                charset: 'utf-8', // Thêm cấu hình charset UTF-8
                bom: true, // Thêm cấu hình BOM để đảm bảo định dạng UTF-8
                format: {
                  body: function (inner, coldex, rowdex) {
                    inner = String(inner);
                    if (inner.indexOf('<br>') !== -1) {
                      let text = inner.split('<br>')[0];
                      return text;
                    } else {
                      var tempElement = document.createElement('div');
                      tempElement.innerHTML = inner;
                      var anchorElement = tempElement.querySelector('a');
                      if (anchorElement) {
                        return anchorElement.textContent || anchorElement.innerText;
                      } else {
                        // xoá dấu phẩy
                        var regex = /^\d{1,3}(,\d{3})*$/;
                        if (regex.test(inner))
                          return parseFloat(inner.replace(/,/g, ''));
                        return inner;
                      }
                    }
                  }
                }
              }
            },
            {
              extend: 'copy',
              text: '<i class="ti ti-copy me-1" ></i>Copy',
              className: 'dropdown-item',
              exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16,17, 18, 19, 20, 21, 22, 23],
                // prevent avatar to be display
                format: {
                  body: function (inner, coldex, rowdex) {
                    inner = String(inner);
                    if (inner.indexOf('<br>') !== -1) {
                      let text = inner.split('<br>')[0];
                      return text;
                    } else {
                      var tempElement = document.createElement('div');
                      tempElement.innerHTML = inner;
                      var anchorElement = tempElement.querySelector('a');
                      if (anchorElement) {
                        return anchorElement.textContent || anchorElement.innerText;
                      } else {
                        // xoá dấu phẩy
                        var regex = /^\d{1,3}(,\d{3})*$/;
                        if (regex.test(inner))
                          return parseFloat(inner.replace(/,/g, ''));
                        return inner;
                      }
                    }
                  }
                }
              }
            }
          ]
        },
        {
          text: '<i class="ti ti-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">Chọn thành phẩm</span>',
          className: 'btn btn-primary',
          action: function (e, dt, node, config) {
            $('#add-export-order').modal('show');
          }
        }
      ],
    });
    $('div.head-label').html('<h5 class="card-title mb-0">Danh sách đơn hàng xuất/h5>');
  }

  // Delete Record
  $('.datatables-basic tbody').on('click', '.delete-record', function () {
    let authToken = localStorage.getItem('authToken') || "";
    let id = $(this).data('id');
    let clickedRow = $(this).closest('tr');

    // Get CSRF token value from the meta tag
    let csrfToken = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
      type: 'DELETE',
      url: domain + '/api/v1/export-order/' + id,
      headers: {
        'Authorization': 'Bearer ' + authToken,
        'X-CSRF-TOKEN': csrfToken
      }
    }).done(function (data) {
      if (Math.floor(data.data > 0)) {
        dt_basic.row(clickedRow).remove().draw();
        toastr.success("Xóa đơn hàng xuất thành công");
      } else {
        toastr.error("Xóa đơn hàng xuất thất bại");
      }

    }).fail(function (error) {
      console.log(error);
    });
  });


  // Filter form control to default size
  // ? setTimeout used for multilingual table initialization
  setTimeout(() => {
    $('.dataTables_filter .form-control').removeClass('form-control-sm');
    $('.dataTables_length .form-select').removeClass('form-select-sm');
  }, 300);
});
