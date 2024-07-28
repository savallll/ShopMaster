@extends('Fontend.layout.main')
@section('content')
    @php
        $action_url = route('client.booth.store');
    @endphp

    @include('Fontend.user.booth.nav')
    <div class="container">


        <div class="d-flex justify-content-between align-items-center">
            <h2>Thêm mới sản phẩm</h2>
            {{-- <a href="{{ route('admin.product.create') }}">Thêm mới</a> --}}
        </div>

        <div class="px-5 py-5">
          @include('Fontend.user.booth.form')
        </div>

    </div>
    
@endsection
