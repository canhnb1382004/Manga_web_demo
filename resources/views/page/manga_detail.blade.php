@extends('page.layout')

@section('content')
<style>
    .list {
        max-height: 300px;
        overflow-y: auto;
    }
    .list .row1 {
        height: 20px;
    }
</style>

<div style="background-color: #f0f0f0; padding: 20px;">
    <div class="container content_chapter" style="background-color: #fff; padding: 20px; border-radius: 8px;">
        
        <!-- Manga Information Section -->
        <div class="container chapter">
            <div class="row">
                <div class="col">
                    <h5>
                        <a href="{{ asset('/') }}">Trang Chủ</a> / {{ $manga->manga_name }}
                    </h5>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-2">
                    <img src="{{ asset('public/images/manga/' . $manga->manga_img) }}" alt="Image 1" class="img-fluid">
                </div>
                <div class="col-10">
                    <h3>{{ $manga->manga_name }}</h3>
                    <p><strong>Tên Khác:</strong> {{ $manga->manga_othername }}</p>
                    <p><strong>Tác giả:</strong> {{ $manga->manga_author }}</p>
                    <p><strong>Tình trạng:</strong> {{ $manga->manga_status }}</p>
                    <p><strong>Lượt thích:</strong> {{ $manga->manga_like }}</p>
                    
                    <div class="mt-3">
                        @foreach ($manga->categories as $category)
                            <a href="{{ route('category_detail', [$category->category_id]) }}">
                                <button type="button" class="btn btn-outline-warning">{{ $category->category_name }}</button>
                            </a>
                        @endforeach
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-3">
                        <div class="container">
                            <div class="row">
                                <div class="col-2">
                                    @if($firstChapter)
                                        <button type="button" class="btn btn-success">
                                            <a href="{{ route('chapter_detail', [$firstChapter->chapter_id]) }}">Đọc Từ Đầu</a>
                                        </button>
                                    @else
                                        <button type="button" class="btn btn-success" disabled>Đọc Từ Đầu</button>
                                    @endif
                                </div>
                                <div class="col-1">
                                    @auth
                                        <form action="{{ route('manga.like', $manga->manga_id) }}" method="POST" id="like-form">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Thích</button>
                                        </form>
                                    @else
                                        <button type="button" class="btn btn-danger" onclick="alert('Bạn cần đăng nhập để thích manga này.')">Thích</button>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Manga Description Section -->
            <div class="row mt-4">
                <h5 style="color:orange;"><i class="fa-solid fa-info" style="font-size: 22px;"></i> Giới Thiệu</h5>
                <p>{{ $manga->manga_description }}</p>
            </div>

            <!-- Chapter List Section -->
            <div class="row mt-4">
                <h5 style="color:orange;"><i class="fa-solid fa-list" style="font-size: 22px;"></i> Danh Sách Chương</h5>
                <div class="list">
                    @foreach ($chapter as $chap)
                        <a href="{{ route('chapter_detail', [$chap->chapter_id]) }}">
                            <div class="row row1">
                                <div class="col">{{ $chap->chapter_name }}</div>
                                <div class="col">{{ $chap->created_at->diffForHumans() }}</div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Comments Section -->
            <div class="row mt-4">
                <h5 style="color:orange;"><i class="fa-solid fa-comments" style="font-size: 22px;"></i> Bình Luận ({{ $totalComments }})</h5>
                <p>Vào Fanpage like và theo dõi để ủng hộ TruyenQQ nhé.</p>

                <!-- Comment Form -->
                <form action="{{ route('comment.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <textarea name="content" class="form-control" style="height:100px; margin:10px 0px;" placeholder="Nhập bình luận của bạn..."></textarea>
                        <input type="hidden" name="manga_id" value="{{ $manga->manga_id }}">
                    </div>
                    @if(Auth::check())
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Gửi bình luận</button>
                        </div>
                    @else
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-primary" onclick="alertAndRedirect()">Gửi bình luận</button>
                        </div>    
                    @endif
                </form>

                

                <!-- Display Comments and Replies -->
                @foreach($manga->comments as $comment)
                    <!-- Original Comment -->
                    <div class="container">
                        <div class="row">
                            <div class="col-11 row mt-4" style="background-color: #f8f9fa; border: 1px solid #ddd; padding: 15px; border-radius: 8px;">
                                <div class="col-1">
                                    <img src="{{ asset('public/images/user/' . $comment->user->avatar) }}" style="width:50px; height:50px; border-radius:50%;" alt="User Avatar" class="img-fluid">
                                </div>
                                <div class="col-11">
                                    <h5>{{ $comment->user->name }}</h5>
                                    <div style="width: 100%; height: 1px; background-color: black;"></div>
                                    <p>{{ $comment->content }}</p>
                                    <div class="row">
                                        <div class="col-1">
                                            <p><i style="font-size: 10px;" class="fa-solid fa-thumbs-up"></i> {{ $comment->likes }}</p>
                                        </div>
                                        <div class="col-2">
                                            <p><i style="font-size: 10px;" class="fa-regular fa-comment"></i> 
                                                <a href="javascript:void(0);" onclick="showReplyForm('{{ $comment->id }}')">Trả Lời</a>
                                            </p>
                                        </div>
                                        <div class="col-2">
                                            <p>{{ $comment->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>

                                    <!-- Reply Form -->
                                    <div id="reply-form-{{ $comment->id }}" style="display: none; margin-top: 10px;">
                                        <form action="{{ route('comment.reply', $comment->id) }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <textarea name="reply_content" class="form-control" placeholder="Nhập câu trả lời của bạn" required></textarea>
                                            </div>
                                            @if(Auth::check())
                                                <div class="d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-primary mt-2">Gửi trả lời</button>
                                                </div>
                                            @else
                                                <div class="d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-primary mt-2" onclick="alertAndRedirect()">Gửi bình luận</button>
                                                </div>    
                                            @endif
                                            
                                        </form>
                                    </div>

                                    <!-- Display Replies -->
                                    @include('page.comments_reply', ['replies' => $comment->replies])
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <script>
                    function showReplyForm(commentId) {
                        const replyForm = document.getElementById(`reply-form-${commentId}`);
                        replyForm.style.display = 'block'; // Hiển thị form trả lời
                    }
                    function alertAndRedirect() {
                        alert('Vui lòng đăng nhập để bình luận.');
                        window.location.href = "{{ asset('/login') }}";
                    }
                </script>
            </div>
        </div>
    </div>
</div>
@endsection
