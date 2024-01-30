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
        url: domain + '/api/v1/finished-product',
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
        { data: 'id', width: '10%' },
        { data: 'name', width: '30%' },
        { data: 'ktdh_length', width: '10%' },
        { data: 'ktdh_width', width: '10%' },
        { data: 'ktdh_height', width: '10%' },
        { data: 'ktsx_length', width: '10%' },
        { data: 'ktsx_width', width: '10%' },
        { data: 'ktsx_height', width: '10%' },
        { data: 'song', width: '10%' },
        { data: null, width: '10%' },
        { data: 'price', width: '10%' },
        { data: 'rose', width: '10%' },
        { data: 'rose_percent', width: '10%' },
        { data: 'note', width: '10%' },
        { data: 'type', width: '10%' },
        { data: 'delivered_enough', width: '10%' },
        { data: null, width: '10%' }, //xa
        { data: 'mold', width: '10%' },
        { data: 'n_color', width: '10%' },
        { data: null, width: '10%' }, //in
        { data: null, width: '10%' }, // mang
        { data: null, width: '10%' }, //be
        { data: null, width: '10%' }, //chap
        { data: null, width: '10%' }, //dong
        { data: null, width: '10%' }, //dán
        { data: 'other', width: '10%' }, // khác
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
          targets: 1,
          render: function (data, type, full, meta){
            return '<a href="/finished-product/' + full['id'] + '" class="text' + full['id'] + '">' + data + '</a>';
          } 
        },
        { //xa
          targets: -11,
          render: function (data, type, full, meta){
            if (full['xa'] > 0)
              return full['xa'] +'<br>' +
                '<span class="badge bg-label-success">' + full['x'] + '</span>';
            return "";
          } 
        },
        { //in
          targets: -8,
          render: function (data, type, full, meta){
            if (full['in'] > 0)
              return full['in'] + '<br>' +
              '<span class="badge bg-label-success">' + full['in_n'] + '</span>';
            return ""
          } 
        },
        { //mang
          targets: -7,
          render: function (data, type, full, meta){
            if (full['mang'] > 0)
            return full['mang'] + '<br>' +
            '<span class="badge bg-label-success">' + full['mang_n'] + '</span>';
            return "";
          } 
        },
        { //be
          targets: -6,
          render: function (data, type, full, meta){
            if (full['be'] > 0)
              return full['be'] + '<br>' +
              '<span class="badge bg-label-success">' + full['be_n'] + '</span>';
            return "";
          } 
        },
        { //chap
          targets: -5,
          render: function (data, type, full, meta){
            if (full['chap'] > 0)
              return full['chap'] + '<br>' +
              '<span class="badge bg-label-success">' + full['chap_n'] + '</span>';
            return "";
          } 
        },
        { //dong
          targets: -4,
          render: function (data, type, full, meta){
            if (full['dong'] > 0)
              return full['dong'] + '<br>' +
              '<span class="badge bg-label-success">' + full['dong_n'] + '</span>';
            return "";
          } 
        },
        { //dán
          targets: -3,
          render: function (data, type, full, meta){
            if (full['dan'] > 0)
              return full['dan'] + '<br>' +
              '<span class="badge bg-label-success">' + full['dan_n'] + '</span>';
            return "";
          } 
        },
        { //other
          targets: -2,
          render: function (data, type, full, meta){
            if (full['other'] > 0)
              return full['other'] + '<br>' +
              '<span class="badge bg-label-success">' + full['other_n'] + '</span>';
            return "";
          } 
        },
        {
          targets: 9,
          render: function (data, type, row){
            let name = row.unit ? row.unit.name : '';
            return '<a href="' + domain + '/unit/?s=' + name + '">' + name + '</a>';
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
              '<li><a href="'+ domain +'/finished-product/' + full['id']+'" class="dropdown-item">Xem chi tiết</a></li>' +
              '<div class="dropdown-divider"></div>' +
              '<li><a href="javascript:;" class="dropdown-item text-danger delete-record" data-id=' + full['id'] + '>Xoá ' + full['name'] + '</a></li>' +
              '</ul>' +
              '</div>' +
              '<a href="javascript:;" class="btn btn-sm btn-icon item-edit" data-bs-toggle="modal" data-bs-target="#editUser2" onclick="editRecord(' + full['id'] + ')"><i class="text-primary ti ti-pencil"></i></a>'
            );
          }
        },
        {
          targets: [10],
          render: function (data, type, full, meta) {
            return data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");;
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
          text: '<i class="ti ti-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">Thêm thành phẩm</span>',
          className: 'create-new btn btn-primary waves-effect waves-light'
        }
      ],
    });
    $('div.head-label').html('<h5 class="card-title mb-0">Danh sách thành phẩm/h5>');
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
      url: domain + '/api/v1/finished-product/' + id,
      headers: {
        'Authorization': 'Bearer ' + authToken,
        'X-CSRF-TOKEN': csrfToken
      }
    }).done(function (data) {
      if (Math.floor(data.data > 0)) {
        dt_basic.row(clickedRow).remove().draw();
        toastr.success("Xóa thành phẩm thành công");
      } else {
        toastr.error("Xóa thành phẩm thất bại");
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