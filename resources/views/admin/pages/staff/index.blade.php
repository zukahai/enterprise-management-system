@extends('admin.layouts.main')

@section('open-dashboard')
    @php
        $super = 'info';
        $sub = 'staff';
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
    <script src="{{ asset('webhtml/assets/js/tables-datatables-basic.js') }}"></script>
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
                        <h3 class="mb-2">Chỉnh sửa thông tin nhân viên</h3>
                        <h2><a href="javascript:" class="mb-2 text-primary" id="edit-name-title"></a></h2>
                        <img src="" alt="" srcset="" class="avata" id="avata">
                    </div>
                    <form id="editUserForm" class="row g-3" method="POST" action="{{ route('staff.update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="col-sm-12">
                            <label class="form-label" for="username">Tên đăng nhập <span
                                    class="font-weight-bold text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <span id="username" class="input-group-text"><i class="ti ti-user"></i></span>
                                <input type="text" id="edit-username" class="form-control dt-username" name="username"
                                    placeholder="Tên đăng nhập" aria-label="Tên đăng nhập" aria-describedby="username" />
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label" for="name">Tên nhân viên</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="ti ti-user"></i></span>
                                <input type="text" id="edit-name" name="name" class="form-control dt-email"
                                    placeholder="Nguyễn Văn A" aria-label="Nguyễn Văn A" />
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <label class="form-label" for="email">Email</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="ti ti-mail"></i></span>
                                <input type="email" id="edit-email" name="email" class="form-control dt-email"
                                    placeholder="john.doe@example.com" aria-label="john.doe@example.com" />
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label" for="birthday">Ngày sinh</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="ti ti-calendar"></i></span>
                                <input type="date" class="form-control dt-date" id="edit-birthday" name="birthday"
                                    aria-describedby="birthday" placeholder="dd-mm-yyyy" value=""
                                    min="1800-01-01" />
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label" for="cccd">Căn cước công dân</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i
                                        class="ti ti-currency-dollar"></i></span>
                                <input type="number" id="edit-cccd" name="cccd" class="form-control dt-salary"
                                    placeholder="184222888" aria-label="184222888" aria-describedby="cccd" />
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label" for="address">Địa chỉ</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i
                                        class="ti ti-currency-dollar"></i></span>
                                <input type="text" id="edit-address" name="address" class="form-control dt-salary"
                                    placeholder="Hà Nội" aria-label="Hà Nội" aria-describedby="address" />
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label" for="phone_number">Số điện thoại</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i
                                        class="ti ti-currency-dollar"></i></span>
                                <input type="number" id="edit-phone_number" name="phone_number"
                                    class="form-control dt-salary" placeholder="0987654321" aria-label="0987654321"
                                    aria-describedby="phone_number" />
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label" for="business_day">Ngày công</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i
                                        class="ti ti-currency-dollar"></i></span>
                                <input type="number" id="edit-business_day" name="business_day"
                                    class="form-control dt-salary" placeholder="250000" aria-label="250000"
                                    aria-describedby="business_day" value="0" min="0" />
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label" for="allowance">Phụ cấp</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i
                                        class="ti ti-currency-dollar"></i></span>
                                <input type="number" id="edit-allowance" name="allowance" class="form-control dt-salary"
                                    placeholder="3000000" aria-label="250000" aria-describedby="allowance"
                                    value="0" min="0" />
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label" for="avata">Ảnh đại diện</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i
                                        class="ti ti-currency-dollar"></i></span>
                                <input type="file" id="edit-avata" name="avata" class="form-control dt-salary"
                                    placeholder="3000000" aria-label="250000" aria-describedby="avata" />
                            </div>
                        </div>
                        <div class="col-sm-12 text-center">
                            <button type="submit" class="btn btn-primary mx-auto" onclick="submitFormEdit()">Cập nhật thông tin</button>
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
                        <th></th>
                        <th></th>
                        <th>id</th>
                        <th>Nhân Viên</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>CCCD</th>
                        <th>Địa chỉ</th>
                        <th>Ngày sinh</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <!-- Modal to add new record -->
    <div class="offcanvas offcanvas-end" id="add-new-record">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title" id="exampleModalLabel">Thông tin nhân viên</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body flex-grow-1">
            <form class="add-new-record pt-0 row g-2" id="form-add-new-record" method="POST"
                action="{{ route('staff.create') }}" enctype="multipart/form-data">
                @csrf
                <div class="col-sm-12">
                    <label class="form-label" for="username">Tên đăng nhập <span
                            class="font-weight-bold text-danger">*</span></label>
                    <div class="input-group input-group-merge">
                        <span id="username" class="input-group-text"><i class="ti ti-user"></i></span>
                        <input type="text" id="username" class="form-control dt-username" name="username"
                            placeholder="Tên đăng nhập" aria-label="Tên đăng nhập" aria-describedby="username" />
                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-12">
                    <label class="form-label" for="password">Mật khẩu <span
                            class="font-weight-bold text-danger">*</span></label>
                    <div class="input-group input-group-merge">
                        <span id="password" class="input-group-text"><i class="ti ti-briefcase"></i></span>
                        <input type="password" id="password" name="password" class="form-control dt-password"
                            placeholder="Ít nhất 6 kí tự" aria-label="123456" aria-describedby="password" />
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-12">
                    <label class="form-label" for="password2">Nhập lại mật khẩu <span
                            class="font-weight-bold text-danger">*</span></label>
                    <div class="input-group input-group-merge">
                        <span id="password" class="input-group-text"><i class="ti ti-briefcase"></i></span>
                        <input type="password" id="password2" name="password2" class="form-control dt-password2"
                            placeholder="123456" aria-label="123456" aria-describedby="password2" />
                    </div>
                </div>

                <div class="col-sm-12">
                    <label class="form-label" for="name">Tên nhân viên</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="ti ti-user"></i></span>
                        <input type="text" id="name" name="name" class="form-control dt-email"
                            placeholder="Nguyễn Văn A" aria-label="Nguyễn Văn A" />
                    </div>
                </div>

                <div class="col-sm-12">
                    <label class="form-label" for="email">Email</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="ti ti-mail"></i></span>
                        <input type="email" id="email" name="email" class="form-control dt-email"
                            placeholder="john.doe@example.com" aria-label="john.doe@example.com" />
                    </div>
                </div>
                <div class="col-sm-12">
                    <label class="form-label" for="birthday">Ngày sinh</label>
                    <div class="input-group input-group-merge">
                        <span id="birthday" class="input-group-text"><i class="ti ti-calendar"></i></span>
                        <input type="date" class="form-control dt-date" id="birthday" name="birthday"
                            aria-describedby="birthday" placeholder="dd-mm-yyyy" value="" min="1800-01-01" />
                    </div>
                </div>
                <div class="col-sm-12">
                    <label class="form-label" for="cccd">Căn cước công dân</label>
                    <div class="input-group input-group-merge">
                        <span id="cccd" class="input-group-text"><i class="ti ti-currency-dollar"></i></span>
                        <input type="number" id="cccd" name="cccd" class="form-control dt-salary"
                            placeholder="184222888" aria-label="184222888" aria-describedby="cccd" />
                    </div>
                </div>
                <div class="col-sm-12">
                    <label class="form-label" for="address">Địa chỉ</label>
                    <div class="input-group input-group-merge">
                        <span id="address" class="input-group-text"><i class="ti ti-currency-dollar"></i></span>
                        <input type="text" id="address" name="address" class="form-control dt-salary"
                            placeholder="Hà Nội" aria-label="Hà Nội" aria-describedby="address" />
                    </div>
                </div>
                <div class="col-sm-12">
                    <label class="form-label" for="phone_number">Số điện thoại</label>
                    <div class="input-group input-group-merge">
                        <span id="phone_number" class="input-group-text"><i class="ti ti-currency-dollar"></i></span>
                        <input type="number" id="phone_number" name="phone_number" class="form-control dt-salary"
                            placeholder="0987654321" aria-label="0987654321" aria-describedby="phone_number" />
                    </div>
                </div>
                <div class="col-sm-12">
                    <label class="form-label" for="business_day">Ngày công</label>
                    <div class="input-group input-group-merge">
                        <span id="business_day" class="input-group-text"><i class="ti ti-currency-dollar"></i></span>
                        <input type="number" id="business_day" name="business_day" class="form-control dt-salary"
                            placeholder="250000" aria-label="250000" aria-describedby="business_day" value="0"
                            min="0" />
                    </div>
                </div>
                <div class="col-sm-12">
                    <label class="form-label" for="allowance">Phụ cấp</label>
                    <div class="input-group input-group-merge">
                        <span id="allowance" class="input-group-text"><i class="ti ti-currency-dollar"></i></span>
                        <input type="number" id="allowance" name="allowance" class="form-control dt-salary"
                            placeholder="3000000" aria-label="250000" aria-describedby="allowance" value="0"
                            min="0" />
                    </div>
                </div>
                <div class="col-sm-12">
                    <label class="form-label" for="avata">Ảnh đại diện</label>
                    <div class="input-group input-group-merge">
                        <span id="avata" class="input-group-text"><i class="ti ti-currency-dollar"></i></span>
                        <input type="file" id="avata" name="avata" class="form-control dt-salary"
                            placeholder="3000000" aria-label="250000" aria-describedby="avata" />
                    </div>
                </div>
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary me-sm-3 me-1" onclick="submitForm()">Thêm</button>
                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Cancel</button>
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
                    username: {
                        validators: {
                            notEmpty: {
                                message: 'Tên đăng nhập không được trống'
                            }
                        }
                    },
                    password: {
                        validators: {
                            notEmpty: {
                                message: 'Mật khẩu không được trống'
                            },
                            stringLength: {
                                message: 'Mật khẩu phải dài từ 6 kí tự',
                                min: 6
                            }
                        }
                    },
                    password2: {
                        validators: {
                            notEmpty: {
                                message: 'Mật khẩu nhập lại không được trống'
                            },
                            stringLength: {
                                message: 'Mật khẩu nhập lại phải dài từ 6 kí tự',
                                min: 6
                            },
                            identical: {
                                compare: function() {
                                    return formAuthentication.querySelector('[name="password"]').value;
                                },
                                message: 'Mật khẩu nhập lại chưa trùng khớp'
                            },
                        }
                    },

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
            fv = FormValidation.formValidation(formAddNewRecord, validateF);
            fromEdit = document.getElementById('editUserForm');
            fvEdit = FormValidation.formValidation(fromEdit, validateF);
        });

        function submitForm() {
            fv.validate().then(function(status) {
                if (status === 'Valid') {
                    // Nếu tất cả đều thoả mãn, trả về true
                    document.getElementById("form-add-new-record").submit();
                } else {

                }
            });
        }
        function submitFormEdit() {
            fvEdit.validate().then(function(status) {
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
            editForm.action = domain + '/staff/update/' + id;

            $.ajax({
                type: 'GET',
                url: domain + '/api/v1/account/' + id,
                headers: {
                    'Authorization': 'Bearer ' + authToken,
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(data) {
                    console.log(data.data);
                    if (data.data != undefined && data.data != []) {
                        let fullData = data.data;
                        document.getElementById('edit-username').value = fullData.username;
                        document.getElementById('edit-name').value = fullData.name;
                        document.getElementById('edit-name-title').textContent  = fullData.name;
                        document.getElementById('edit-email').value = fullData.email;
                        document.getElementById('edit-birthday').value = fullData.birthday;
                        document.getElementById('edit-cccd').value = fullData.cccd;
                        document.getElementById('edit-phone_number').value = fullData.phone_number;
                        document.getElementById('edit-business_day').value = fullData.business_day;
                        document.getElementById('edit-allowance').value = fullData.allowance;
                        document.getElementById('edit-address').value = fullData.address;
                        document.getElementById('avata').src = fullData.avata;
                    }
                }
            });
        }
    </script>

    <hr class="my-5" />
@endsection
