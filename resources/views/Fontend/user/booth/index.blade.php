@extends('Fontend.layout.main')
@section('content')
    {{-- <aside id="fh5co-hero" class="js-fullheight"> --}}
    <div id="fh5co-header" class="fh5co-cover fh5co-cover-sm" role="banner" style="background-image:url('');">
        @include('Fontend.user.booth.nav')

        {{-- <div class="overlay"></div> --}}
        <div class="container">

			
            <div class="d-flex justify-content-between align-items-center">
                <h2>Sản phẩm</h2>
                {{-- <a href="{{ route('admin.product.create') }}">Thêm mới</a> --}}
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
                        <tr class="table-row">
                            <th scope="col">#</th>
                            <th scope="col">Avata</th>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Danh mục</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Ngày tạo</th>
                            <th scope="col">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products ?? [] as $item)
                            <tr class="table-row">
                                <th class="align-middle" scope="row">{{ $item->id }}</th>
                                <td><a href="{{ $item->status == 2 ? route('client.product_detail', $item->id) : '#' }}"><img src="{{ $item->avatar }}" alt="" width="60px" height="60px"></a></td>
                                <td class="align-middle"><a href="{{ $item->status == 2 ? route('client.product_detail', $item->id) : '#' }}" class="text-dark text-decoration-none">{{ $item->name }}</a></td>
                                <td class="align-middle">{{ $item->category->name ?? '' }}</td>
                                <td class="align-middle">{{ $item->number }}</td>
                                {{-- <td>{{ $item->user->name ?? '' }}- {{ $item->user->id ?? '' }}</td> --}}
                                <td class="align-middle">{{ number_format($item->price, 0, ',', '.') }} đ</td>
                                <td class="align-middle"><span
                                        class="{{ $item->getStatus($item->status)['class'] ?? '' }}">{{ $item->getStatus($item->status)['name'] ?? '' }}</span>
                                </td>
                                <td class="align-middle">{{ $item->created_at }}</td>
                                <td class="align-middle">
                                    <a href="{{ route('client.booth.update', $item->id) }}">edit</a> |
                                    <a href="{{ route('client.booth.delete', $item->id) }}">delete</a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
