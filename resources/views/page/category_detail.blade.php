@extends('page.layout')

@section('content')
<div  style="background-color: #ebebeb; padding:20px;">
<div class="content_home">
    <style>
        /* Khoảng cách giữa header và nội dung chính */
        
        /* CSS cho ba container đầu tiên */
        .content_home .container-white {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
        }

        body, html {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }

        /* Đặt khoảng trắng cho nội dung chính */
        .layout_content {
            flex: 1; /* Để layout_content chiếm không gian còn lại */
        }

        .spacer1 {
            height: 200px; /* Điều chỉnh chiều cao khoảng trắng */
            background-color: #ebebeb;
        }
    </style>

    <!-- Nội dung trang -->
    <div class="container container-white">
        <div class="row">
            <div class="col">
                <h5><i class="fa-regular fa-flag mx-2"></i>{{ $category->category_name }}</h5>              
        </div>
    </div>

    <div class="container container-white">
        <div class="row">
            <p>{{ $category->category_description }}</p>
        </div>
    </div>

    <div class="container container-white">
        <div class="row">
            <div class="col-2">
                <p>Thể Loại Truyện</p>
            </div>
            <div class="col-9">
                <button type="button" class="btn btn-outline-warning">{{ $category->category_name }}</button>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row align-items-center">
            @foreach ($manga as $key => $man)
                <div class="col-2 text-center mt-4 mb-4">
                    <a href="{{ route('manga_detail', [$man->manga_id]) }}">
                        <img src="{{ asset('public/images/manga/' . $man->manga_img) }}" alt="Image" class="img-fluid">
                        <div class="manganame">{{ $man->manga_name }}</div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>

<div class="spacer1"></div>
</div>
@endsection
