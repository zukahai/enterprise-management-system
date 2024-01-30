@extends('admin.layouts.main')

@section('open-dashboard')
    @php
        $super = 'info';
        $sub = 'supplier';
    @endphp
@endsection

@section('title')
    @php
        $title = 'Nhà cung cấp | Công ty Hoàng Phát';
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
    <script src="{{ asset('webhtml/assets/genarate/supplier.js') }}"></script>
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
    <!-- Edit User Modal -->
    <div class="modal fade" id="editUser2" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-simple modal-edit_user">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                        <h3 class="mb-2">Chỉnh sửa thông tin nhà cung cấp</h3>
                        <h2><a href="javascript:" class="mb-2 text-primary" id="edit_name-title"></a></h2>
                    </div>
                    <form id="editUserForm" class="row g-3" method="POST" action="{{ route('staff.update') }}"
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
                                        class="form-control dt-salary" placeholder="Số điện thoại"
                                        aria-label="Số điện thoại" aria-describedby="phone_numer" />
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <label class="form-label" for="contact">Liên hệ</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="fa-solid fa-address-card"></i></span>
                                    <input type="text" id="edit_contact" name="contact"
                                        class="form-control dt-salary" placeholder="Liên hệ" aria-label="Liên hệ"
                                        aria-describedby="contact" />
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
                            <button type="submit" class="btn btn-primary mx-auto" onclick="submitFormEdit()">Cập nhật
                                thông tin</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--/ Edit User Modal -->
    <!-- DataTable with Buttons -->
    <div class="card">
        <div class="card-datatable table-responsive pt-0">

            <table class="datatables-basic table">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Tên nhà cung cấp</th>
                        <th>Địa chỉ</th>
                        <th>MST</th>
                        <th>STK</th>
                        <th>Ngân Hàng</th>
                        <th>Thời gian nợ</th>
                        <th>Số điện thoại</th>
                        <th>Liên hệ</th>
                        <th>Ghi chú</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <!-- Modal to add new record -->
    <div class="offcanvas offcanvas-end" id="add-new-record">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title" id="exampleModalLabel">Thông tin nhà cung cấp</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body flex-grow-1">
            <form class="add-new-record pt-0 row g-2" id="form-add-new-record" method="POST"
                action="{{ route('supplier.create') }}" enctype="multipart/form-data">
                @csrf
                <div class="col-sm-12">
                    <label class="form-label" for="name">Tên nhà cung cấp<span
                            class="font-weight-bold text-danger">*</span></label>
                    <div class="input-group input-group-merge">
                        <span id="name" class="input-group-text"><i class="ti ti-user"></i></span>
                        <input type="text" id="name" class="form-control dt-name" name="name"
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
                        <input type="text" id="address" name="address" class="form-control dt-salary"
                            placeholder="Địa chỉ" aria-label="Địa chỉ" aria-describedby="address" />
                    </div>
                </div>
                <div class="col-sm-12">
                    <label class="form-label" for="mst">Mã số thuế</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="fas fa-angle-double-down"></i></span>
                        <input type="text" id="mst" name="mst" class="form-control dt-salary"
                            placeholder="Mã số thuế" aria-label="Mã số thuế" aria-describedby="mst" />
                    </div>
                </div>
                <div class="col-sm-12">
                    <label class="form-label" for="stk">Số tài khoản</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="fas fa-angle-double-down"></i></span>
                        <input type="text" id="stk" name="stk" class="form-control dt-salary"
                            placeholder="Số tài khoản" aria-label="Số tài khoản" aria-describedby="stk" />
                    </div>
                </div>

                <div class="col-sm-12">
                    <label class="form-label" for="select2">Ngân hàng</label>
                    <div class="input-group input-group-merge">
                        <select class="select2 w-100" id="bank_select" name="bank_id" aria-label="Select2"
                            aria-describedby="select2">
                            <!-- Options -->
                        </select>
                    </div>
                    <div class="col-sm-12">
                        <label class="form-label" for="note">Thời gian nợ</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="fa-solid fa-hourglass-half"></i></span>
                            <input type="datetime-local" class="form-control dt-date" id="time" name="time"
                                aria-describedby="time" placeholder="yyyy-MM-ddThh:mm:ss" value=""
                                min="1800-01-01T00:00" />
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label class="form-label" for="phone_number">Số điện thoại</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="fa-solid fa-phone-volume"></i></span>
                            <input type="text" id="phone_number" name="phone_number" class="form-control dt-salary"
                                placeholder="Số điện thoại" aria-label="Số điện thoại" aria-describedby="phone_number" />
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label class="form-label" for="contact">Liên hệ</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="fa-solid fa-address-card"></i></span>
                            <input type="text" id="contact" name="contact" class="form-control dt-salary"
                                placeholder="Liên hệ" aria-label="Liên hệ" aria-describedby="contact" />
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label class="form-label" for="note">Ghi chú</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="fa-solid fa-notes-medical"></i></span>
                            <input type="text" id="note" name="note" class="form-control dt-salary"
                                placeholder="Ghi chú" aria-label="Ghi chú" aria-describedby="note" />
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 mt-2">
                    <button type="submit" class="btn btn-primary me-sm-3 me-1" onclick="submitForm()">Thêm</button>
                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Huỷ</button>
                </div>
            </form>
        </div>
    </div>
    <!--/ DataTable with Buttons -->
   
    <script src="{{ asset('webhtml/assets/custom-js/supplier.js') }}"></script>

    <hr class="my-5" />
@endsection
