<form method="POST" action="{{ $action_url }}" autocomplete="off" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-7">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Tên tài khoản</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" name="name"
                    value="{{ isset($user) ? $user->name : '' }}">
                @error('name')
                    <small class="text-danger">{{ $errors->first('name') }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" placeholder="" name="email"
                    value="{{ isset($user) ? $user->email : '' }}">
                @error('email')
                    <small class="text-danger">{{ $errors->first('email') }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="sdt" class="form-label">Số điện thoại</label>
                <input type="number" class="form-control" id="sdt" placeholder="" name="phone"
                    value="{{ isset($user) ? $user->phone : '' }}">
                @error('name')
                    <small class="text-danger">{{ $errors->first('name') }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Địa chỉ</label>
                <input type="text" class="form-control" id="address" placeholder="" name="address"
                    value="{{ isset($user) ? $user->address : '' }}">
            </div>
            <div class="mb-3">
                <label for="gender" class="form-label">Giới tính</label>
                <input type="text" class="form-control" id="gender" placeholder="" name="gender"
                    value="{{ isset($user) ? $user->gender : '' }}">
            </div>
            <div class="form-group mb-3">
                <label for="name"><b>role:</b></label>
                <div class="row">
                    @foreach ($roles as $group_name => $roles)
                        <div class="col-5">
                            <h6 class="fw-bolder">{{ $group_name }}</h6>

                            @foreach ($roles as $item)
                                <div class="form-check">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{ $item->id }}"
                                            name="role_ids[]" id="{{ $item->display_name }}"
                                            {{ in_array($item->id, $roleActive) ? 'checked' : '' }}>
                                        <label class="form-check-label"
                                            for="{{ $item->display_name }}">{{ $item->display_name }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="mb-3">
                <label for="status" class="form-label">Trạng thái</label></br>
                <select class="form-select w-50" aria-label="Default select example" id="status" name="status">
                    <option selected value="">Chọn trạng thái</option>
                    <option value="-1" {{ ( $user->status ?? 1) == -1 ? 'selected' : '' }}>Tạm dừng</option>
                    <option value="2" {{ ( $user->status ?? 1) == 2 ? 'selected' : '' }}>Hoạt Động</option>
                    <option value="1" {{ ( $user->status ?? 1) == 1 ? 'selected' : '' }}>Chưa kích hoạt</option>

                </select>

            </div>
            <div class="mb-3">
                @php
                    if (isset($user->userType)) {
                        foreach ($user->userType as $item) {
                            $userHasTypeId = $item->id;
                        }
                    }
                @endphp

                <label for="exampleFormControlInput6" class="form-label">User type</label></br>
                <select class="form-select w-50" aria-label="Default select example" id="exampleFormControlInput6"
                    name="user_type">
                    <option selected value="0">Chọn User type</option>
                    @foreach ($user_type ?? [] as $item)
                        <option value="{{ $item->id }}"
                            {{ isset($user->userType) && $userHasTypeId == $item->id ? 'selected' : (empty($user->userType) ? ($item->id == 1 ? 'selected' : '') : '') }}>
                            {{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput2" class="form-label">Hình ảnh</label>
                <div class="border rounded">
                    <div id="imageWrapper" class="border-bottom d-flex" style="display: none;">
                        @if (isset($user->avatar))
                            <img src="{{ $user->avatar }}" alt="" class="m-3" width="120px" height="120px">
                        @endif
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
