@extends('Backend.layout.app_backend')
@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h2>Tài khoản</h2>
        <a href="{{ route('admin.user.create') }}">Thêm mới</a>
    </div>
    <div>
        <table class="table table-hover">
            <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Avata</th>
                  <th scope="col">Tên tài khoản</th>
                  <th scope="col">Email</th>
                  <th scope="col">Status</th>
                  <th scope="col">user type</th>
                  <th scope="col">thao tác</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($users ?? [] as $item)
                    <tr>
                  <th scope="row">{{ $item->id }}</th>
                  <td><img src="{{ $item->avatar ?? 'https://png.pngtree.com/png-vector/20210228/ourlarge/pngtree-load-the-png-image_2976163.jpg' }}" alt="" width="60px" height="60px"></td>
                  <td>{{ $item->name }}</td>
                  <td>{{ $item->email }}</td>
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
                  <td>
                    <a href="{{ route('admin.user.edit',$item->id) }}">edit</a> |
                    <a href="{{ route('admin.user.delete',$item->id) }}">delete</a>
                  </td>
                </tr>
                @endforeach
                
              </tbody>
        </table>
    </div>

@endsection