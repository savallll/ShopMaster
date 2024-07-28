@extends('Fontend.layout.main')
@section('content')
    <div class="container mt-5">

        <div class="d-flex justify-content-between align-items-center">
            <h2>Giỏ hàng của bạn</h2>
        </div>
        <div class="input-group flex-nowrap my-3">
            <span class="input-group-text" id="addon-wrapping">@</span>
            <div class="d-flex w-100">
                <form action="" class="w-100">
                    <input type="text" class="form-control" placeholder="Search" name="search"
                        value="{{ Request::get('search') }}">
                </form>
                {{-- <a href="" type="button" class="btn btn-outline-secondary ms-3">Search</a> --}}
            </div>
        </div>
        <div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Avata</th>
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Tổng tiền </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cartProducts ?? [] as $item)
                        <tr>
                            <th scope="row">{{ $item->id }}</th>
                            <td><img src="{{ $item->product->avatar }}" alt="" width="60px" height="60px"></td>
                            <td>{{ $item->product->name }}</td>
                            <td>
                                <input type="number" id="typeNumber" class="form-control" style="max-width: 50px" value="{{ $item->quantity }}">
                            </td>
                            <td>{{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
    <script>
        $(document).ready(function(){

var quantitiy=0;
   $('.quantity-right-plus').click(function(e){
        
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var quantity = parseInt($('#quantity').val());
        
        // If is not undefined
            
            $('#quantity').val(quantity + 1);

          
            // Increment
        
    });

     $('.quantity-left-minus').click(function(e){
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var quantity = parseInt($('#quantity').val());
        
        // If is not undefined
      
            // Increment
            if(quantity>0){
            $('#quantity').val(quantity - 1);
            }
    });
    
});
    </script>



    {{-- <input type="file" id="imageInput" accept="image/*" multiple>
<div id="imageContainer"></div>

<script>
    const imageInput = document.getElementById('imageInput');
    const imageContainer = document.getElementById('imageContainer');

    imageInput.addEventListener('change', function() {
        const files = this.files;
        if (files.length > 0) {
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const reader = new FileReader();
                reader.onload = function() {
                    const imageWrapper = document.createElement('div');
                    imageWrapper.className = 'imageWrapper';

                    const img = document.createElement('img');
                    img.className = 'uploadedImage';
                    img.src = reader.result;

                    const deleteButton = document.createElement('button');
                    deleteButton.type = 'button';
                    deleteButton.className = 'btn-close';
                    deleteButton.setAttribute('aria-label', 'Close');
                    // Không có ký hiệu 'x' ở đây
                    deleteButton.innerHTML = '';
                    deleteButton.addEventListener('click', function() {
                        imageContainer.removeChild(imageWrapper);
                        // Xóa file tương ứng khi click vào nút đóng
                        let fileList = Array.from(imageInput.files);
                        fileList.splice(i, 1);
                        imageInput.files = new FileList({
                            length: fileList.length,
                            item: function(index) {
                                return fileList[index];
                            }
                        });
                    });

                    imageWrapper.appendChild(img);
                    imageWrapper.appendChild(deleteButton); // Thêm nút xóa vào phần tử bao bọc hình ảnh
                    imageContainer.appendChild(imageWrapper);
                }
                reader.readAsDataURL(file);
            }
        }
    });
</script> --}}
@endsection
