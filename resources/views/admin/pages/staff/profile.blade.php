@extends('admin.layouts.main')

@section('title')
    @php
        $title = $user->name . " | Công ty Hoàng Phát";
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
    {{$user}}
@endsection