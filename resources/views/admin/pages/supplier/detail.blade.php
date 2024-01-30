@extends('admin.layouts.main')

@section('open-dashboard')
    @php
        $super = 'info';
        $sub = 'supplier';
    @endphp
@endsection

@section('title')
    @php
        $title = $object->name." | Nhà cung cấp| Công ty Hoàng Phát";
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
                        <h2><a href="javascript:" class="mb-2 text-primary" id="delete-name-title">{{$object->name}}</a></h2>
                    </div>
                    <div id="" class="row g-3" method="POST">
                        <div class="col-sm-12 text-center">
                            <button type="submit" class="btn btn-primary mx-auto" onclick="deleteObject()">Xoá</button>
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
                        <td>{{$object->id}}</td>
                    </tr>
                    <tr>
                        <td>Tên nhà cung cấp</td>
                        <td>{{$object->name}}</td>
                    </tr>
                    <tr>
                        <td>Địa chỉ</td>
                        <td>{{$object->address}}</td>
                    </tr>
                    <tr>
                        <td>Mã số thuế</td>
                        <td>{{$object->mst}}</td>
                    </tr>
                    <tr>
                        <td>Số tài khoản</td>
                        <td>{{$object->stk}}</td>
                    </tr>
                    <tr>
                        <td>Ngân hàng</td>
                        <td>{{$object->bank->name}} {{$object->bank->note ? '('.$object->bank->note.')' : ''}}</td>
                    </tr>
                    <tr>
                        <td>Thời gian nợ</td>
                        <td>{{$object->time}}</td>
                    </tr>
                    <tr>
                        <td>Số điện thoại</td>
                        <td>{{$object->phone_number}}</td>
                    </tr>
                    <tr>
                        <td>Liên hệ</td>
                        <td>{{$object->contact}}</td>
                    </tr>
                    <tr>
                        <td>Ghi chú</td>
                        <td>{{$object->note}}</td>
                    </tr>
                </tbody>
            </table>
            
        </div>
        <div class="col-sm-12 text-center mb-2">
            <button  class="btn btn-primary me-sm-3 me-1" data-bs-toggle="modal" data-bs-target="#edit" onclick="editRecord({{$object->id}})">Chỉnh sửa</button>
            <button  class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#delete-modal">Xoá</button>
        </div>
        <div class="bank-quick col-sm-12 text-center mb-2">
            <hr>
            <h4>Chuyển khoản nhanh</h4>
            <img src="https://api.vietqr.io/{{$object->bank->code}}/{{$object->stk}}/0/Hoang Phat/vietqr_net_2.jpg" alt="Ngân hàng không hợp lệ" srcset="">
        </div>
    </div>

    {{-- validate form --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let validateF = {
                fields: {
                    name: {
                        validators: {
                            notEmpty: {
                                message: 'Tên nhà cung cấp không được trống'
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
            fv_supplier = FormValidation.formValidation(formAddNewRecord, validateF);
            fromEdit = document.getElementById('editForm');
            fvEdit_supplier = FormValidation.formValidation(fromEdit, validateF);
        });


        function submitFormEdit() {
            fvEdit_supplier.validate().then(function(status) {
                if (status === 'Valid') {
                    // Nếu tất cả đều thoả mãn, trả về true
                    // document.getElementById("editFinishedProductForm").submit();
                } else {

                }
            });
        }
    </script>

    {{-- modal edit --}}
    {{-- Load form --}}
    <script>
        function editRecord(id) {
            let authToken = localStorage.getItem('authToken') || "";
            let csrfToken = $('meta[name="csrf-token"]').attr('content');
            var domain = document.documentElement.getAttribute('data-domain');

            var editForm = document.getElementById('editForm');
            editForm.action = domain + '/supplier/update/' + id;

            $.ajax({
                type: 'GET',
                url: domain + '/api/v1/supplier/' + id,
                headers: {
                    'Authorization': 'Bearer ' + authToken,
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(data) {
                    if (data.data != undefined && data.data != []) {
                        let fullData = data.data;
                        document.getElementById('edit_name').value = fullData.name;
                        document.getElementById('edit_address').value = fullData.address;
                        document.getElementById('edit_mst').value = fullData.mst;
                        document.getElementById('edit_stk').value = fullData.stk;
                        document.getElementById('edit_phone_number').value = fullData.phone_number;
                        document.getElementById('edit_note').value = fullData.note;
                        document.getElementById('edit_contact').value = fullData.contact;
                        document.getElementById('edit_note').value = fullData.note;
                        document.getElementById('edit_name-title').textContent = fullData.name;

                        var selectElement = document.getElementById('edit_bank_select');
                        var options = selectElement.options;

                        var valueToSelect = fullData.bank_id;
                        $('#edit_bank_select').val(valueToSelect).trigger('change');
                    }
                }
            });
        }
    </script>

    {{-- Load bank --}}
    <script>
        window.onload = function() {
            let authToken = localStorage.getItem('authToken') || "";
            let csrfToken = $('meta[name="csrf-token"]').attr('content');
            var domain = document.documentElement.getAttribute('data-domain');
            $.ajax({
                type: 'GET',
                url: domain + '/api/v1/bank',
                headers: {
                    'Authorization': 'Bearer ' + authToken,
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(data) {
                    if (data.data != undefined && data.data != []) {
                        let fullData = data.data;
                        let edit_bank_select = document.getElementById('edit_bank_select');
                        fullData.forEach(element => {
                            let newOption2 = document.createElement("option");
                            newOption2.value = element.id;
                            newOption2.text = element.name;
                            edit_bank_select.appendChild(newOption2);
                        });
                    }
                }
            });
            // Thực hiện onload ở body
            var bodyElement = document.querySelector('body');
            var onLoadAttribute = bodyElement.getAttribute('onload');
            if (onLoadAttribute) {
                eval(onLoadAttribute);
            }
        };
    </script>

    {{-- Xoá --}}
    <script>
        function deleteObject() {
            let authToken = localStorage.getItem('authToken') || "";
            let id = {{$object->id}}
            var domain = document.documentElement.getAttribute('data-domain');

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
                toastr.success("Xóa nhà cung cấp thành công");
                setTimeout(() => {
                    window.location = "./";
                }, 1000);
            } else {
                toastr.error("Xóa nhà cung cấp thất bại");
            }

            }).fail(function (error) {
                console.log(error);
            });
        }
    </script>

    <hr class="my-5" />
@endsection
