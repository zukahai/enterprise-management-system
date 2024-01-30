@extends('admin.layouts.main')

@section('open-dashboard')
    @php
        $super = 'materials';
        $sub = 'finished-product';
    @endphp
@endsection

@section('title')
    @php
        $title = $object->name." | Thành phẩm | Công ty Hoàng Phát";
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
        <a href="{{ route('finished-product.index') }}">{{ ucfirst($sub) }}</a> 
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

    <!-- Delete User Modal -->
    <div class="modal fade" id="delete-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-simple modal-edit-user">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                        <h3 class="mb-2">Xác nhận xoá thành phẩm</h3>
                        <h2><a href="javascript:" class="mb-2 text-primary" id="delete-name-title">{{$object->name}}</a></h2>
                    </div>
                    <div id="" class="row g-3" method="POST">
                        <div class="col-sm-12 text-center">
                            <button type="submit" class="btn btn-primary mx-auto" onclick="deleteObject({{$object->id}}, 'finished-product', 'abc')">Xoá</button>
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
                        <td colspan="2">Mã</td>
                        <td>{{$object->id}}</td>
                    </tr>
                    <tr>
                        <td colspan="2">Tên</td>
                        <td>{{$object->name}}</td>
                    </tr>
                    <tr>
                        <td rowspan="3" class="color-1">KT đơn dàng</td>
                        <td class="color-1">Dài</td>
                        <td class="color-1">{{$object->ktdh_length}}</td>
                    </tr>
                    <tr>
                        <td class="color-1">Rộng</td>
                        <td class="color-1">{{$object->ktdh_width}}</td>
                    </tr>
                    <tr>
                        <td class="color-1">Cao</td>
                        <td class="color-1">{{$object->ktdh_height}}</td>
                    </tr>
                    <tr>
                        <td rowspan="3" class="color-2">KT Sản xuất</td>
                        <td class="color-2">Dài</td>
                        <td class="color-2">{{$object->ktsx_length}}</td>
                    </tr>
                    <tr>
                        <td class="color-2">Rộng</td>
                        <td class="color-2">{{$object->ktsx_width}}</td>
                    </tr>
                    <tr>
                        <td class="color-2">Cao</td>
                        <td class="color-2">{{$object->ktsx_height}}</td>
                    </tr>
                    <tr>
                        <td colspan="2">Sóng</td>
                        <td>{{$object->song}}</td>
                    </tr>
                    <tr>
                        <td colspan="2">Đơn vị</td>
                        <td>{{$object->unit->name}} {{($object->unit->description ? "(".$object->unit->description.")" : "")}}</td>
                    </tr>
                    <tr>
                        <td colspan="2">Đơn giá</td>
                        <td>{{$object->price}}</td>
                    </tr>
                    <tr>
                        <td colspan="2">Hoa hồng</td>
                        <td>{{$object->rose}}</td>
                    </tr>
                    <tr>
                        <td colspan="2">% Hoa hồng</td>
                        <td>{{$object->rose_percent}}</td>
                    </tr>
                    <tr>
                        <td colspan="2">Ghi chú</td>
                        <td>{{$object->note}}</td>
                    </tr>
                    <tr>
                        <td colspan="2">Kiểu</td>
                        <td>{{$object->type}}</td>
                    </tr>
                    <tr>
                        <td colspan="2">Giao đủ</td>
                        <td>{{$object->delivered_enough}}</td>
                    </tr>
                    <tr>
                        <td colspan="2">Xả</td>
                        <td>
                            @if($object->xa > 0)
                            {{$object->xa}}<br>
                            <span class="badge bg-label-success">{{$object->x}}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">Phim / khuôn</td>
                        <td>{{$object->mold}}</td>
                    </tr>
                    <tr>
                        <td colspan="2">Số màu</td>
                        <td>{{$object->n_color}}</td>
                    </tr>
                    <tr>
                        <td colspan="2">In</td>
                        <td>
                            @if($object->in > 0)
                            {{$object->in}}<br>
                            <span class="badge bg-label-success">{{$object->in_n}}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">Màng</td>
                        <td>
                            @if($object->mang > 0)
                            {{$object->mang}}<br>
                            <span class="badge bg-label-success">{{$object->mang_n}}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">Bế</td>
                        <td>
                            @if($object->be > 0)
                            {{$object->be}}<br>
                            <span class="badge bg-label-success">{{$object->be_n}}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">Chạp</td>
                        <td>
                            @if($object->chap > 0)
                            {{$object->chap}}<br>
                            <span class="badge bg-label-success">{{$object->chap_n}}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">Đóng</td>
                        <td>
                            @if($object->dong > 0)
                            {{$object->dong}}<br>
                            <span class="badge bg-label-success">{{$object->dong_n}}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">Dán</td>
                        <td>
                            @if($object->dan > 0)
                            {{$object->dan}}<br>
                            <span class="badge bg-label-success">{{$object->dan_n}}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">Khác</td>
                        <td>
                            @if($object->other > 0)
                            {{$object->other}}<br>
                            <span class="badge bg-label-success">{{$object->other_n}}</span>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-sm-12 text-center mb-2">
            <button  class="btn btn-primary me-sm-3 me-1" data-bs-toggle="modal" data-bs-target="#edit" onclick="editRecord({{$object->id}})">Chỉnh sửa</button>
            <button  class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#delete-modal">Xoá</button>
        </div>
    </div>

    <script src="{{ asset('webhtml/assets/custom-js/finished-product.js') }}"></script>

    <hr class="my-5" />
@endsection
