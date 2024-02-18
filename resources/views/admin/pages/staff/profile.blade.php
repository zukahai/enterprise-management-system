@extends('admin.layouts.main')

@section('title')
    @php
        $title = $user->name . ' | Công ty Hoàng Phát';
    @endphp
@endsection

@section('open-dashboard')
    @php
        $super = 'Hoàng Phát';
        $sub = 'Nugyễn Văn A';
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

@section('content')
    <!-- Header -->
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="user-profile-header-banner">
                    <img src="{{ asset('webhtml/assets/img/pages/profile-banner.png') }}" alt="Banner image"
                        class="rounded-top banner-img" />
                </div>
                <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
                    <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                        <img src="{{ asset($user->avata) }}" alt="user image"
                            class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img" />
                    </div>
                    <div class="flex-grow-1 mt-3 mt-sm-5">
                        <div
                            class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                            <div class="user-profile-info">
                                <h4>{{ $user->name }}</h4>
                                <ul
                                    class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                                    <li class="list-inline-item d-flex gap-1">
                                        <i class="ti ti-color-swatch"></i> {{ ucfirst($user->role->role_name) }}
                                    </li>
                                    <li class="list-inline-item d-flex gap-1"><i class="ti ti-map-pin"></i>
                                        {{ $user->address }}</li>
                                    <li class="list-inline-item d-flex gap-1">
                                        <i class="ti ti-calendar"></i> {{ $user->created_at }}
                                    </li>
                                </ul>
                            </div>
                            <a href="javascript:void(0)" class="btn btn-primary">
                                <i class="fa-regular fa-comment" style="font-size: 17px;"></i> &nbsp; Nhăn tin
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Header -->

    <!-- Navbar pills -->
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-pills flex-column flex-sm-row mb-4">
                <li class="nav-item">
                    <a class="nav-link active" href="javascript:void(0);"><i class="ti-xs ti ti-user-check me-1"></i> Hồ
                        sơ</a>
                </li>
                @if ($user->id == Auth::user()->id)
                    <li class="nav-item">
                        <a class="nav-link" href="pages-profile-teams.html"><i class="ti-xs ti ti-users me-1"></i> Bảo mật
                            tài khoản</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
    <!--/ Navbar pills -->

    <!-- User Profile Content -->
    <div class="row">
        <div class="col-xl-4 col-lg-5 col-md-5">
            <!-- About User -->
            <div class="card mb-4">
                <div class="card-body">
                    <small class="card-text text-uppercase">Thông tin</small>
                    <ul class="list-unstyled mb-4 mt-3">
                        <li class="d-flex align-items-center mb-3">
                            <i class="ti ti-user text-heading"></i><span class="fw-medium mx-2 text-heading">Mã người
                                dùng</span> <span>{{ $user->username }}</span>
                        </li>
                        <li class="d-flex align-items-center mb-3">
                            <i class="ti ti-user text-heading"></i><span class="fw-medium mx-2 text-heading">Họ tên</span>
                            <span>{{ $user->name }}</span>
                        </li>
                        @if (isset($user->cccd))
                            <li class="d-flex align-items-center mb-3">
                                <i class="ti ti-user text-heading"></i><span class="fw-medium mx-2 text-heading">Số
                                    CCCD</span> <span>{{ $user->cccd }}</span>
                            </li>
                        @endif
                        @if (isset($user->business_day))
                            <li class="d-flex align-items-center mb-3">
                                <i class="ti ti-user text-heading"></i><span class="fw-medium mx-2 text-heading">Ngày
                                    công</span> <span>{{ $user->business_day }}</span>
                            </li>
                        @endif
                        @if (isset($user->allowance))
                            <li class="d-flex align-items-center mb-3">
                                <i class="ti ti-user text-heading"></i><span class="fw-medium mx-2 text-heading">Phụ
                                    cấp</span> <span>{{ $user->allowance }}</span>
                            </li>
                        @endif
                        <li class="d-flex align-items-center mb-3">
                            <i class="ti ti-check text-heading"></i><span class="fw-medium mx-2 text-heading">Trạng thái tài
                                khoản:</span> <span>{{ $user->active == 1 ? 'Hoạt động' : 'Bị khoá' }}</span>
                        </li>
                        <li class="d-flex align-items-center mb-3">
                            <i class="ti ti-crown text-heading"></i><span class="fw-medium mx-2 text-heading">Chức
                                năng:</span> <span>{{ ucfirst($user->role->role_name) }}</span>
                        </li>
                    </ul>
                    <small class="card-text text-uppercase">Liên hệ</small>
                    <ul class="list-unstyled mb-4 mt-3">
                        <li class="d-flex align-items-center mb-3">
                            <i class="ti ti-phone-call"></i><span class="fw-medium mx-2 text-heading">Số điện thoại:</span>
                            <span>{{ $user->phone_number }}</span>
                        </li>
                        <li class="d-flex align-items-center mb-3">
                            <i class="ti ti-mail"></i><span class="fw-medium mx-2 text-heading">Email:</span>
                            <span>{{ $user->email }}</span>
                        </li>
                    </ul>
                </div>
            </div>
            <!--/ About User -->

        </div>
        <div class="col-xl-8 col-lg-7 col-md-7">
            <!-- Activity Timeline -->
            <div class="card card-action mb-4">
                <div class="card-header align-items-center">
                    <h4 class="card-action-title mb-0">Lịch sử hoạt động</h4>
                    <div class="card-action-element">
                        <div class="dropdown">
                            <button type="button" class="btn dropdown-toggle hide-arrow p-0" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="ti ti-dots-vertical text-muted"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="javascript:void(0);">Share timeline</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);">Suggest edits</a></li>
                                <li>
                                    <hr class="dropdown-divider" />
                                </li>
                                <li><a class="dropdown-item" href="javascript:void(0);">Report bug</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php
                    $count = 0;
                ?>
                <div class="card-body pb-0">
                    <ul class="timeline ms-1 mb-0">
                        @foreach ($activities as $item)
                            <?php
                                $count++;
                            ?>
                            <li class="timeline-item timeline-item-transparent">
                                <span class="timeline-point timeline-point-{{ $item->color }}"></span>
                                <div class="timeline-event">
                                    <div class="timeline-header">
                                        <h5 class="mb-0">{{ $item->title }}</h5>
                                        <small class="text-muted">Today</small>
                                    </div>
                                    <div class="d-flex flex-wrap">
                                        <div class="avatar me-2">
                                            <img src="{{ asset($user->avata) }}" alt="Avatar"
                                                class="rounded-circle" />
                                        </div>
                                        <div class="ms-1">
                                            <h6 class="mb-0">{{ $item->title }} có id là {{ $item->subject_id }}</h6>
                                        </div>
                                      </div>
                                      @if ($item->event != 'updated')
                                          <details {{$count <= 2 ? 'open' : ''}}>
                                              <summary>Thông tin chi tiết</summary>
                                              <table class="table table-bordered">
                                                  <tr>
                                                      <th>Thông tin</th>
                                                      <th>Giá trị</th>
                                                  </tr>
                                                  @foreach ($item->data as $key => $value)
                                                      <tr>
                                                          <td>
                                                              <small class="text-muted">{{ $key }}</small>
                                                          </td>
                                                          <td>
                                                              <small class="text-muted">{{ $value }}</small>
                                                          </td>
                                                      </tr>
                                                  @endforeach
                                              </table>
                                          </details>
                                      @else()
                                          <details {{$count <= 2 ? 'open' : ''}}>
                                              <summary>Thông tin chi tiết</summary>
                                              <table class="table table-bordered">
                                                  <tr>
                                                      <th>Thông tin</th>
                                                      <th>Giá trị cũ</th>
                                                      <th>Giá trị thay đổi</th>
                                                  </tr>
                                                  @foreach ($item->data_changes as $key => $value)
                                                      <tr>
                                                          <td>
                                                              <small class="text-muted">{{ $key }}</small>
                                                          </td>
                                                          <td>
                                                              <small class="text-muted">{{ $value->old }}</small>
                                                          </td>
                                                          <td>
                                                              <small class="text-muted">{{ $value->new }}</small>
                                                          </td>
                                                      </tr>
                                                  @endforeach
                                              </table>
                                          </details>
                                      @endif
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--/ User Profile Content -->
@endsection
