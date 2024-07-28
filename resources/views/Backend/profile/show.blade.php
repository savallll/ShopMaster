@extends('Backend.layout.app_backend')
@section('content')
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link {{ request()->routeIs('admin.profile.show') ? 'active border-bottom' : '' }}" href="{{ route('admin.profile.show', Auth::user()->id) }}">Thông tin</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.profile.updatePass') ? 'active border-bottom' : '' }}" href="{{ route('admin.profile.updatePass', Auth::user()->id) }}">Thay đổi mật khẩu</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Thay đổi email</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">
      <img src="" alt="">
      <h3 >{{ Auth::user()->name }}</h3>
      <p>Email: {{ Auth::user()->email }}</p>
      <p>Số điện thoại: {{ Auth::user()->phone }}</p>
      <p>Địa chỉ: {{ Auth::user()->address }}</p>
      <p>Giới tính: {{ Auth::user()->gender }}</p>
      <p>User type: {{ Auth::user()->userType->first()->name }}</p>

  </div>

@endsection()