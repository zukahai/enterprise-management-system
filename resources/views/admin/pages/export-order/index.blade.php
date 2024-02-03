@extends('admin.layouts.main')

@section('open-dashboard')
    @php
        $super = 'order';
        $sub = 'export-order';
    @endphp
@endsection

@section('title')
    @php
        $title = 'Đơn hàng xuất | Công ty Hoàng Phát';
    @endphp
@endsection

@section('onload')
    @if ($message = Session::get('success'))
        onload="loadPage('{{ $message }}' , 'success')"
    @endif
    @if ($message = Session::get('error'))
        onload="loadPage('{{ $message }}' , 'danger')"
    @endif
    @if ($message = Session::get('warning'))
        onload="loadPage('{{ $message }}' , 'warning')"
    @endif
@endsection

@section('js-other')
    <!-- Page JS -->
    <script src="{{ asset('webhtml/assets/genarate/export-order.js') }}"></script>
    <script src="{{ asset('webhtml/assets/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('webhtml/assets/vendor/libs/@form-validation/umd/bundle/popular.min.js') }}"></script>
    <script src="{{ asset('webhtml/assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
    <script src="{{ asset('webhtml/assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>
    <!-- Form Validation -->
@endsection

@section('content')
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">{{ ucfirst($super) }} /</span> {{ ucfirst($sub) }}</h4>
    {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editUser2">
        Show
      </button> --}}
    <!-- Edit Object Modal -->
    <div class="modal fade" id="editObjectModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-simple modal-edit-Object">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                        <h3 class="mb-2">Chỉnh sửa thông tin thành phẩm</h3>
                        <h2><a href="javascript:" class="mb-2 text-primary" id="edit-name-title"></a></h2>
                    </div>
                    <form id="editForm" class="row g-3" method="POST" action="{{ route('staff.update') }}"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="col-sm-12">
                            <h4 class="text-success text-center" id="text-name"> </h4>
                        </div>

                        <div class="col-sm-12">
                            <label class="form-label" for="select2">Thành phẩm</label>
                            <div class="input-group input-group-merge">
                                <select class="select2 w-100" id="finished_product_select" name="finished_product_id"
                                    aria-label="Select2" aria-describedby="select2">
                                    {{-- options --}}
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label class="form-label" for="count">Số lượng</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class=""></i></span>
                                <input type="number" id="edit_count" name="count" class="form-control dt-salary"
                                    placeholder="1234" aria-label="1234" aria-describedby="count" min="0" />
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label class="form-label" for="time">Ngày giao</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="ti ti-calendar"></i></span>
                                <input type="date" class="form-control dt-date" id="edit_delivery_date"
                                    name="delivery_date" aria-describedby="delivery_date" />
                            </div>
                        </div>


                        <div class="col-sm-12">
                            <label class="form-label" for="select2">Trạng thái</label>
                            <div class="input-group input-group-merge">
                                <select class="select2 w-100" id="status_select" name="status" aria-label="Select2"
                                    aria-describedby="select2">
                                    <option value="1">Hoàn thành</option>
                                    <option value="0">Đang chờ</option>
                                    <option value="2">Đã huỷ</option>
                                </select>
                            </div>
                        </div>


                        <div class="col-sm-12 text-center">
                            <button type="submit" class="btn btn-primary mx-auto" onclick="submitFormEdit()">Cập nhật
                                thông tin</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--/ Edit Object Modal -->

    <!-- Edit Object Modal -->
    <div class="modal fade" id="add-export-order" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-simple modal-edit-Object">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                        <h3 class="mb-2">Thêm đơn hàng</h3>
                        <h2><a href="javascript:" class="mb-2 text-primary" id="edit-name-title"></a></h2>
                    </div>
                    <form id="editForm" class="row g-3" method="POST" action="{{ route('export-order.create') }}"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="col-sm-12">
                            <label class="form-label" for="select2">Khách hàng</label>
                            <div class="input-group input-group-merge">
                                <select class="select2 w-100" id="customer_select_add" name="customer_id"
                                    aria-label="Select2" aria-describedby="select2">
                                    {{-- options --}}
                                </select>
                            </div>
                        </div>

                        <hr>
                        <div id="order">
                            {{-- Thêm các dữ liệu --}}
                        </div>

                        <div class="">
                            <div class="row">
                                <label class="text-success" id="label-id" for="">Đơn hàng thứ 1</label>
                                <div class="col-sm-12">
                                    <label class="form-label" for="select2">Thành phẩm</label>
                                    <div class="input-group input-group-merge">
                                        <select class="select2 w-100" id="finished_product_select_add"
                                            name="finished_product_id" aria-label="Select2" aria-describedby="select2">
                                            {{-- options --}}
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label class="form-label" for="count">Số lượng</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class=""></i></span>
                                        <input type="number" id="count" name="count"
                                            class="form-control dt-salary" placeholder="1234" aria-label="1234"
                                            aria-describedby="count" value="0" min="0" />
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label class="form-label" for="time">Ngày giao</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="ti ti-calendar"></i></span>
                                        <input type="date" class="form-control dt-date" id="delivery_date"
                                            name="delivery_date" aria-describedby="delivery_date" value="" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="count_order" id="count_order" value="1">


                        <div class="col-sm-12 text-center">
                            <button type="submit" id="add-all" class="btn btn-primary mx-auto"
                                onclick="submitFormEdit()">Thêm 1 đơn
                                hàng</button>
                            <span onclick="addOrder()" class="btn btn-success" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Chọn thêm thành phẩm khác">
                                <i class="ti ti-plus"></i>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--/ Edit Object Modal -->
    <script>
        let id_order = 0;
        let count_order = 1;

        function addOrder() {
            // Lấy thẻ div có id là "order"
            var orderDiv = document.getElementById("order");
            id_order = id_order + 1;
            count_order = count_order + 1;
            let finished_product_id = document.getElementById("finished_product_select_add").value;
            let text_finished_product = document.getElementById("finished_product_select_add").options[document
                .getElementById("finished_product_select_add").selectedIndex].text
            let count = document.getElementById("count").value;
            let delivery_date = document.getElementById("delivery_date").value;
            // Tạo đoạn mã HTML cần thêm vào
            var htmlToAdd = `
            <div class="row mr-0" id="order_${id_order}">
                <label class="text-success ${(id_order > 1 ? "mt-5" : "")}" for="">Đơn hàng thứ ${id_order}</label>
                <div class="col-sm-12">
                    <label class="form-label" for="select2">Thành phẩm</label>
                    <div class="input-group input-group-merge">
                        <input type="text" id="" name="text_finished_product_${id_order}"
                            class="form-control dt-salary" value="${text_finished_product}" readonly />
                            <input type="hidden" id="" name="finished_product_id_${id_order}"
                            class="form-control dt-salary" value="${finished_product_id}" readonly/>
                    </div>
                </div>

                <div class="col-sm-6">
                    <label class="form-label" for="count">Số lượng</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class=""></i></span>
                        <input type="number" id="" name="count_${id_order}" class="form-control dt-salary"
                            placeholder="1234" aria-label="1234" aria-describedby="count" value="${count}"
                            />
                    </div>
                </div>

                <div class="col-sm-6">
                    <label class="form-label" for="time">Ngày giao</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="ti ti-calendar"></i></span>
                        <input type="date" class="form-control dt-date" id=""
                            name="delivery_date_${id_order}" aria-describedby="delivery_date" value="${delivery_date}"/>
                    </div>
                </div>
               <div class="col-sm-12 mt-2 d-flex justify-content-end">
                    <span onclick="removeDiv(${id_order})" class="btn btn-sm btn-label-danger" data-bs-toggle="tooltip"
                        data-bs-placement="right" title="Xóa đơn hàng thứ ${id_order}">
                        <i class="ti ti-trash"></i> Xoá đơn hàng thứ ${id_order}
                    </span>
                </div>
            </div>
                `;

            // Thêm đoạn mã HTML vào thẻ div
            orderDiv.insertAdjacentHTML('beforeend', htmlToAdd);

            document.getElementById("count_order").value = (id_order + 1);
            document.getElementById("label-id").innerHTML = "Đơn hàng thứ " + (id_order + 1);
            document.getElementById("add-all").innerHTML = "Thêm " + count_order  + " đơn hàng";
        }

        function removeDiv(id) {
            document.getElementById("order_" + id).remove();
            count_order = count_order - 1;
            document.getElementById("add-all").innerHTML = "Thêm " + count_order + " đơn hàng";
        }
    </script>

    <!-- DataTable with Buttons -->
    <div class="card">
        <div class="card-datatable table-responsive pt-0">

            <table class="datatables-basic table span-table" id="export-order-table">
                <thead>
                    <tr>
                        <th rowspan="2">HT</th>
                        <th rowspan="2"></th> <!--created_at-->
                        <th rowspan="2">Trang thái</th>
                        <th rowspan="2">Khách hàng</th>
                        <th rowspan="2">Ngày giao</th>
                        <th rowspan="2">Mã nội bộ</th>
                        <th rowspan="2">Tên sản phẩm</th>
                        <th colspan="3" class="color-1">KT đơn hàng</th>
                        <th colspan="3" class="color-2">KT sản xuất</th>
                        <th rowspan="2">Sóng</th>
                        <th rowspan="2">Đơn vị</th>
                        <th rowspan="2">Đơn giá</th>
                        <th rowspan="2">Số lượng</th>
                        <th rowspan="2">Thành tiền</th>
                        <th rowspan="2">Hoa hồng</th>
                        <th rowspan="2">% Hoa hồng</th>
                        <th rowspan="2">Ghi chú</th>
                        <th rowspan="2">Kiểu</th>
                        <th rowspan="2">Giao đủ</th>
                        <th rowspan="2">Xả</th>
                        <th rowspan="2">Phim / Khuôn</th>
                        <th rowspan="2">Số màu</th>
                        <th rowspan="2">In</th>
                        <th rowspan="2">Màng</th>
                        <th rowspan="2">Bế</th>
                        <th rowspan="2">Chạp</th>
                        <th rowspan="2">Đóng</th>
                        <th rowspan="2">Dán</th>
                        <th rowspan="2">Khác</th>
                        <th rowspan="2">Thao tác</th>
                    </tr>
                    <tr>
                        <th>Dài</th>
                        <th>Rộng</th>
                        <th>Cao</th>
                        <th>Dài</th>
                        <th>Rộng</th>
                        <th>Cao</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <script src="{{ asset('webhtml/assets/custom-js/export-order.js') }}"></script>

    <hr class="my-5" />
@endsection
