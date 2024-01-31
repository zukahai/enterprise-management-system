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
  })();
});


// datatable (jquery)
$(function () {
  var dt_basic_table = $('.datatables-detail'),
    dt_complex_header_table = $('.dt-complex-header'),
    dt_row_grouping_table = $('.dt-row-grouping'),
    dt_multilingual_table = $('.dt-multilingual'),
    dt_basic;

  // DataTable with buttons
  // --------------------------------------------------------------------

  if (dt_basic_table.length) {
    let authToken = localStorage.getItem('authToken') || "";
    var domain = document.documentElement.getAttribute('data-domain');
    let customer_id = document.getElementById('customer_id').value;
    // console.log('authtoken',authToken);
    dt_basic = dt_basic_table.DataTable({
      language: {
        url: 'https://cdn.datatables.net/plug-ins/1.10.21/i18n/Vietnamese.json'
      },
      ajax: {
        url: domain + '/api/v1/customer/' + customer_id,
        type: 'GET',
        headers: {
          'Authorization': 'Bearer ' + authToken,
        },
        success: function (response) {
          // Đổ dữ liệu vào DataTable
          dt_basic.rows.add(response.data.export_order).draw();
      },
      },
      columns: [
        { data: 'id', width: '10%' },
        { data: 'finished_product.name', width: '30%' },
        { data: 'count', width: '20%' },
        { data: 'finished_product.price', width: '20%' },
        { data: null, width: '10%' }, // thành tiền
        { data: 'status', width: '10%' },
      ],
      Responsive: true,
      columnDefs: [
        {
          // name
          targets: 1,
          render: function (data, type, full, meta) {
            return '<a href="../../../finished-product/' + full['finished_product']['id'] + '">' + data + '</a>';
          }
        },
        {
          targets: [2, 3],
          render: function (data, type, full, meta) {
            return formatNumber(data);
          }
        },
        {
          targets: [4],
          render: function (data, type, full, meta) {
            let total_price_row = BigInt(BigInt(full['count']) * BigInt(full['finished_product']['price']));
            return formatNumber(total_price_row);
          }
        },
        {
          targets: [5],
          render: function (data, type, full, meta) {
            let text = (data == '1') ? 'Hoàn thành' : 'Chưa hoàn thành';
            let bootstrap_class = (data == '1') ? 'badge bg-label-success' : 'badge bg-label-danger';
            return '<span class="' + bootstrap_class + '">' + text + '</span>';
          }
        }
      ],
      order: [[0, 'desc']],
      dom: '<"card-header flex-column flex-md-row"<"head-label text-center"><"dt-action-buttons text-end pt-3 pt-md-0"B>><"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      displayLength: 7,
      lengthMenu: [7, 10, 25, 50, 75, 100],
      buttons: [
      ],
    });
    $('div.head-label').html('<h5 class="card-title mb-0">Danh sách khách hàng/h5>');
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
      url: domain + '/api/v1/customer/' + id,
      headers: {
        'Authorization': 'Bearer ' + authToken,
        'X-CSRF-TOKEN': csrfToken
      }
    }).done(function (data) {
      if (Math.floor(data.data > 0)) {
        dt_basic.row(clickedRow).remove().draw();
        toastr.success("Xóa khách hàng thành công");
      } else {
        toastr.error("Xóa khách hàng thất bại");
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
