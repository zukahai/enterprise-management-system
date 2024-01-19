@extends('admin.layouts.login')

@section('onload')
  @if ($message = Session::get('success'))
        onload="loadPage('{{$message}}' , 'success')"
    @endif
    @if ($message = Session::get('error'))
        onload="loadPage('{{$message}}' , 'danger')"
    @endif
    @if ($message = Session::get('warning'))
        onload="loadPage('{{$message}}' , 'warning')"
    @endif
@endsection