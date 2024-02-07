@extends('admin.layouts.main')

@section('open-dashboard')
    @php
        $super = 'info';
        $sub = 'customer';
    @endphp
@endsection

@section('title')
    @php
        $title = $object->name . ' | Khách hàng | Công ty Hoàng Phát';
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
    <script src="{{ asset('webhtml/assets/genarate/detail-customers.js') }}"></script>
    <script src="{{ asset('webhtml/assets/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('webhtml/assets/vendor/libs/@form-validation/umd/bundle/popular.min.js') }}"></script>
    <script src="{{ asset('webhtml/assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
    <script src="{{ asset('webhtml/assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>
    <!-- Form Validation -->
@endsection

@section('content')
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">{{ ucfirst($super) }} /</span>
        <a href="{{ route('customer.index') }}">{{ ucfirst($sub) }}</a>
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
                        <h3 class="mb-2">Chỉnh sửa thông tin khách hàng</h3>
                        <h2><a href="javascript:" class="mb-2 text-primary" id="edit-name-title"></a></h2>
                    </div>
                    <form id="editUserForm" class="row g-3" method="POST" action="{{ route('staff.update') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="col-sm-12">
                            <div class="col-sm-12">
                                <label class="form-label" for="id_custom">Mã khách hàng<span
                                        class="font-weight-bold text-danger">*</span></label>
                                <div class="input-group input-group-merge">
                                    <span id="id_custom" class="input-group-text"><i class="ti ti-user"></i></span>
                                    <input type="text" id="edit_id_custom" class="form-control dt-name" name="id_custom"
                                        placeholder="AH" aria-label="AH" aria-describedby="name" />
                                </div>
                            </div>
                        </div>
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
                                    aria-describedby="time" placeholder="yyyy-MM-ddThh:mm:ss" step="any" />
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

    <!-- Delete User Modal -->
    <div class="modal fade" id="delete-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-simple modal-edit-user">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                        <h3 class="mb-2">Xác nhận xoá khách hàng</h3>
                        <h2><a href="javascript:" class="mb-2 text-primary"
                                id="delete-name-title">{{ $object->name }}</a></h2>
                    </div>
                    <div id="" class="row g-3" method="POST">
                        <div class="col-sm-12 text-center">
                            <button type="submit" class="btn btn-primary mx-auto"
                                onclick="deleteObject({{ $object->id }}, 'customer', 'khách hàng')">Xoá</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Delete User Modal -->


    <div class="card">
        <div class="card-datatable table-responsive pt-0">
            <h4 class="mx-2 mt-2 text-center">Thông tin khách hàng</h4>
            <table class="datatables-laravel table span-table" id="table-detail">
                <thead>

                </thead>
                <tbody>
                    <tr>
                        <td>Mã</td>
                        <td>{{ $object->id_custom }}</td>
                    </tr>
                    <tr>
                        <td>Tên</td>
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
        <hr>
        <h4 class="mx-2 mt-2 text-center">
            <span class="avatar rounded-circle bg-label-success me-2 align-items-center justify-content-center">
                <i class="ti ti-shopping-cart ti-sm"> </i>
            </span>
            <a href="{{ route('export-order.index') }}?s=({{ $object->id_custom }})">Đơn hàng xuất</a> của khách hàng
            <span class="text-success"> {{ $object->name }} </span>
        </h4>
        <div class="container">
            <table class="datatables-detail table">
                <thead>
                    <tr>
                        <th>Số đơn hàng</th>
                        <th>Mã nội bộ</th>
                        <th>Tên sản phẩm</th>
                        <th>Đơn giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                        <th>Ngày giao</th>
                        <th>Hoàn thành</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <input type="hidden" id="customer_id" value="{{ $object->id }}">

    <script src="{{ asset('webhtml/assets/custom-js/customer.js') }}"></script>

    <hr class="my-5" />
@endsection
