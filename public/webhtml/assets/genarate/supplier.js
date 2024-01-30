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
          offCanvasEl.show();
        });
      }
    }, 200);
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
        url: domain + '/api/v1/supplier',
        type: 'GET',
        headers: {
          'Authorization': 'Bearer ' + authToken,
        },
        done: function (data) {
          // console.log(data);
        }
      },
      columns: [
        { data: 'id', width: '10%' },
        { data: 'name', width: '10%' },
        { data: 'address', width: '10%' },
        { data: 'mst', width: '10%' },
        { data: 'stk', width: '10%' },
        { data: null}, // ngân hàng
        { data: 'time', width: '10%' },
        { data: 'phone_number', width: '10%' },
        { data: 'contact', width: '10%' },
        { data: 'note', width: '10%' },
        { data: '', orderable: false, width: '10%' }
      ],
      search: {
        search: getSearchParamFromURL()
      },
      Responsive: true,
      columnDefs: [
        {
          targets: 1,
          render: function (data, type, row) {
            return '<a href="' + domain + '/supplier/' + row.id + '">' + row.name + '</a>';
          },
        },
        {
          targets: 5,
          render: function (data, type, row) {
            // Sử dụng dữ liệu từ trường bank.name
            let name = row.bank ? row.bank.name : '';
            let id = row.bank? row.bank.id : '';
            return '<a href="' + domain + '/bank/?s=' + name + '">' + name + '</a>';
          },
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
              '<li><a href="javascript:;" class="dropdown-item">Hồ sơ</a></li>' +
              '<div class="dropdown-divider"></div>' +
              '<li><a href="javascript:;" class="dropdown-item text-danger delete-record" data-id=' + full['id'] + '>Xoá ' + full['name'] + '</a></li>' +
              '</ul>' +
              '</div>' +
              '<a href="javascript:;" class="btn btn-sm btn-icon item-edit" data-bs-toggle="modal" data-bs-target="#editUser2" onclick="editRecord(' + full['id'] + ')"><i class="text-primary ti ti-pencil"></i></a>'
            );
          }
        }
      ],
      order: [[0, 'desc']],
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
                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
              },
              customize: function (win) {
                //customize print view for dark
                $(win.document.body)
                  .css('color', config.colors.headingColor)
                  .css('border-color', config.colors.borderColor)
                  .css('background-color', config.colors.bodyBg);
                $(win.document.body)
                  .find('table')
                  .addClass('compact')
                  .css('color', 'inherit')
                  .css('border-color', 'inherit')
                  .css('background-color', 'inherit');
              }
            },
            {
              extend: 'excel',
              text: '<i class="ti ti-file-spreadsheet me-1"></i>Excel',
              className: 'dropdown-item',
              exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
              
              }
            },
            {
              extend: 'pdf',
              text: '<i class="ti ti-file-description me-1"></i>Pdf',
              className: 'dropdown-item',
              exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                charset: 'utf-8', // Thêm cấu hình charset UTF-8
                bom: true, // Thêm cấu hình BOM để đảm bảo định dạng UTF-8
              }
            },
            {
              extend: 'copy',
              text: '<i class="ti ti-copy me-1" ></i>Copy',
              className: 'dropdown-item',
              exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
              }
            }
          ]
        },
        {
          text: '<i class="ti ti-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">Thêm nhà cung cấp</span>',
          className: 'create-new btn btn-primary waves-effect waves-light'
        }
      ],
    });
    $('div.head-label').html('<h5 class="card-title mb-0">Danh sách nhà cung cấp/h5>');
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
      url: domain + '/api/v1/supplier/' + id,
      headers: {
        'Authorization': 'Bearer ' + authToken,
        'X-CSRF-TOKEN': csrfToken
      }
    }).done(function (data) {
      if (Math.floor(data.data > 0)) {
        dt_basic.row(clickedRow).remove().draw();
        toastr.success("Xóa nhà cung cấp thành công");
      } else {
        toastr.error("Xóa nhà cung cấp thất bại");
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
