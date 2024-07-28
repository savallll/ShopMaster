<form method="POST" action="{{ $action_url }}" autocomplete="off" enctype="multipart/form-data">
    @csrf
    <div class="row">
      <div class="col-md-7">
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Tên sản phẩm</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" name="name" value="{{ isset($product) ? $product->name : ''}}">
            @error('name')
                <small class="text-danger">{{ $errors->first('name')  }}</small>
            @enderror
          </div>
          <div class="mb-3">
            <label for="address" class="form-label">Địa chỉ</label>
            @if (isset($product))
                <h5>{{ $product->getAddressAttribute() }}</h5>
            @endif
            <div class="d-flex">
              <select class="form-select"  id="address" name="province_id"> 
                <option selected value="0" >Chọn Tỉnh</option>
                @foreach ($provinces ?? [] as $item)
                    <option value="{{ $item->province_id }}">{{ $item->name }} </option>
                @endforeach
                
              </select>
              <select class="form-select"  class="ms-3" id="district" name="district_id">
                <option selected value="0">Chọn Quận/Huyện</option>
                {{-- <option value="1">One</option> --}}
              </select>
              <select class="form-select" id="ward" name="ward_id">
                <option selected value="0">Chọn Xã/Phường</option>
                {{-- <option value="1">One</option> --}}
              </select>
            </div>
          </div>
          
          
          
          <div class="mb-3">
            <label for="exampleFormControlInput3" class="form-label">giá</label>
            <input type="number" class="form-control" id="exampleFormControlInput3" placeholder="VND" name="price" value="{{ isset($product) ? $product->price : ''}}">
            @error('price')
                <small class="text-danger">{{ $errors->first('price')  }}</small>
            @enderror
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput4" class="form-label">Số lượng</label>
            <input type="number" class="form-control" id="exampleFormControlInput4" placeholder="" name="number" value="{{ isset($product) ? $product->number : ''}}">
            @error('number')
                <small class="text-danger">{{ $errors->first('number')  }}</small>
            @enderror
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput5" class="form-label">Sale</label>
            <input type="number" class="form-control" id="exampleFormControlInput5" placeholder="%" name="sale" value="{{ isset($product) ? $product->sale : ''}}">
            @error('sale')
                <small class="text-danger">{{ $errors->first('sale')  }}</small>
            @enderror
          </div>
          <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">mô tả</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description">{{ isset($product) ? $product->description : ''}}</textarea>
          </div>
      </div>
      <div class="col-md-5">
        <div class="mb-3">
          <label for="exampleFormControlInput6" class="form-label">Danh mục</label></br>
          <select class="form-select w-50" aria-label="Default select example" id="exampleFormControlInput6" name="category_id">
            <option selected value="0">Chọn danh mục</option>
            @foreach ($categories ?? [] as $item)
                <option value="{{ $item->id }}" {{ isset($product) && $product->category_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
            @endforeach
            
          </select>
        </div>
        <div class="mb-3">
          <label for="exampleFormControlInput6" class="form-label">Trạng thái</label></br>
          <select class="form-select w-50" aria-label="Default select example" id="exampleFormControlInput6" name="status">
            <option selected value="0">Chọn Trạng thái</option>
            @foreach ($status ?? [] as $key => $item)
                <option value="{{ $key }}" {{ isset($product) && $product->status == $key ? 'selected' : '' }}>{{ $item['name'] }}</option>
            @endforeach
            
          </select>
        </div>
        <div class="mb-3">
          <label for="exampleFormControlInput2" class="form-label">Hình ảnh</label>
          <input type="file" class="form-control" id="exampleFormControlInput2" placeholder="" name="avatar" value="{{ isset($product) ? $product->avatar : ''}}">
        </div>
        <div class="mb-3">
          <label for="exampleFormControlInput2" class="form-label">Album</label>
          <div class="border rounded">
              <div id="imageWrapper" class="border-bottom d-flex" style="display: none;">
                  @foreach ($imgs ?? [] as $img)
                      <img src="{{ $img->path }}" alt="" class="m-3" width="120px" height="120px">
                  @endforeach
              </div>
              <input type="file" multiple class="form-control" id="exampleFormControlInput2" placeholder="" name="avatars[]" value="" onchange="previewImages(event)">
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

    <script>
      // Lấy các select box và gán các sự kiện onchange
      var provinceSelect = document.getElementById('address');
      var districtSelect = document.getElementById('district');
      var wardSelect = document.getElementById('ward');

      provinceSelect.onchange = function() {
          // Xóa tất cả các lựa chọn cũ của quận/huyện và xã/phường
          districtSelect.innerHTML = '<option selected value="0">Chọn Quận/Huyện</option>';
          wardSelect.innerHTML = '<option selected  value="0">Chọn Xã/Phường</option>';

          // Lấy giá trị của tỉnh/thành phố được chọn
          var selectedProvinceId = provinceSelect.value;

          // Lọc danh sách quận/huyện tương ứng với tỉnh/thành phố được chọn
          var districts = {!! json_encode($districts) !!}; // Dữ liệu các quận/huyện, bạn cần đảm bảo dữ liệu này được truyền từ phía server

          // Lặp qua danh sách quận/huyện và thêm vào select box
          districts.forEach(function(district) {
              if (district.province_id == selectedProvinceId) {
                  var option = document.createElement('option');
                  option.text = district.name;
                  option.value = district.district_id;
                  districtSelect.add(option);
              }
          });
      };

      districtSelect.onchange = function() {
          // Xóa tất cả các lựa chọn cũ của xã/phường
          wardSelect.innerHTML = '<option selected  value="0">Chọn Xã/Phường</option>';

          // Lấy giá trị của quận/huyện được chọn
          var selectedDistrictId = districtSelect.value;

          // Lọc danh sách xã/phường tương ứng với quận/huyện được chọn
          var wards = {!! json_encode($wards) !!}; // Dữ liệu các xã/phường, bạn cần đảm bảo dữ liệu này được truyền từ phía server

          // Lặp qua danh sách xã/phường và thêm vào select box
          wards.forEach(function(ward) {
              if (ward.district_id == selectedDistrictId) {
                  var option = document.createElement('option');
                  option.text = ward.name;
                  option.value = ward.wards_id;
                  wardSelect.add(option);
              }
          });
      };

    </script>
</form>