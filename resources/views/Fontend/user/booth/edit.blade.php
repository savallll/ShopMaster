@extends('Fontend.layout.main')
@section('content')
    @php
        $action_url = route('client.booth.update', $product->id);
    @endphp

    @include('Fontend.user.booth.nav')

    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Cập nhật sản phẩm</h2>
            <a href="{{ route('client.booth', Auth::user()->id ) }}">Trở về</a>

        </div>

        <div class="px-5 py-5">
            @include('Fontend.user.booth.form')
        </div>

    </div>
@endsection
