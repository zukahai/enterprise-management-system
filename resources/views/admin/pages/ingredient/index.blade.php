@extends('admin.layouts.main')

@section('open-dashboard')
    @php
        $super = 'materials';
        $sub = 'ingredient';
    @endphp
@endsection

@section('title')
    @php
        $title = 'Nguyên liệu | Công ty Hoàng Phát';
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
    <script src="{{ asset('webhtml/assets/genarate/ingredient.js') }}"></script>
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
                        <h3 class="mb-2">Chỉnh sửa thông tin nguyên liệu</h3>
                        <h2><a href="javascript:" class="mb-2 text-primary" id="edit_name-title"></a></h2>
                    </div>
                    <form id="editUserForm" class="row g-3" method="POST" action="{{ route('staff.update') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="col-sm-12">
                            <label class="form-label" for="name">Tên nguyên liệu<span
                                    class="font-weight-bold text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <span id="name" class="input-group-text"><i class="ti ti-user"></i></span>
                                <input type="text" id="edit_name" class="form-control dt-name" name="name"
                                    placeholder="Nguyên liệu" aria-label="Nguyên liệu" aria-describedby="name" />
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label" for="select2">Đơn vị</label>
                            <div class="input-group input-group-merge">
                                <select class="select2 w-100" id="edit_dvt_select" name="dvt" aria-label="Select2"
                                    aria-describedby="select2">
                                    <option value="Cái">Cái</option>
                                    <option value="m2">m2</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label" for="length">Dài</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="fas fa-angle-double-down"></i></span>
                                <input type="number" id="edit_length" name="length" class="form-control dt-salary"
                                    placeholder="Dài" aria-label="Dài" aria-describedby="length" min="0" value="0"/>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label" for="width">Rộng</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="fas fa-angle-double-down"></i></span>
                                <input type="number" id="edit_width" name="width" class="form-control dt-salary"
                                    placeholder="Rộng" aria-label="Rộng" aria-describedby="width" min="0" value="0"/>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label" for="height">Cao</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="fas fa-angle-double-down"></i></span>
                                <input type="number" id="edit_height" name="height" class="form-control dt-salary"
                                    placeholder="Cao" aria-label="Cao" aria-describedby="height" min="0" value="0"/>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label" for="buying_price">Giá mua</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="fas fa-angle-double-down"></i></span>
                                <input type="number" id="edit_buying_price" name="buying_price" class="form-control dt-salary"
                                    placeholder="Giá mua" aria-label="Giá mua" aria-describedby="buying_price" min="0" value="0"/>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label" for="selling_price">Giá bán</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="fas fa-angle-double-down"></i></span>
                                <input type="number" id="edit_selling_price" name="selling_price" class="form-control dt-salary"
                                    placeholder="Giá bán" aria-label="Giá bán" aria-describedby="selling_price" min="0" value="0"/>
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
                        <th>Tên nguyên liệu</th>
                        <th>Đơn vị</th>
                        <th>Dài</th>
                        <th>Rộng</th>
                        <th>Cao</th>
                        <th>Giá mua</th>
                        <th>Giá bán</th>
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
            <h5 class="offcanvas-title" id="exampleModalLabel">Thông tin nguyên liệu</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body flex-grow-1">
            <form class="add-new-record pt-0 row g-2" id="form-add-new-record" method="POST"
                action="{{ route('ingredient.create') }}" enctype="multipart/form-data">
                @csrf
                <div class="col-sm-12">
                    <label class="form-label" for="name">Tên nguyên liệu<span
                            class="font-weight-bold text-danger">*</span></label>
                    <div class="input-group input-group-merge">
                        <span id="name" class="input-group-text"><i class="ti ti-user"></i></span>
                        <input type="text" id="name" class="form-control dt-name" name="name"
                            placeholder="Nguyên liệu" aria-label="Nguyên liệu" aria-describedby="name" />
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-12">
                    <label class="form-label" for="select2">Đơn vị</label>
                    <div class="input-group input-group-merge">
                        <select class="select2 w-100" id="dvt_select" name="dvt" aria-label="Select2"
                            aria-describedby="select2">
                            <option value="Cái">Cái</option>
                            <option value="m2">m2</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-12">
                    <label class="form-label" for="length">Dài</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="fas fa-angle-double-down"></i></span>
                        <input type="number" id="length" name="length" class="form-control dt-salary"
                            placeholder="Dài" aria-label="Dài" aria-describedby="length" min="0" value="0"/>
                    </div>
                </div>
                <div class="col-sm-12">
                    <label class="form-label" for="width">Rộng</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="fas fa-angle-double-down"></i></span>
                        <input type="number" id="width" name="width" class="form-control dt-salary"
                            placeholder="Rộng" aria-label="Rộng" aria-describedby="width" min="0" value="0"/>
                    </div>
                </div>
                <div class="col-sm-12">
                    <label class="form-label" for="height">Cao</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="fas fa-angle-double-down"></i></span>
                        <input type="number" id="height" name="height" class="form-control dt-salary"
                            placeholder="Cao" aria-label="Cao" aria-describedby="height" min="0" value="0"/>
                    </div>
                </div>
                <div class="col-sm-12">
                    <label class="form-label" for="buying_price">Giá mua</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="fas fa-angle-double-down"></i></span>
                        <input type="number" id="buying_price" name="buying_price" class="form-control dt-salary"
                            placeholder="Giá mua" aria-label="Giá mua" aria-describedby="buying_price" min="0" value="0"/>
                    </div>
                </div>
                <div class="col-sm-12">
                    <label class="form-label" for="selling_price">Giá bán</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="fas fa-angle-double-down"></i></span>
                        <input type="number" id="selling_price" name="selling_price" class="form-control dt-salary"
                            placeholder="Giá bán" aria-label="Giá bán" aria-describedby="selling_price" min="0" value="0"/>
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
                                message: 'Tên nguyên liệu không được trống'
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
            fv_ingredient = FormValidation.formValidation(formAddNewRecord, validateF);
            fromEdit = document.getElementById('editUserForm');
            fvEdit_ingredient = FormValidation.formValidation(fromEdit, validateF);
        });

        function submitForm() {
            fv_ingredient.validate().then(function(status) {
                if (status === 'Valid') {
                    // Nếu tất cả đều thoả mãn, trả về true
                    document.getElementById("form-add-new-record").submit();
                } else {

                }
            });
        }

        function submitFormEdit() {
            fvEdit_ingredient.validate().then(function(status) {
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
            editForm.action = domain + '/ingredient/update/' + id;

            $.ajax({
                type: 'GET',
                url: domain + '/api/v1/ingredient/' + id,
                headers: {
                    'Authorization': 'Bearer ' + authToken,
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(data) {
                    if (data.data != undefined && data.data != []) {
                        let fullData = data.data;
                        console.log(fullData);
                        document.getElementById('edit_name').value = fullData.name;
                        document.getElementById('edit_note').value = fullData.note;
                        document.getElementById('edit_name-title').textContent = fullData.name;
                        document.getElementById('edit_length').value = fullData['length'];
                        document.getElementById('edit_width').value = fullData.width;
                        document.getElementById('edit_height').value = fullData.height;
                        document.getElementById('edit_buying_price').value = fullData.buying_price;
                        document.getElementById('edit_selling_price').value = fullData.selling_price;
                        var valueToSelect = fullData.dvt;
                        $('#edit_dvt_select').val(valueToSelect).trigger('change');
                    }
                }
            });
        }
    </script>

    <hr class="my-5" />
@endsection
