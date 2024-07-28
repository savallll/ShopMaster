@extends('Backend.layout.app_backend')
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
                        <a class="nav-link {{ request()->routeIs('admin.profile.show') ? 'active border-bottom' : '' }}"
                            href="{{ route('admin.profile.show', Auth::user()->id) }}">Thông tin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.profile.updatePass') ? 'active border-bottom' : '' }}"
                            href="{{ route('admin.profile.updatePass', Auth::user()->id) }}">Thay đổi mật khẩu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Thay đổi email</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    @if (session('success'))
        <p class="text-success mt-2">{{ session('success') }}</p>
    @endif
    @if (session('error'))
        <p class="text-danger mt-2">{{ session('error') }}</p>
    @endif
    <form action="{{ route('admin.profile.updatePass', Auth::user()->id) }}" method="post">
        @csrf
        <h3 class="py-4">{{ Auth::user()->name }}</h3>

        <div class="mb-3">
            <label for="formGroupExampleInput" class="form-label">Mật khẩu cũ</label>
            <input type="password" class="form-control" id="formGroupExampleInput" placeholder="Mật khẩu cũ" name="old_password">
            @error('old_password')
                <small class="text-danger">{{ $errors->first('old_password')  }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput2" class="form-label">Mật khẩu mới</label>
            <input type="password" class="form-control" id="formGroupExampleInput2" placeholder="Mật khẩu mới" name="new_password">
            @error('new_password')
                <small class="text-danger">{{ $errors->first('new_password')  }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput3" class="form-label">Xác nhận mật khẩu </label>
            <input type="password" class="form-control" id="formGroupExampleInput3" placeholder="Mật khẩu " name="confirm_password">
            @error('confirm_password')
                <small class="text-danger">{{ $errors->first('confirm_password')  }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Thay đổi mật khẩu</button>
    </form>
@endsection()
