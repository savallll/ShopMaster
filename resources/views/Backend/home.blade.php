@extends('Backend.layout.app_backend')
@section('content')
{{-- <script>

  const jwtToken = document.cookie.replace(/(?:(?:^|.*;\s*)jwt_token\s*\=\s*([^;]*).*$)|^.*$/, "$1");

  // Gửi yêu cầu đến máy chủ với JWT token trong tiêu đề "Authorization"
  fetch('/', {
    method: 'GET',
    headers: {
      'Authorization': `Bearer ${jwtToken}`
    }
  })
  .then(response => {
    // Xử lý phản hồi từ máy chủ
    console.log('success');
  })
  .catch(error => {
    console.error('Error:', error);
  });
</script> --}}
{{-- <div class="table-responsive">
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th># </th>
       {{ auth()->user()->userType }}
          <th>Header</th>
          <th>Header</th>
          <th>Header</th>
          <th>Header</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1,001</td>
          <td>random</td>
          <td>data</td>
          <td>placeholder</td>
          <td>text</td>
        </tr>
        <tr>
          <td>1,002</td>
          <td>placeholder</td>
          <td>irrelevant</td>
          <td>visual</td>
          <td>layout</td>
        </tr>
        <tr>
          <td>1,003</td>
          <td>data</td>
          <td>rich</td>
          <td>dashboard</td>
          <td>tabular</td>
        </tr>
        <tr>
          <td>1,003</td>
          <td>information</td>
          <td>placeholder</td>
          <td>illustrative</td>
          <td>data</td>
        </tr>
        <tr>
          <td>1,004</td>
          <td>text</td>
          <td>random</td>
          <td>layout</td>
          <td>dashboard</td>
        </tr>
        <tr>
          <td>1,005</td>
          <td>dashboard</td>
          <td>irrelevant</td>
          <td>text</td>
          <td>placeholder</td>
        </tr>
        <tr>
          <td>1,006</td>
          <td>dashboard</td>
          <td>illustrative</td>
          <td>rich</td>
          <td>data</td>
        </tr>
        <tr>
          <td>1,007</td>
          <td>placeholder</td>
          <td>tabular</td>
          <td>information</td>
          <td>irrelevant</td>
        </tr>
        <tr>
          <td>1,008</td>
          <td>random</td>
          <td>data</td>
          <td>placeholder</td>
          <td>text</td>
        </tr>
        <tr>
          <td>1,009</td>
          <td>placeholder</td>
          <td>irrelevant</td>
          <td>visual</td>
          <td>layout</td>
        </tr>
        <tr>
          <td>1,010</td>
          <td>data</td>
          <td>rich</td>
          <td>dashboard</td>
          <td>tabular</td>
        </tr>
        <tr>
          <td>1,011</td>
          <td>information</td>
          <td>placeholder</td>
          <td>illustrative</td>
          <td>data</td>
        </tr>
        <tr>
          <td>1,012</td>
          <td>text</td>
          <td>placeholder</td>
          <td>layout</td>
          <td>dashboard</td>
        </tr>
        <tr>
          <td>1,013</td>
          <td>dashboard</td>
          <td>irrelevant</td>
          <td>text</td>
          <td>visual</td>
        </tr>
        <tr>
          <td>1,014</td>
          <td>dashboard</td>
          <td>illustrative</td>
          <td>rich</td>
          <td>data</td>
        </tr>
        <tr>
          <td>1,015</td>
          <td>random</td>
          <td>tabular</td>
          <td>information</td>
          <td>text</td>
        </tr>
      </tbody>
    </table>
</div> --}}
<div class="container">
  <div class="row">
    <div class="col-3">
      <div class="text-bg-primary p-3">Thành viên: 
        <b>20</b>
      </div>
    </div>
    <div class="col-3">
      <div class="text-bg-danger p-3">Tin:
        <b>999+</b>
        
      </div>
    </div>
    <div class="col-3">
      <div class="text-bg-success p-3">Báo cáo:
        <b>5</b>
      </div>
    </div>
    <div class="col-3">
      <div class="text-bg-secondary p-3">User mới:
        <b>10</b>
      </div>
    </div>
    
  </div>
  <div class="row mt-5">
    <div class="col-md-5 col-sm-12">
      <h3>Thành viên mới</h3>
      <table class="table table-hover">
        <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Avata</th>
              <th scope="col">Tên tài khoản</th>
              <th scope="col">Status</th>
              <th scope="col">user type</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($users ?? [] as $item)
                <tr>
                  <th scope="row">{{ $item->id }}</th>
                  <td><img src="{{ $item->avatar }}" alt="" width="60px" height="60px"></td>
                  <td>{{ $item->name }}</td>
                  <td>
                    <span  class="{{ $item->getStatus($item->status)['class'] ?? '' }}">{{ $item->getStatus($item->status)['name'] ?? '' }}</span>
                  </td>
                  <td>
                    @if ($item->userType && !$item->userType->isEmpty())
                        @foreach ($item->userType as $type)
                            {{ $type->name }}
                        @endforeach
                    @endif
                    
                  </td>
                </tr>
            @endforeach
            
          </tbody>
    </table>
    </div>
    <div class="col-md-7 col-sm-12">
      <h3>Sản phẩm mới</h3>
      <table class="table table-hover">
        <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Avata</th>
              <th scope="col">Tên sản phẩm</th>
              <th scope="col">Danh mục</th>
              <th scope="col">Người đăng- id</th>
              <th scope="col">Giá</th>
              <th scope="col">Trạng thái</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($products ?? [] as $item)
                <tr>
                  <th scope="row">{{ $item->id }}</th>
                  <td><img src="{{ $item->avatar }}" alt="" width="60px" height="60px"></td>
                  <td>{{ $item->name }}</td>
                  <td>{{ $item->category_id }}</td>
                  <td>{{ $item->user->name ?? '' }}- {{ $item->user->id ?? ''}}</td>
                  <td>{{ number_format($item->price, 0, ',', '.') }} đ</td>
                  <td><span  class="{{ $item->getStatus($item->status)['class'] ?? '' }}">{{ $item->getStatus($item->status)['name'] ?? '' }}</span></td>
                </tr>
              @endforeach
            
          </tbody>
    </table>
    </div>
  </div>
</div>

@endsection