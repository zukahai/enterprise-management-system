@extends('admin.layouts.main')

@section('open-dashboard')
    @php
        $super = 'materials';
        $sub = 'unit';
    @endphp
@endsection

@section('title')
    @php
        $title = 'Đơn vị | Công ty Hoàng Phát';
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
    <script src="{{ asset('webhtml/assets/genarate/unit.js') }}"></script>
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
                        <h3 class="mb-2">Chỉnh sửa thông tin đơn vị</h3>
                        <h2><a href="javascript:" class="mb-2 text-primary" id="edit_name-title"></a></h2>
                    </div>
                    <form id="editUserForm" class="row g-3" method="POST" action="{{ route('staff.update') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="col-sm-12">
                            <label class="form-label" for="name">Tên đơn vị<span
                                    class="font-weight-bold text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <span id="name" class="input-group-text"><i class="ti ti-user"></i></span>
                                <input type="text" id="edit_name" class="form-control dt-name" name="name"
                                    placeholder="Đơn vị" aria-label="Đơn vị" aria-describedby="name" />
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label" for="description">Mô tả</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="fas fa-angle-double-down"></i></span>
                                <input type="text" id="edit_description" name="description" class="form-control dt-salary"
                                    placeholder="Mô tả" aria-label="Mô tả" aria-describedby="description"/>
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
                        <th>Mã</th>
                        <th>Tên đơn vị</th>
                        <th>Mô tả</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <!-- Modal to add new record -->
    <div class="offcanvas offcanvas-end" id="add-new-record">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title" id="exampleModalLabel">Thông tin đơn vị</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body flex-grow-1">
            <form class="add-new-record pt-0 row g-2" id="form-add-new-record" method="POST"
                action="{{ route('unit.create') }}" enctype="multipart/form-data">
                @csrf
                <div class="col-sm-12">
                    <label class="form-label" for="name">Tên đơn vị<span
                            class="font-weight-bold text-danger">*</span></label>
                    <div class="input-group input-group-merge">
                        <span id="name" class="input-group-text"><i class="ti ti-user"></i></span>
                        <input type="text" id="name" class="form-control dt-name" name="name"
                            placeholder="Đơn vị" aria-label="Đơn vị" aria-describedby="name" />
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-12">
                    <label class="form-label" for="description">Mô tả</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="fas fa-angle-double-down"></i></span>
                        <input type="text" id="description" name="description" class="form-control dt-salary"
                            placeholder="Mô tả" aria-label="Mô tả" aria-describedby="description"/>
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
    {{-- validate form --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let validateF = {
                fields: {
                    name: {
                        validators: {
                            notEmpty: {
                                message: 'Tên đơn vị không được trống'
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
            fv_unit = FormValidation.formValidation(formAddNewRecord, validateF);
            fromEdit = document.getElementById('editUserForm');
            fvEdit_unit = FormValidation.formValidation(fromEdit, validateF);
        });

        function submitForm() {
            fv_unit.validate().then(function(status) {
                if (status === 'Valid') {
                    // Nếu tất cả đều thoả mãn, trả về true
                    document.getElementById("form-add-new-record").submit();
                } else {

                }
            });
        }

        function submitFormEdit() {
            fvEdit_unit.validate().then(function(status) {
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
            editForm.action = domain + '/unit/update/' + id;

            $.ajax({
                type: 'GET',
                url: domain + '/api/v1/unit/' + id,
                headers: {
                    'Authorization': 'Bearer ' + authToken,
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(data) {
                    if (data.data != undefined && data.data != []) {
                        let fullData = data.data;
                        console.log(fullData);
                        document.getElementById('edit_name').value = fullData.name;
                        document.getElementById('edit_name-title').textContent = fullData.name;
                        document.getElementById('edit_description').value = fullData.description;
                    }
                }
            });
        }
    </script>

    <hr class="my-5" />
@endsection
