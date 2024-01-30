@extends('admin.layouts.main')

@section('open-dashboard')
    @php
        $super = 'materials';
        $sub = 'finished-product';
    @endphp
@endsection

@section('title')
    @php
        $title = 'Thành phẩm | Công ty Hoàng Phát';
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
    <script src="{{ asset('webhtml/assets/genarate/finished-product.js') }}"></script>
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
                        <h3 class="mb-2">Chỉnh sửa thông tin thành phẩm</h3>
                        <h2><a href="javascript:" class="mb-2 text-primary" id="edit-name-title"></a></h2>
                    </div>
                    <form id="editFinishedProductForm" class="row g-3" method="POST" action="{{ route('staff.update') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="col-sm-12">
                            <label class="form-label" for="name">Tên thành phẩm<span
                                    class="font-weight-bold text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <span id="name" class="input-group-text"><i class="ti ti-user"></i></span>
                                <input type="text" id="edit_name" class="form-control dt-name" name="name"
                                    placeholder="Sản phẩm AH" aria-label="Sản phẩm AH" aria-describedby="name" />
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <hr>
                        <label class="form-label">KT đơn hàng</label>
                        <div class="col-sm-12">
                            <label class="form-label" for="ktdh_length">Dài</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="fas fa-angle-double-down"></i></span>
                                <input type="number" id="edit_ktdh_length" name="ktdh_length" class="form-control dt-salary"
                                    placeholder="Dài" aria-label="Dài" aria-describedby="ktdh_length" min="0" value="0"/>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label" for="ktdh_width">Rộng</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="fas fa-angle-double-down"></i></span>
                                <input type="number" id="edit_ktdh_width" name="ktdh_width" class="form-control dt-salary"
                                    placeholder="Rộng" aria-label="Rộng" aria-describedby="ktdh_width" min="0" value="0"/>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label" for="ktdh_height">Cao</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="fas fa-angle-double-down"></i></span>
                                <input type="number" id="edit_ktdh_height" name="ktdh_height" class="form-control dt-salary"
                                    placeholder="Cao" aria-label="Cao" aria-describedby="ktdh_height" min="0" value="0"/>
                            </div>
                        </div>
                        <hr>
                        <label class="form-label">KT sản xuất</label>
                        <div class="col-sm-12">
                            <label class="form-label" for="ktsx_length">Dài</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="fas fa-angle-double-down"></i></span>
                                <input type="number" id="edit_ktsx_length" name="ktsx_length" class="form-control dt-salary"
                                    placeholder="Dài" aria-label="Dài" aria-describedby="ktsx_length" min="0" value="0"/>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label" for="ktsx_width">Rộng</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="fas fa-angle-double-down"></i></span>
                                <input type="number" id="edit_ktsx_width" name="ktsx_width" class="form-control dt-salary"
                                    placeholder="Rộng" aria-label="Rộng" aria-describedby="ktsx_width" min="0" value="0"/>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label" for="ktsx_height">Cao</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="fas fa-angle-double-down"></i></span>
                                <input type="number" id="edit_ktsx_height" name="ktsx_height" class="form-control dt-salary"
                                    placeholder="Cao" aria-label="Cao" aria-describedby="ktsx_height" min="0" value="0"/>
                            </div>
                        </div>
                        <hr>
                        <div class="col-sm-12">
                            <label class="form-label" for="song">Sóng</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="ti ti-currency-dollar"></i></span>
                                <input type="text" id="edit_song" name="song" class="form-control dt-salary"
                                    placeholder="Sóng" aria-label="Sóng" aria-describedby="song" />
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label" for="select2">Đơn vị</label>
                            <div class="input-group input-group-merge">
                                <select class="select2 w-100" id="edit_dvt_select" name="unit_id" aria-label="Select2"
                                    aria-describedby="select2">
                                   {{-- options --}}
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label" for="price">Đơn giá</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="ti ti-currency-dollar"></i></span>
                                <input type="number" id="edit_price" name="price" class="form-control dt-salary"
                                    placeholder="Đơn giá" aria-label="Đơn giá" aria-describedby="price" value="0" min="0"/>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label" for="rose">Hoa hồng</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="ti ti-currency-dollar"></i></span>
                                <input type="number" id="edit_rose" name="rose" class="form-control dt-salary"
                                    placeholder="Hoa hồng" aria-label="Hoa hồng" aria-describedby="rose" value="0" min="0"/>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label" for="rose_percent">% Hoa hồng</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="ti ti-currency-dollar"></i></span>
                                <input type="number" id="edit_rose_percent" name="rose_percent" class="form-control dt-salary"
                                    placeholder="% Hoa hồng" aria-label="% Hoa hồng" aria-describedby="rose_percent" value="0" min="0"/>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label" for="note">Ghi chú</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="ti ti-currency-dollar"></i></span>
                                <input type="text" id="edit_note" name="note" class="form-control dt-salary"
                                    placeholder="Ghi chú" aria-label="Ghi chú" aria-describedby="note"/>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label" for="type">Kiểu</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="ti ti-currency-dollar"></i></span>
                                <input type="text" id="edit_type" name="type" class="form-control dt-salary"
                                    placeholder="Kiểu" aria-label="Kiểu" aria-describedby="type"/>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label" for="delivered_enough">Giao đủ</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="ti ti-currency-dollar"></i></span>
                                <input type="text" id="edit_delivered_enough" name="delivered_enough" class="form-control dt-salary"
                                    placeholder="Giao đủ" aria-label="Giao đủ" aria-describedby="delivered_enough"/>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" for="xa">Xả</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="ti ti-currency-dollar"></i></span>
                                <input type="number" id="edit_xa" name="xa" class="form-control dt-salary"
                                    placeholder="Xả" aria-label="Xả" aria-describedby="xa" value="0" min="0"/>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" for="x">X</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class=""></i></span>
                                <input type="number" id="edit_x" name="x" class="form-control dt-salary"
                                    placeholder="X" aria-label="X" aria-describedby="x" value="0" min="0"/>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label" for="mold">Phim / Khuôn</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="ti ti-currency-dollar"></i></span>
                                <input type="text" id="edit_mold" name="mold" class="form-control dt-salary"
                                    placeholder="Phim / Khuôn" aria-label="Phim / Khuôn" aria-describedby="mold"/>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label" for="n_color">Số màu</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="ti ti-currency-dollar"></i></span>
                                <input type="number" id="edit_n_color" name="n_color" class="form-control dt-salary"
                                    placeholder="Số màu" aria-label="Số màu" aria-describedby="x" value="0" min="0"/>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" for="in">In</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="ti ti-currency-dollar"></i></span>
                                <input type="number" id="edit_in" name="in" class="form-control dt-salary"
                                    placeholder="In" aria-label="In" aria-describedby="in" value="0" min="0"/>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" for="in_n">N</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class=""></i></span>
                                <input type="number" id="edit_in_n" name="in_n" class="form-control dt-salary"
                                    placeholder="N" aria-label="N" aria-describedby="in_n" value="0" min="0"/>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" for="mang">Màng</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="ti ti-currency-dollar"></i></span>
                                <input type="number" id="edit_mang" name="mang" class="form-control dt-salary"
                                    placeholder="Màng" aria-label="Màng" aria-describedby="mang" value="0" min="0"/>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" for="mang_n">N</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class=""></i></span>
                                <input type="number" id="edit_mang_n" name="mang_n" class="form-control dt-salary"
                                    placeholder="N" aria-label="N" aria-describedby="mang_n" value="0" min="0"/>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" for="be">Bế</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="ti ti-currency-dollar"></i></span>
                                <input type="number" id="edit_be" name="be" class="form-control dt-salary"
                                    placeholder="Bế" aria-label="Bế" aria-describedby="be" value="0" min="0"/>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" for="be_n">N</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class=""></i></span>
                                <input type="number" id="edit_be_n" name="be_n" class="form-control dt-salary"
                                    placeholder="N" aria-label="N" aria-describedby="be_n" value="0" min="0"/>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" for="chap">Chạp</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="ti ti-currency-dollar"></i></span>
                                <input type="number" id="edit_chap" name="chap" class="form-control dt-salary"
                                    placeholder="Chạp" aria-label="Chạp" aria-describedby="chap" value="0" min="0"/>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" for="chap_n">N</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class=""></i></span>
                                <input type="number" id="edit_chap_n" name="chap_n" class="form-control dt-salary"
                                    placeholder="N" aria-label="N" aria-describedby="chap_n" value="0" min="0"/>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" for="dong">Đóng</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="ti ti-currency-dollar"></i></span>
                                <input type="number" id="edit_dong" name="dong" class="form-control dt-salary"
                                    placeholder="Đóng" aria-label="Đóng" aria-describedby="dong" value="0" min="0"/>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" for="dong_n">N</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class=""></i></span>
                                <input type="number" id="edit_dong_n" name="dong_n" class="form-control dt-salary"
                                    placeholder="N" aria-label="N" aria-describedby="dong_n" value="0" min="0"/>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" for="dan">Dán</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="ti ti-currency-dollar"></i></span>
                                <input type="number" id="edit_dan" name="dan" class="form-control dt-salary"
                                    placeholder="Dán" aria-label="Dán" aria-describedby="dan" value="0" min="0"/>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" for="dan_n">N</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class=""></i></span>
                                <input type="number" id="edit_dan_n" name="dan_n" class="form-control dt-salary"
                                    placeholder="N" aria-label="N" aria-describedby="dan_n" value="0" min="0"/>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" for="other">Khác</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="ti ti-currency-dollar"></i></span>
                                <input type="number" id="edit_other" name="other" class="form-control dt-salary"
                                    placeholder="Khác" aria-label="Khác" aria-describedby="other" value="0" min="0"/>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" for="other_n">N</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class=""></i></span>
                                <input type="number" id="edit_other_n" name="other_n" class="form-control dt-salary"
                                    placeholder="N" aria-label="N" aria-describedby="other_n" value="0" min="0"/>
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

            <table class="datatables-basic table span-table" id="fn-product">
                <thead>
                    <tr>
                        <th rowspan="2">id</th>
                        <th rowspan="2">Tên sản phẩm</th>
                        <th colspan="3" class="color-1">KT đơn hàng</th>
                        <th colspan="3" class="color-2">KT sản xuất</th>
                        <th rowspan="2">Sóng</th>
                        <th rowspan="2">Đơn vị</th>
                        <th rowspan="2">Đơn giá</th>
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
    <!-- Modal to add new record -->
    <div class="offcanvas offcanvas-end" id="add-new-record">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title" id="exampleModalLabel">Thông tin thành phẩm</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body flex-grow-1">
            <form class="add-new-record pt-0 row g-2" id="form-add-new-record" method="POST"
                action="{{ route('finished-product.create') }}" enctype="multipart/form-data">
                @csrf
                <div class="col-sm-12">
                    <label class="form-label" for="name">Tên thành phẩm<span
                            class="font-weight-bold text-danger">*</span></label>
                    <div class="input-group input-group-merge">
                        <span id="name" class="input-group-text"><i class="ti ti-user"></i></span>
                        <input type="text" id="name" class="form-control dt-name" name="name"
                            placeholder="Sản phẩm AH" aria-label="Sản phẩm AH" aria-describedby="name" />
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <hr>
                <label class="form-label">KT đơn hàng</label>
                <div class="col-sm-12">
                    <label class="form-label" for="ktdh_length">Dài</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="fas fa-angle-double-down"></i></span>
                        <input type="number" id="ktdh_length" name="ktdh_length" class="form-control dt-salary"
                            placeholder="Dài" aria-label="Dài" aria-describedby="ktdh_length" min="0" value="0"/>
                    </div>
                </div>
                <div class="col-sm-12">
                    <label class="form-label" for="ktdh_width">Rộng</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="fas fa-angle-double-down"></i></span>
                        <input type="number" id="ktdh_width" name="ktdh_width" class="form-control dt-salary"
                            placeholder="Rộng" aria-label="Rộng" aria-describedby="ktdh_width" min="0" value="0"/>
                    </div>
                </div>
                <div class="col-sm-12">
                    <label class="form-label" for="ktdh_height">Cao</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="fas fa-angle-double-down"></i></span>
                        <input type="number" id="ktdh_height" name="ktdh_height" class="form-control dt-salary"
                            placeholder="Cao" aria-label="Cao" aria-describedby="ktdh_height" min="0" value="0"/>
                    </div>
                </div>
                <hr>
                <label class="form-label">KT sản xuất</label>
                <div class="col-sm-12">
                    <label class="form-label" for="ktsx_length">Dài</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="fas fa-angle-double-down"></i></span>
                        <input type="number" id="ktsx_length" name="ktsx_length" class="form-control dt-salary"
                            placeholder="Dài" aria-label="Dài" aria-describedby="ktsx_length" min="0" value="0"/>
                    </div>
                </div>
                <div class="col-sm-12">
                    <label class="form-label" for="ktsx_width">Rộng</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="fas fa-angle-double-down"></i></span>
                        <input type="number" id="ktsx_width" name="ktsx_width" class="form-control dt-salary"
                            placeholder="Rộng" aria-label="Rộng" aria-describedby="ktsx_width" min="0" value="0"/>
                    </div>
                </div>
                <div class="col-sm-12">
                    <label class="form-label" for="ktsx_height">Cao</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="fas fa-angle-double-down"></i></span>
                        <input type="number" id="ktsx_height" name="ktsx_height" class="form-control dt-salary"
                            placeholder="Cao" aria-label="Cao" aria-describedby="ktsx_height" min="0" value="0"/>
                    </div>
                </div>
                <hr>
                <div class="col-sm-12">
                    <label class="form-label" for="song">Sóng</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="ti ti-currency-dollar"></i></span>
                        <input type="text" id="song" name="song" class="form-control dt-salary"
                            placeholder="Sóng" aria-label="Sóng" aria-describedby="song" />
                    </div>
                </div>
                <div class="col-sm-12">
                    <label class="form-label" for="select2">Đơn vị</label>
                    <div class="input-group input-group-merge">
                        <select class="select2 w-100" id="dvt_select" name="unit_id" aria-label="Select2"
                            aria-describedby="select2">
                           {{-- options --}}
                        </select>
                    </div>
                </div>
                <div class="col-sm-12">
                    <label class="form-label" for="price">Đơn giá</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="ti ti-currency-dollar"></i></span>
                        <input type="number" id="price" name="price" class="form-control dt-salary"
                            placeholder="Đơn giá" aria-label="Đơn giá" aria-describedby="price" value="0" min="0"/>
                    </div>
                </div>
                <div class="col-sm-12">
                    <label class="form-label" for="rose">Hoa hồng</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="ti ti-currency-dollar"></i></span>
                        <input type="number" id="rose" name="rose" class="form-control dt-salary"
                            placeholder="Hoa hồng" aria-label="Hoa hồng" aria-describedby="rose" value="0" min="0"/>
                    </div>
                </div>
                <div class="col-sm-12">
                    <label class="form-label" for="rose_percent">% Hoa hồng</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="ti ti-currency-dollar"></i></span>
                        <input type="number" id="rose_percent" name="rose_percent" class="form-control dt-salary"
                            placeholder="% Hoa hồng" aria-label="% Hoa hồng" aria-describedby="rose_percent" value="0" min="0"/>
                    </div>
                </div>
                <div class="col-sm-12">
                    <label class="form-label" for="note">Ghi chú</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="ti ti-currency-dollar"></i></span>
                        <input type="text" id="note" name="note" class="form-control dt-salary"
                            placeholder="Ghi chú" aria-label="Ghi chú" aria-describedby="note"/>
                    </div>
                </div>
                <div class="col-sm-12">
                    <label class="form-label" for="type">Kiểu</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="ti ti-currency-dollar"></i></span>
                        <input type="text" id="type" name="type" class="form-control dt-salary"
                            placeholder="Kiểu" aria-label="Kiểu" aria-describedby="type"/>
                    </div>
                </div>
                <div class="col-sm-12">
                    <label class="form-label" for="delivered_enough">Giao đủ</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="ti ti-currency-dollar"></i></span>
                        <input type="text" id="delivered_enough" name="delivered_enough" class="form-control dt-salary"
                            placeholder="Giao đủ" aria-label="Giao đủ" aria-describedby="delivered_enough"/>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label class="form-label" for="xa">Xả</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="ti ti-currency-dollar"></i></span>
                        <input type="number" id="xa" name="xa" class="form-control dt-salary"
                            placeholder="Xả" aria-label="Xả" aria-describedby="xa" value="0" min="0"/>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label class="form-label" for="x">X</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class=""></i></span>
                        <input type="number" id="x" name="x" class="form-control dt-salary"
                            placeholder="X" aria-label="X" aria-describedby="x" value="0" min="0"/>
                    </div>
                </div>
                <div class="col-sm-12">
                    <label class="form-label" for="mold">Phim / Khuôn</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="ti ti-currency-dollar"></i></span>
                        <input type="text" id="mold" name="mold" class="form-control dt-salary"
                            placeholder="Phim / Khuôn" aria-label="Phim / Khuôn" aria-describedby="mold"/>
                    </div>
                </div>
                <div class="col-sm-12">
                    <label class="form-label" for="n_color">Số màu</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="ti ti-currency-dollar"></i></span>
                        <input type="number" id="n_color" name="n_color" class="form-control dt-salary"
                            placeholder="Số màu" aria-label="Số màu" aria-describedby="x" value="0" min="0"/>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label class="form-label" for="in">In</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="ti ti-currency-dollar"></i></span>
                        <input type="number" id="in" name="in" class="form-control dt-salary"
                            placeholder="In" aria-label="In" aria-describedby="in" value="0" min="0"/>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label class="form-label" for="in_n">N</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class=""></i></span>
                        <input type="number" id="in_n" name="in_n" class="form-control dt-salary"
                            placeholder="N" aria-label="N" aria-describedby="in_n" value="0" min="0"/>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label class="form-label" for="mang">Màng</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="ti ti-currency-dollar"></i></span>
                        <input type="number" id="mang" name="mang" class="form-control dt-salary"
                            placeholder="Màng" aria-label="Màng" aria-describedby="mang" value="0" min="0"/>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label class="form-label" for="mang_n">N</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class=""></i></span>
                        <input type="number" id="mang_n" name="mang_n" class="form-control dt-salary"
                            placeholder="N" aria-label="N" aria-describedby="mang_n" value="0" min="0"/>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label class="form-label" for="be">Bế</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="ti ti-currency-dollar"></i></span>
                        <input type="number" id="be" name="be" class="form-control dt-salary"
                            placeholder="Bế" aria-label="Bế" aria-describedby="be" value="0" min="0"/>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label class="form-label" for="be_n">N</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class=""></i></span>
                        <input type="number" id="be_n" name="be_n" class="form-control dt-salary"
                            placeholder="N" aria-label="N" aria-describedby="be_n" value="0" min="0"/>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label class="form-label" for="chap">Chạp</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="ti ti-currency-dollar"></i></span>
                        <input type="number" id="chap" name="chap" class="form-control dt-salary"
                            placeholder="Chạp" aria-label="Chạp" aria-describedby="chap" value="0" min="0"/>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label class="form-label" for="chap_n">N</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class=""></i></span>
                        <input type="number" id="chap_n" name="chap_n" class="form-control dt-salary"
                            placeholder="N" aria-label="N" aria-describedby="chap_n" value="0" min="0"/>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label class="form-label" for="dong">Đóng</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="ti ti-currency-dollar"></i></span>
                        <input type="number" id="dong" name="dong" class="form-control dt-salary"
                            placeholder="Đóng" aria-label="Đóng" aria-describedby="dong" value="0" min="0"/>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label class="form-label" for="dong_n">N</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class=""></i></span>
                        <input type="number" id="dong_n" name="dong_n" class="form-control dt-salary"
                            placeholder="N" aria-label="N" aria-describedby="dong_n" value="0" min="0"/>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label class="form-label" for="dan">Dán</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="ti ti-currency-dollar"></i></span>
                        <input type="number" id="dan" name="dan" class="form-control dt-salary"
                            placeholder="Dán" aria-label="Dán" aria-describedby="dan" value="0" min="0"/>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label class="form-label" for="dan_n">N</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class=""></i></span>
                        <input type="number" id="dan_n" name="dan_n" class="form-control dt-salary"
                            placeholder="N" aria-label="N" aria-describedby="dan_n" value="0" min="0"/>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label class="form-label" for="other">Khác</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="ti ti-currency-dollar"></i></span>
                        <input type="number" id="other" name="other" class="form-control dt-salary"
                            placeholder="Khác" aria-label="Khác" aria-describedby="other" value="0" min="0"/>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label class="form-label" for="other_n">N</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class=""></i></span>
                        <input type="number" id="other_n" name="other_n" class="form-control dt-salary"
                            placeholder="N" aria-label="N" aria-describedby="other_n" value="0" min="0"/>
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
                                message: 'Tên thành phẩm không được trống'
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
            fv_finished_product = FormValidation.formValidation(formAddNewRecord, validateF);
            fromEdit = document.getElementById('editFinishedProductForm');
            fvEdit_finished_product = FormValidation.formValidation(fromEdit, validateF);
        });

        function submitForm() {
            fv_finished_product.validate().then(function(status) {
                if (status === 'Valid') {
                    // Nếu tất cả đều thoả mãn, trả về true
                    document.getElementById("form-add-new-record").submit();
                } else {

                }
            });
        }

        function submitFormEdit() {
            fvEdit_finished_product.validate().then(function(status) {
                if (status === 'Valid') {
                    // Nếu tất cả đều thoả mãn, trả về true
                    document.getElementById("editFinishedProductForm").submit();
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

            var editForm = document.getElementById('editFinishedProductForm');
            editForm.action = domain + '/finished-product/update/' + id;

            $.ajax({
                type: 'GET',
                url: domain + '/api/v1/finished-product/' + id,
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
                        document.getElementById('edit-name-title').textContent = fullData.name;
                        document.getElementById('edit_ktdh_length').value = fullData.ktdh_length;
                        document.getElementById('edit_ktdh_width').value = fullData.ktdh_width;
                        document.getElementById('edit_ktdh_height').value = fullData.ktdh_height;
                        document.getElementById('edit_ktsx_length').value = fullData.ktsx_length;
                        document.getElementById('edit_ktsx_width').value = fullData.ktsx_width;
                        document.getElementById('edit_ktsx_height').value = fullData.ktsx_height;
                        document.getElementById('edit_song').value = fullData.song;
                        document.getElementById('edit_price').value = fullData.price;
                        document.getElementById('edit_rose').value = fullData.rose;
                        document.getElementById('edit_rose_percent').value = fullData.rose_percent;
                        document.getElementById('edit_type').value = fullData.type;
                        document.getElementById('edit_delivered_enough').value = fullData.delivered_enough;
                        document.getElementById('edit_xa').value = fullData.xa;
                        document.getElementById('edit_x').value = fullData.x;
                        document.getElementById('edit_mold').value = fullData.mold;
                        document.getElementById('edit_n_color').value = fullData.n_color;
                        document.getElementById('edit_in').value = fullData.in;
                        document.getElementById('edit_in_n').value = fullData.in_n;
                        document.getElementById('edit_mang').value = fullData.mang;
                        document.getElementById('edit_mang_n').value = fullData.mang_n;
                        document.getElementById('edit_be').value = fullData.be;
                        document.getElementById('edit_be_n').value = fullData.be_n;
                        document.getElementById('edit_chap').value = fullData.chap;
                        document.getElementById('edit_chap_n').value = fullData.chap_n;
                        document.getElementById('edit_dong').value = fullData.dong;
                        document.getElementById('edit_dong_n').value = fullData.dong_n;
                        document.getElementById('edit_dan').value = fullData.dan;
                        document.getElementById('edit_dan_n').value = fullData.dan_n;
                        document.getElementById('edit_other').value = fullData.other;
                        document.getElementById('edit_other_n').value = fullData.other_n;

                        var valueToSelect = fullData.unit_id;
                        $('#edit_dvt_select').val(valueToSelect).trigger('change');
                    }
                }
            });
        }
    </script>
    {{-- Load select --}}
    <script>
        window.onload = function() {
            let authToken = localStorage.getItem('authToken') || "";
            let csrfToken = $('meta[name="csrf-token"]').attr('content');
            var domain = document.documentElement.getAttribute('data-domain');
            $.ajax({
                type: 'GET',
                url: domain + '/api/v1/unit',
                headers: {
                    'Authorization': 'Bearer ' + authToken,
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(data) {
                    if (data.data != undefined && data.data != []) {
                        let fullData = data.data;
                        let dvt_select = document.getElementById('dvt_select');
                        // let edit_dvt_select = document.getElementById('edit_dvt_select');
                        fullData.forEach(element => {
                            let newOption = document.createElement("option");
                            newOption.value = element.id;
                            newOption.text = element.name;
                            dvt_select.appendChild(newOption);
                            let newOption2 = document.createElement("option");
                            newOption2.value = element.id;
                            newOption2.text = element.name;
                            edit_dvt_select.appendChild(newOption2);
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

    <hr class="my-5" />
@endsection