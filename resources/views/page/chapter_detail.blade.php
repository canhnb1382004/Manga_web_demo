@extends('page.layout')

@section('content')
<div style="background-color: #333333; padding: 20px;">
    <div class="chapter_background">
        <div class="container chapter_direct mt-2">
            <div class="row mt-2">
                <h5 class="mt-3">
                    <a href="{{ asset('/') }}">Trang Chủ</a> /
                    <a href="{{ route('manga_detail', [$chapter->manga_id]) }}">{{ $chapter->manga_name }}</a> /
                    {{ $chapter->chapter_name }}
                </h5>
            </div>
            <div class="row mt-4">
                <h4>{{ $chapter->manga_name }} - {{ $chapter->chapter_name }} (Cập nhật lúc: {{ $chapter->updated_at }})</h4>
            </div>
            <div class="row">
                <div class="col d-flex justify-content-center">
                    <p class="text-center">Nếu không xem được truyện vui lòng đổi "SERVER HÌNH" bên dưới</p>
                </div>
            </div>
            <div class="row">
                <div class="col d-flex justify-content-center mx-2 mb-4">
                    <button type="button" class="btn btn-success mx-2">Sever 1</button>
                    <button type="button" class="btn btn-primary mx-2">Sever 2</button>
                    <button type="button" class="btn btn-primary mx-2">Sever 3</button>
                    <button type="button" class="btn btn-primary mx-2">Sever 4</button>
                </div>
            </div>
            <div class="row">
                <div class="col d-flex flex-column align-items-center mb-4">
                    <button type="button" class="btn btn-warning">Báo Lỗi Chương</button>
                    <p class=" mt-4">Sử dụng mũi tên trái (←) hoặc phải (→) để chuyển chapter</p>
                </div>
            </div>
            <div class="col d-flex justify-content-center mx-2 mb-4">
                    @if($previousChapter)
                        <button type="button" class="btn btn-success mx-2 mb-4" ><a href="{{ route('chapter_detail', [$previousChapter->chapter_id]) }}" class="btn btn-info mx-2">Chap Trước</a></button>
                    @else
                        <button type="button" class="btn btn-danger mx-2 mb-4" disabled>Chap Trước</button>
                    @endif
                    @if($nextChapter)
                        <button type="button" class="btn btn-success mx-2 mb-4" ><a href="{{ route('chapter_detail', [$nextChapter->chapter_id]) }}" class="btn btn-info mx-2">Chap Sau</a></button>
                    @else
                        <button type="button" class="btn btn-danger mx-2 mb-4" disabled>Chap Sau</button>
                    @endif
                
            </div>

        </div>

        <div class="container my-4">
            @foreach ($gallery as $gall)
                <div class="row">
                    <img src="{{ asset('images/chapter/' . $gall->gallery_name) }}" alt="" class="img-fluid mb-4">
                </div>
            @endforeach
        </div>

        <div class="container chapter_direct mt-4 mb-4">
            <div class="row mx-2 mb-4 mt-4">
                <h5 class='mt-3'>
                    <a class='mt-3' href="{{ asset('/') }}">Trang Chủ</a> /
                    <a class='mt-3' href="{{ route('manga_detail', [$chapter->manga_id]) }}">{{ $chapter->manga_name }}</a> /
                    {{ $chapter->chapter_name }}
                </h5>
            </div>
            <div class="col d-flex justify-content-center mx-2 mb-4">
                    @if($previousChapter)
                        <button type="button" class="btn btn-success mx-2 mb-3" ><a href="{{ route('chapter_detail', [$previousChapter->chapter_id]) }}" class="btn btn-info mx-2">Chap Trước</a></button>
                    @else
                        <button type="button" class="btn btn-danger mx-2 mb-3" disabled>Chap Trước</button>
                    @endif
                    @if($nextChapter)
                        <button type="button" class="btn btn-success mx-2 mb-3" ><a href="{{ route('chapter_detail', [$nextChapter->chapter_id]) }}" class="btn btn-info mx-2">Chap Sau</a></button>
                    @else
                        <button type="button" class="btn btn-danger mx-2 mb-3" disabled>Chap Sau</button>
                    @endif
                
            </div>
        </div>

        <div class="container my-4 chapter_direct">
            <div class="row mt-4">
                <div class="container mb-4 mt-4">
                    <h4>Bình Luận</h4>
                    <p>Vào Fanpage like và theo dõi để ủng hộ TruyenQQ nhé.</p>
                    <div class="row">
                        <input type="text" placeholder="Vào Fanpage like và theo dõi để ủng hộ TruyenQQ nhé." class="form-control">
                    </div>
                    <div class="row mt-4">
                        <div class="col-1">
                            <img src="{{ asset('images/image.png') }}" style="width:100px; height:100px; border-radius:50%;" alt="Image 1" class="img-fluid">
                        </div>
                        <div class="col-11">
                            <h5>sấdasd</h5>
                            <div style="width: 100%; height: 1px; background-color: black;"></div>
                            <p>má pháp sư cầm cưa đánh nhau hay gì</p>
                            <div class="row">
                                <div class="col-1">
                                    <i class="fa-solid fa-thumbs-up"></i>
                                </div>
                                <div class="col-1">
                                    <i class="fa-regular fa-comment"></i>
                                </div>
                                <div class="col">
                                    <p>1 tháng trước</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>       
            </div>
        </div>
    </div>  
</div>  
@endsection
