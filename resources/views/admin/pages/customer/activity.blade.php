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

@section('content')
    {{-- {{$activities}} --}}
    <h1> Lịch sử chỉnh sửa của {{$sub}}</h1>
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
                                    <h5 class="mb-0">
                                        <a href="{{route('profile.user', ['username' => $item->user->username])}}">{{ $item->user->name }}</a>
                                        {{ $item->activity }} <a href="{{$item->route }}">{{$item->name_model}}</a></h5>
                                    <small
                                        class="text-muted">{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</small>
                                </div>
                                <div class="d-flex flex-wrap">
                                    <div class="avatar me-2">
                                        <img src="{{ asset($item->user->avata) }}" alt="Avatar"
                                            class="rounded-circle" />
                                    </div>
                                    <div class="ms-1">
                                        <small class="text-muted">{{ $item->created_at }}</small>
                                        <h6 class="mb-0">{{ ucfirst($item->name_model) }} có id là {{ $item->subject_id }}</h6>
                                    </div>
                                </div>
                                @if ($item->event != 'updated')
                                    <details {{ $count <= 2 ? 'open' : '' }}>
                                        <summary>Thông tin chi tiết</summary>
                                        <div class="table-activity">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th>Thông tin</th>
                                                    <th>Giá trị</th>
                                                </tr>
                                                @foreach ($item->data as $key => $value)
                                                    <tr>
                                                        <td>
                                                            <small class="text-muted">{{ ucfirst($key) }}</small>
                                                        </td>
                                                        <td>
                                                            <small class="text-muted">{{ $value }}</small>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </div>
                                    </details>
                                @else()
                                    <details {{ $count <= 2 ? 'open' : '' }}>
                                        <summary>Thông tin chi tiết</summary>
                                        <div class="table-activity">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th>Thông tin</th>
                                                    <th>Giá trị cũ</th>
                                                    <th>Giá trị thay đổi</th>
                                                </tr>
                                                @foreach ($item->data_changes as $key => $value)
                                                    <tr>
                                                        <td>
                                                            <small class="text-muted">{{ ucfirst($key) }}</small>
                                                        </td>
                                                        <td>
                                                            @if (is_array($value->old) || is_object($value->old))
                                                                @foreach ($value->old as $subKey => $subValue)
                                                                    <small class="text-muted">{{ ucfirst($subKey) }}:
                                                                        {{ is_object($subValue) ? $subValue->id : $subValue }}</small><br>
                                                                @endforeach
                                                            @else
                                                                <small
                                                                    class="text-muted">{{ $value->old }}</small>

                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if (is_array($value->new) || is_object($value->new))
                                                                @foreach ($value->new as $subKey => $subValue)
                                                                    <small class="text-muted">{{ ucfirst($subKey) }}:
                                                                        {{ is_object($subValue) ? $subValue->id : $subValue }}</small><br>
                                                                @endforeach
                                                            @else
                                                                <small
                                                                    class="text-muted">{{ $value->new }}</small>

                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </div>
                                    </details>
                                @endif
                                <a href="{{ $item->url }}" class="btn btn-sm btn-label-primary">Lịch sử chỉnh
                                    sửa {{$item->name_model}}</a>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
@endsection