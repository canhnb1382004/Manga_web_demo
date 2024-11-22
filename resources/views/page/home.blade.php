@extends('page.layout')

@section('content')
<style>
        /* CSS để tạo khung hiển thị chỉ 5 ảnh */
        .slider-container {
            overflow: hidden;
            width: 80%; /* Hoặc đặt một kích thước cụ thể */
            margin: auto;
        }
        .slider-wrapper {
            display: flex;
            transition: transform 0.5s ease;
        }
        .slide-item {
            min-width: 20%; /* Hiển thị 5 ảnh mỗi lần */
            box-sizing: border-box;
            text-align: center;
        }
        .img_top {
            width: 80%;
            height: auto;
        }
    </style>
<div class="content_home ">
    <div class="container">
        <div class="row">
            <div class="col fs-5 mt-4 mb-4" style="color:#ff2853;"><i class=" fs-5 fa-solid fa-star"></i> Truyện Hay</div>
        </div>
        <div class="row align-items-center">
            <div class="col-1 text-center">
                <button id="scroll-left" class="btn btn-light">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>
            </div>
            
            <!-- Bắt đầu khu vực hiển thị nội dung -->
            <div class="col-10 slider-container">
                <div id="manga-slider" class="slider-wrapper">
                    @foreach ($manga2 as $key => $man2)
                        <div class="slide-item mx-2 mt-2">                           
                            <a href="{{ route('manga_detail', [$man2->manga_id]) }}">
                                <img class='img_top' src="{{ asset('public/images/manga/' . $man2->manga_img) }}" >
                                <div class="manganame">{{ $man2->manga_name }}</div>
                            </a>                         
                        </div>
                    @endforeach
                </div>
            </div>
            
            <div class="col-1 text-center">
                <button id="scroll-right" class="btn btn-light">
                    <i class="fa-solid fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="container mt-3">
        <div class="row">
            <div class="col fs-5" style="color:#56ccf2;"><i class="fs-5 fa-solid fa-newspaper"></i> Truyện Mới Cập Nhật</div> <!-- Chữ rất lớn -->
        </div>
        <div class="row align-items-center">
            @foreach ($manga as $key =>$man )
                <div class="col-2 text-center mt-4 mb-4">
                    <a href="{{route('manga_detail',[$man->manga_id])}}">
                        <img src="{{ asset('public/images/manga/' . $man->manga_img) }}" alt="Image 1" class="img-fluid">
                        <div class="manganame">{{ $man->manga_name }}</div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <div class="container mt-3">
        <div class="row">
            <div class="col fs-5" style="color:#56ccf2;"><i class="fs-5 fa-solid fa-newspaper"></i> Truyện Đã Hoàn Thành</div> <!-- Chữ rất lớn -->
        </div>
        <div class="row align-items-center">
            @foreach ($manga1 as $key =>$man1 )
                <div class="col-2 text-center mt-4 mb-4">
                    <a href="{{route('manga_detail',[$man1->manga_id])}}">
                        <img src="{{ asset('public/images/manga/' . $man1->manga_img) }}" alt="Image 1" class="img-fluid">
                        <div class="manganame">{{ $man1->manga_name }}</div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
<script>
        const slider = document.getElementById('manga-slider');
        const slideWidth = document.querySelector('.slide-item').offsetWidth;
        let scrollPosition = 0;

        document.getElementById('scroll-left').addEventListener('click', () => {
            scrollPosition -= slideWidth;
            if (scrollPosition < 0) scrollPosition = 0;
            slider.style.transform = `translateX(-${scrollPosition}px)`;
        });

        document.getElementById('scroll-right').addEventListener('click', () => {
            const maxScroll = slider.scrollWidth - slider.parentElement.clientWidth;
            scrollPosition += slideWidth;
            if (scrollPosition > maxScroll) scrollPosition = maxScroll;
            slider.style.transform = `translateX(-${scrollPosition}px)`;
        });
    </script>
@endsection