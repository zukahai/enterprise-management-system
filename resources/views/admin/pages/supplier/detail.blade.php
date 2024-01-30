@extends('admin.layouts.main')

@section('open-dashboard')
    @php
        $super = 'info';
        $sub = 'supplier';
    @endphp
@endsection

@section('title')
    @php
        $title = $object->name . ' | Nhà cung cấp| Công ty Hoàng Phát';
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
    <script src="{{ asset('webhtml/assets/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('webhtml/assets/vendor/libs/@form-validation/umd/bundle/popular.min.js') }}"></script>
    <script src="{{ asset('webhtml/assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
    <script src="{{ asset('webhtml/assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>
    <!-- Form Validation -->
@endsection

@section('content')
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">{{ ucfirst($super) }} /</span>
        <a href="{{ route('supplier.index') }}">{{ ucfirst($sub) }}</a>
        / {{ $object->name }}
    </h4>
    {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editUser2">
        Show
      </button> --}}

    <!-- Edit User Modal -->
    <div class="modal fade" id="edit" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-simple modal-edit-user">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                        <h3 class="mb-2">Chỉnh sửa thông tin nhà cung cấp</h3>
                        <h2><a href="javascript:" class="mb-2 text-primary" id="edit_name-title"></a></h2>
                    </div>
                    <form id="editForm" class="row g-3" method="POST" action="{{ route('home') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="col-sm-12">
                            <label class="form-label" for="name">Tên nhà cung cấp<span
                                    class="font-weight-bold text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <span id="name" class="input-group-text"><i class="ti ti-user"></i></span>
                                <input type="text" id="edit_name" class="form-control dt-name" name="name"
                                    placeholder="Nguyễn Văn A" aria-label="Nguyễn Văn A" aria-describedby="name" />
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label" for="address">Địa chỉ</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="fa-solid fa-address-book"></i></span>
                                <input type="text" id="edit_address" name="address" class="form-control dt-salary"
                                    placeholder="Địa chỉ" aria-label="Địa chỉ" aria-describedby="address" />
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label" for="mst">Mã số thuế</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="fas fa-angle-double-down"></i></span>
                                <input type="text" id="edit_mst" name="mst" class="form-control dt-salary"
                                    placeholder="Mã số thuế" aria-label="Mã số thuế" aria-describedby="mst" />
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label" for="stk">Số tài khoản</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="fas fa-angle-double-down"></i></span>
                                <input type="text" id="edit_stk" name="stk" class="form-control dt-salary"
                                    placeholder="Số tài khoản" aria-label="Số tài khoản" aria-describedby="stk" />
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <label class="form-label" for="select2">Ngân hàng</label>
                            <div class="input-group input-group-merge">
                                <select class="select2 w-100" id="edit_bank_select" name="bank_id" aria-label="Select2"
                                    aria-describedby="select2">
                                    <!-- Options -->
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label" for="note">Thời gian nợ</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="fa-solid fa-hourglass-half"></i></span>
                                <input type="datetime-local" class="form-control dt-date" id="edit_time" name="time"
                                    aria-describedby="time" placeholder="yyyy-MM-ddThh:mm:ss" value=""
                                    min="1800-01-01T00:00" />
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label" for="phone_numer">Số điện thoại</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="fa-solid fa-phone-volume"></i></span>
                                <input type="text" id="edit_phone_number" name="phone_number"
                                    class="form-control dt-salary" placeholder="Số điện thoại" aria-label="Số điện thoại"
                                    aria-describedby="phone_numer" />
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label" for="contact">Liên hệ</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="fa-solid fa-address-card"></i></span>
                                <input type="text" id="edit_contact" name="contact" class="form-control dt-salary"
                                    placeholder="Liên hệ" aria-label="Liên hệ" aria-describedby="contact" />
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label" for="note">Ghi chú</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="fa-solid fa-notes-medical"></i></span>
                                <input type="text" id="edit_note" name="note" class="form-control dt-salary"
                                    placeholder="Ghi chú" aria-label="Ghi chú" aria-describedby="note" />
                            </div>
                        </div>
                </div>

                <div class="col-sm-12 text-center">
                    <button type="abc" class="btn btn-primary mx-auto">Cập nhật
                        thông tin</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <!--/ Edit User Modal -->

    <!-- Delete User Modal -->
    <div class="modal fade" id="delete-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-simple modal-edit-user">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                        <h3 class="mb-2">Xác nhận xoá nhà cung cấp</h3>
                        <h2><a href="javascript:" class="mb-2 text-primary"
                                id="delete-name-title">{{ $object->name }}</a></h2>
                    </div>
                    <div id="" class="row g-3" method="POST">
                        <div class="col-sm-12 text-center">
                            <button type="submit" class="btn btn-primary mx-auto" onclick="deleteObject({{ $object->id }}, 'supplier', 'nhà cung cấp')">Xoá</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Delete User Modal -->


    <div class="card">
        <div class="card-datatable table-responsive pt-0">

            <table class="datatables-basic table span-table" id="table-detail">
                <thead>

                </thead>
                <tbody>
                    <tr>
                        <td>Mã</td>
                        <td>{{ $object->id }}</td>
                    </tr>
                    <tr>
                        <td>Tên nhà cung cấp</td>
                        <td>{{ $object->name }}</td>
                    </tr>
                    <tr>
                        <td>Địa chỉ</td>
                        <td>{{ $object->address }}</td>
                    </tr>
                    <tr>
                        <td>Mã số thuế</td>
                        <td>{{ $object->mst }}</td>
                    </tr>
                    <tr>
                        <td>Số tài khoản</td>
                        <td>{{ $object->stk }}</td>
                    </tr>
                    <tr>
                        <td>Ngân hàng</td>
                        <td>{{ $object->bank->name }} {{ $object->bank->note ? '(' . $object->bank->note . ')' : '' }}</td>
                    </tr>
                    <tr>
                        <td>Thời gian nợ</td>
                        <td>{{ $object->time }}</td>
                    </tr>
                    <tr>
                        <td>Số điện thoại</td>
                        <td>{{ $object->phone_number }}</td>
                    </tr>
                    <tr>
                        <td>Liên hệ</td>
                        <td>{{ $object->contact }}</td>
                    </tr>
                    <tr>
                        <td>Ghi chú</td>
                        <td>{{ $object->note }}</td>
                    </tr>
                </tbody>
            </table>

        </div>
        <div class="col-sm-12 text-center mb-2">
            <button class="btn btn-primary me-sm-3 me-1" data-bs-toggle="modal" data-bs-target="#edit"
                onclick="editRecord({{ $object->id }})">Chỉnh sửa</button>
            <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#delete-modal">Xoá</button>
        </div>
        <div class="bank-quick col-sm-12 mb-2 container">
            <hr>
            <h4>Chuyển khoản nhanh</h4>
            <span id="qr-error" class="text-success">Mã chuyển khoản được tạo từ thông tin nhà cung cấp</span>
            <div class="text-center">
                <img id="qrcode" class="my-2 rounded-2"
                    src="https://api.vietqr.io/{{ $object->bank->code }}/{{ $object->stk }}/0/Hoang Phat/vietqr_net_2.jpg"
                    alt="Ngân hàng không hợp lệ" srcset="">
            </div>
            <div class="row mb-2">
                <div class="col-sm-4">
                    <label class="form-label" for="select2">Ngân hàng</label>
                    <div class="input-group input-group-merge">
                        <select class="select2 w-100" id="bank_qr" name="bank_id" aria-label="Select2"
                            aria-describedby="select2" onchange="changeQR()" onkeyup="changeQR()" >
                            <!-- Options -->
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <label class="form-label" for="x">Số tài khoản</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class=""></i></span>
                        <input type="text" id="stk" name="stk" class="form-control dt-salary"
                            placeholder="Số tài khoản" aria-label="Số tài khoản" aria-describedby="x"
                            value="{{ $object->stk }}" onchange="changeQR()" onkeyup="changeQR()" />
                    </div>
                </div>
                <div class="col-sm-4">
                    <label class="form-label" for="xa">Số tiền</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="ti ti-currency-dollar"></i></span>
                        <input type="number" id="money" name="money" class="form-control dt-salary"
                            placeholder="Số tiền" aria-label="Số tiền" aria-describedby="xa" value="0"
                            min="0" onchange="changeQR()" onkeyup="changeQR()" />
                    </div>
                </div>
                <div class="col-sm-12">
                    <label class="form-label" for="x">Nội dung chuyển khoản</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class=""></i></span>
                        <input type="text" id="content" name="content" class="form-control dt-salary"
                            placeholder="X" aria-label="X" aria-describedby="x" value="Hoang Phat"
                            onchange="changeQR()" onkeyup="changeQR()" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let code = "{{ $object->bank->code }}";
    </script>

    <script src="{{ asset('webhtml/assets/custom-js/detail-supplier.js') }}"></script>

    <hr class="my-5" />
@endsection
