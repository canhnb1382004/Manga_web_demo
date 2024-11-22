@extends('page.layout')

@section('content')
<style>
        /* Thiết lập flex cho toàn bộ trang */
        body, html {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }

        /* Đặt khoảng trắng cho nội dung chính */
        .layout_content {
            flex: 1; /* Để layout_content chiếm không gian còn lại */
            padding-bottom: 50px; /* Khoảng cách dưới cùng */
        }
        
        /* Khoảng trắng cố định dưới nội dung */
        .spacer {
            height: 200px; /* Điều chỉnh chiều cao khoảng trắng */
        }
</style>
    <div class="container mt-5">
        <h3>Kết quả tìm kiếm cho: "{{ $search }}"</h3>
        
        @if ($manga->isEmpty())
            <p>Không tìm thấy manga nào.</p>
        @else
            <div class="row">
                @foreach ($manga as $man)
                    <div class="col-3 text-center mt-4 mb-4">
                        <a href="{{ route('manga_detail', [$man->manga_id]) }}">
                            <img src="{{ asset('public/images/manga/' . $man->manga_img) }}" alt="{{ $man->manga_name }}" class="img-fluid">
                            <div class="manganame">{{ $man->manga_name }}</div>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
<div class="spacer"></div>
@endsection
