@extends('admin.layouts.main')

@section('open-dashboard')
    @php
        $super = 'info';
        $sub = 'customer';
    @endphp
@endsection

@section('title')
    @php
        $title = 'Khách hàng | Công ty Hoàng Phát';
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
    <script src="{{ asset('webhtml/assets/genarate/customers.js') }}"></script>
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
        <div class="modal-dialog modal-lg modal-simple modal-edit-user">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                        <h3 class="mb-2">Chỉnh sửa thông tin khách hàng</h3>
                        <h2><a href="javascript:" class="mb-2 text-primary" id="edit-name-title"></a></h2>
                    </div>
                    <form id="editUserForm" class="row g-3" method="POST" action="{{ route('staff.update') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="col-sm-12">
                            <label class="form-label" for="name">Tên khách hàng <span
                                    class="font-weight-bold text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <span id="name" class="input-group-text"><i class="ti ti-user"></i></span>
                                <input type="text" id="edit-name" class="form-control dt-name" name="name"
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
                                <span class="input-group-text"><i class="ti ti-user"></i></span>
                                <input type="text" id="edit-address" name="address" class="form-control dt-email"
                                    placeholder="Địa chỉ" aria-label="Địa chỉ" />
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <label class="form-label" for="mst">Mã số thuế</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="ti ti-mail"></i></span>
                                <input type="text" id="edit-mst" name="mst" class="form-control dt-mst"
                                    placeholder="Mã số thuế" aria-label="Mã số thuế" />
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label" for="time">Thời gian nợ</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="ti ti-calendar"></i></span>
                                <input type="datetime-local" class="form-control dt-date" id="edit-time" name="time"
                                    aria-describedby="time" placeholder="yyyy-MM-ddThh:mm:ss" value=""
                                    min="1800-01-01T00:00" />
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label" for="phone_number">Số điện thoại</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="ti ti-currency-dollar"></i></span>
                                <input type="text" id="edit-phone_number" name="phone_number"
                                    class="form-control dt-salary" placeholder="0987654321" aria-label="0987654321"
                                    aria-describedby="phone_number" />
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label" for="contact">Liên hệ</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="ti ti-currency-dollar"></i></span>
                                <input type="text" id="edit-contact" name="contact" class="form-control dt-salary"
                                    placeholder="Thông tin liên hệ" aria-label="Thông tin liên hệ"
                                    aria-describedby="contact" />
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label" for="note">Ghi chú</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="ti ti-currency-dollar"></i></span>
                                <input type="text" id="edit-note" name="note" class="form-control dt-salary"
                                    placeholder="Ghi chú" aria-label="Ghi chú" aria-describedby="note" />
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
                        <th>Tên khách hàng</th>
                        <th>Địa chỉ</th>
                        <th>Mã số thuế</th>
                        <th>Thời gian nợ</th>
                        <th>Số điện thoại</th>
                        <th>Liện hệ</th>
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
            <h5 class="offcanvas-title" id="exampleModalLabel">Thông tin khách hàng</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body flex-grow-1">
            <form class="add-new-record pt-0 row g-2" id="form-add-new-record" method="POST"
                action="{{ route('customer.create') }}" enctype="multipart/form-data">
                @csrf
                <div class="col-sm-12">
                    <label class="form-label" for="name">Tên khách hàng <span
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
                        <span class="input-group-text"><i class="ti ti-user"></i></span>
                        <input type="text" id="name" name="address" class="form-control dt-email"
                            placeholder="Địa chỉ" aria-label="Địa chỉ" />
                    </div>
                </div>

                <div class="col-sm-12">
                    <label class="form-label" for="mst">Mã số thuế</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="ti ti-mail"></i></span>
                        <input type="text" id="mst" name="mst" class="form-control dt-mst"
                            placeholder="Mã số thuế" aria-label="Mã số thuế" />
                    </div>
                </div>
                <div class="col-sm-12">
                    <label class="form-label" for="time">Thời gian nợ</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="ti ti-calendar"></i></span>
                        <input type="datetime-local" class="form-control dt-date" id="time" name="time"
                                    aria-describedby="time" placeholder="yyyy-MM-ddThh:mm:ss" value=""
                                    min="1800-01-01T00:00" />
                    </div>
                </div>
                <div class="col-sm-12">
                    <label class="form-label" for="phone_number">Số điện thoại</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="ti ti-currency-dollar"></i></span>
                        <input type="text" id="phone_number" name="phone_number" class="form-control dt-salary"
                            placeholder="0987654321" aria-label="0987654321" aria-describedby="phone_number" />
                    </div>
                </div>
                <div class="col-sm-12">
                    <label class="form-label" for="contact">Liên hệ</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="ti ti-currency-dollar"></i></span>
                        <input type="text" id="contact" name="contact" class="form-control dt-salary"
                            placeholder="Thông tin liên hệ" aria-label="Thông tin liên hệ" aria-describedby="contact" />
                    </div>
                </div>
                <div class="col-sm-12">
                    <label class="form-label" for="note">Ghi chú</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="ti ti-currency-dollar"></i></span>
                        <input type="text" id="note" name="note" class="form-control dt-salary"
                            placeholder="Ghi chú" aria-label="Ghi chú" aria-describedby="note" />
                    </div>
                </div>
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary me-sm-3 me-1" onclick="submitForm()">Thêm</button>
                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Huỷ</button>
                </div>
            </form>
        </div>
    </div>
    <!--/ DataTable with Buttons -->
    {{-- validate form --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let validateF = {
                fields: {
                    name: {
                        validators: {
                            notEmpty: {
                                message: 'Tên khách hàng không được trống'
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap5: new FormValidation.plugins.Bootstrap5({
                        // Use this for enabling/changing valid/invalid class
                        // eleInvalidClass: '',
                        eleValidClass: '',
                        rowSelector: '.col-sm-12'
                    }),
                    submitButton: new FormValidation.plugins.SubmitButton(),
                    // defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                    autoFocus: new FormValidation.plugins.AutoFocus()
                },
                init: instance => {
                    instance.on('plugins.message.placed', function(e) {
                        if (e.element.parentElement.classList.contains('input-group')) {
                            e.element.parentElement.insertAdjacentElement('afterend', e
                                .messageElement);
                        }
                    });
                }
            }
            formAddNewRecord = document.getElementById('form-add-new-record');
            fv_customer = FormValidation.formValidation(formAddNewRecord, validateF);
            fromEdit = document.getElementById('editUserForm');
            fvEdit_customer = FormValidation.formValidation(fromEdit, validateF);
        });

        function submitForm() {
            fv_customer.validate().then(function(status) {
                if (status === 'Valid') {
                    // Nếu tất cả đều thoả mãn, trả về true
                    document.getElementById("form-add-new-record").submit();
                } else {

                }
            });
        }

        function submitFormEdit() {
            fvEdit_customer.validate().then(function(status) {
                if (status === 'Valid') {
                    // Nếu tất cả đều thoả mãn, trả về true
                    document.getElementById("editUserForm").submit();
                } else {

                }
            });
        }
    </script>

    {{-- modal edit --}}
    <script>
        function editRecord(id) {
            let authToken = localStorage.getItem('authToken') || "";
            let csrfToken = $('meta[name="csrf-token"]').attr('content');
            var domain = document.documentElement.getAttribute('data-domain');

            var editForm = document.getElementById('editUserForm');
            editForm.action = domain + '/customer/update/' + id;

            $.ajax({
                type: 'GET',
                url: domain + '/api/v1/customer/' + id,
                headers: {
                    'Authorization': 'Bearer ' + authToken,
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(data) {
                    if (data.data != undefined && data.data != []) {
                        let fullData = data.data;
                        console.log(fullData);
                        document.getElementById('edit-name').value = fullData.name;
                        document.getElementById('edit-address').value = fullData.address;
                        document.getElementById('edit-mst').value = fullData.mst;
                        document.getElementById('edit-time').value = fullData.time;
                        document.getElementById('edit-phone_number').value = fullData.phone_number;
                        document.getElementById('edit-contact').value = fullData.contact;
                        document.getElementById('edit-note').value = fullData.note;
                        document.getElementById('edit-name-title').textContent = fullData.name;
                    }
                }
            });
        }
    </script>

    <hr class="my-5" />
@endsection
