@extends('Fontend.layout.main')
@section('content')
{{-- <aside id="fh5co-hero" class="js-fullheight"> --}}
    {{-- <header id="fh5co-header" class="fh5co-cover fh5co-cover-sm" role="banner" style="background-image:url('');"> --}}
		{{-- <div class="overlay"></div> --}}
		{{-- <div class="container"> --}}
			<nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                      <li class="nav-item active">
                        <a class="nav-link" href="{{ route('client.profile.index') }}">Thông tin</a>
                      </li>
                      <li class="nav-item active">
                        <a class="nav-link active border-bottom" href="{{ route('client.profile.update', Auth::user()->id) }}">Cập nhât thông tin</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link " href="{{ route('client.profile.updatePass', Auth::user()->id) }}">Thay đổi mật khẩu</a>
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
        <form method="POST" action="{{ route('client.profile.update',Auth::user()->id) }}" autocomplete="off" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-7">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Tên tài khoản</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" name="name"
                            value="{{ Auth::user()->name }}">
                        @error('name')
                            <small class="text-danger">{{ $errors->first('name') }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="sdt" class="form-label">Số điện thoại</label>
                        <input type="number" class="form-control" id="sdt" placeholder="" name="phone"
                            value="{{ Auth::user()->phone }}">
                        @error('name')
                            <small class="text-danger">{{ $errors->first('name') }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Địa chỉ</label>
                        <input type="text" class="form-control" id="address" placeholder="" name="address"
                            value="{{ Auth::user()->address }}">
                    </div>
                    <div class="mb-3">
                        <label for="gender" class="form-label">Giới tính</label>
                        <input type="text" class="form-control" id="gender" placeholder="" name="gender"
                            value="{{ Auth::user()->gender }}">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="mb-3">
                        <label for="exampleFormControlInput2" class="form-label">Hình ảnh</label>
                        <div class="border rounded">
                            <div id="imageWrapper" class="border-bottom d-flex" style="display: none;">
                                {{-- @if (isset($user->avatar)) --}}
                                    <img src="{{ Auth::user()->avatar }}" alt="" class="m-3" width="120px" height="120px">
                                {{-- @endif --}}
                            </div>
                            <input type="file" class="form-control" id="exampleFormControlInput2" placeholder=""
                                name="avatar" value="" onchange="previewImages(event)">
                        </div>
                    </div>
                </div>
            </div>
        
            <button type="submit" class="btn btn-outline-primary">Lưu dữ liệu</button>
        
        
            <script>
                function previewImages(event) {
                    const input = event.target;
                    const imageWrapper = document.getElementById('imageWrapper');
        
                    // Xóa các ảnh hiển thị trước đó
                    imageWrapper.innerHTML = '';
        
                    if (input.files && input.files.length > 0) {
                        // Hiển thị phần tử chứa ảnh
                        imageWrapper.style.display = 'flex';
        
                        // Duyệt qua từng tệp hình ảnh và hiển thị
                        for (let i = 0; i < input.files.length; i++) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                const img = document.createElement('img');
                                img.src = e.target.result;
                                img.alt = 'Uploaded Image';
                                img.className = 'm-3';
                                img.width = '120';
                                img.height = '120';
                                imageWrapper.appendChild(img);
                            }
                            reader.readAsDataURL(input.files[i]);
                        }
                    } else {
                        // Nếu không có tệp hình ảnh nào được chọn, ẩn phần tử chứa ảnh
                        imageWrapper.style.display = 'none';
                    }
                }
            </script>
        </form>
        
      </div>

@endsection