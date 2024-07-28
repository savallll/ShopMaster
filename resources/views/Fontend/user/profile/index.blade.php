@extends('Fontend.layout.main')
@section('content')
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link active border-bottom" href="{{ route('client.profile.index') }}">Thông tin</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link " href="{{ route('client.profile.update', Auth::user()->id) }}">Cập nhât thông
                            tin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('client.profile.updatePass', Auth::user()->id) }}">Thay đổi mật
                            khẩu</a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="#">Thay đổi email</a>
                      </li> --}}
                </ul>
            </div>
        </div>
    </nav>

    {{-- </div> --}}
    {{-- </header> --}}


    <div class="container ms-5">
        <div class="px-5 mx-5">


            <div class="d-flex align-items-center pb-3">
                <img src="{{ Auth::user()->avatar }}" alt="" width="60px" height="60px" alt=""
                    class=" rounded-circle">
                <div>
                    <h3 class="px-3">{{ Auth::user()->name }}</h3>
                    <p class="{{ Auth::user()->getStatus(Auth::user()->status)['class'] ?? '' }} ms-3">
                        {{ Auth::user()->getStatus(Auth::user()->status)['name'] ?? '' }}</p>
                    <p><a href="{{ route('client.user.Mailactivate', Auth::user()->id) }}"
                            class="text-danger  ms-3">{{ Auth::user()->status == 1 ? 'Kích hoạt ngay' : '' }}</a></p>

                </div>
            </div>
            <p>Email: {{ Auth::user()->email }}</p>
            <p>Số điện thoại: {{ Auth::user()->phone }}</p>
            <p>Địa chỉ: {{ Auth::user()->address }}</p>
            <p>Giới tính: {{ Auth::user()->gender }}</p>
            <p>User type: {{ Auth::user()->userType->first()->name }}</p>
        </div>
    </div>
@endsection
