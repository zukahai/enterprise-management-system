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
                            <label class="form-label" for="select2">Khách hàng</label>
                            <div class="input-group input-group-merge">
                                <select class="select2 w-100" id="customer_select" name="customer_id" aria-label="Select2"
                                    aria-describedby="select2">
                                    {{-- options --}}
                                </select>
                            </div>
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

                        <div id="order" class="row g-3">
                            <label class="form-label text-success" for="order">Đơn hàng 1</label>
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
                                    <input type="number" id="edit_count" name="count" class="form-control dt-salary"
                                        placeholder="1234" aria-label="1234" aria-describedby="count" value="0"
                                        min="0" />
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label" for="time">Ngày giao</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="ti ti-calendar"></i></span>
                                    <input type="date" class="form-control dt-date" id="edit_delivery_date"
                                        name="delivery_date" aria-describedby="delivery_date" value="" />
                                </div>
                            </div>

                            
                        </div>


                        <div class="col-sm-12 text-center">
                            <button type="submit" class="btn btn-primary mx-auto" onclick="submitFormEdit()">Thêm 1 đơn
                                hàng</button>
                            <input onclick="addOrder()" type="button" value="+">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--/ Edit Object Modal -->
    <script>
        function addOrder() {
            // Lấy thẻ div có id là "order"
            var orderDiv = document.getElementById("order");
            let count = 7;
            // Tạo đoạn mã HTML cần thêm vào
            var htmlToAdd = `
    <label class="form-label text-success" for="order">Đơn hàng 1</label>
    <div class="col-sm-12">
        <label class="form-label" for="select2">Thành phẩm</label>
        <div class="input-group input-group-merge">
            <select class="select2 w-100" id="finished_product_select_add_${count}" name="finished_product_id" aria-label="Select2" aria-describedby="select2">
                {{-- options --}}
            </select>
        </div>
    </div>

    <div class="col-sm-6">
        <label class="form-label" for="count">Số lượng</label>
        <div class="input-group input-group-merge">
            <span class="input-group-text"><i class=""></i></span>
            <input type="number" id="edit_count" name="count" class="form-control dt-salary" placeholder="1234" aria-label="1234" aria-describedby="count" value="0" min="0" />
        </div>
    </div>

    <div class="col-sm-6">
        <label class="form-label" for="time">Ngày giao</label>
        <div class="input-group input-group-merge">
            <span class="input-group-text"><i class="ti ti-calendar"></i></span>
            <input type="date" class="form-control dt-date" id="edit_delivery_date" name="delivery_date" aria-describedby="delivery_date" value="" />
        </div>
    </div>
`;

            // Thêm đoạn mã HTML vào thẻ div
            orderDiv.insertAdjacentHTML('beforeend', htmlToAdd);

        }
        $('#finished_product_select_add_7').selectpicker();
    </script>

    <!-- DataTable with Buttons -->
    <div class="card">
        <div class="card-datatable table-responsive pt-0">

            <table class="datatables-basic table span-table" id="export-order-table">
                <thead>
                    <tr>
                        <th rowspan="2">HT</th>
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
