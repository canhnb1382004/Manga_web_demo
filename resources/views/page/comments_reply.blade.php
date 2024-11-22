@foreach($replies as $reply)
    <div class="mt-3" style="padding-left: 40px;">
        <div class="row">
            <div class="col-1">
                <img src="{{ asset('public/images/user/' . $reply->user->avatar) }}" 
                     style="width:50px; height:50px; border-radius:50%;" 
                     alt="User Avatar" class="img-fluid">
            </div>
            <div class="col-11">
                <h6>
                    {{ $reply->user->name }}
                    @if($reply->reply_to && $reply->parentComment)
                        <small style="font-weight: normal; color: gray;">
                            đang trả lời {{ $reply->parentComment->user->name }}
                        </small>
                    @endif
                </h6>
                <div style="width: 100%; height: 1px; background-color: black;"></div>
                <p>{{ $reply->content }}</p>
                
                <div class="row">
                    <div class="col-1">
                        <p><i class="fa-solid fa-thumbs-up" style="font-size: 10px;"></i> {{ $reply->likes }}</p>
                    </div>
                    <div class="col-2">
                        <p><i class="fa-regular fa-comment" style="font-size: 10px;"></i> 
                            <a href="javascript:void(0);" onclick="showReply('{{ $reply->id }}')">Trả Lời</a>
                        </p>
                    </div>
                    <div class="col-4">
                        <p>{{ $reply->created_at->diffForHumans() }}</p>
                    </div>
                </div>

                <!-- Form trả lời cho từng bình luận -->
                <div id="reply-form-{{ $reply->id }}" style="display: none; margin-top: 10px;">
                    <form action="{{ route('comment.reply', $reply->id) }}" method="POST">
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
                                <button type="button" class="btn btn-primary mt-2" onclick="alertAndRedirect()">Gửi bình luận</button>
                            </div>    
                        @endif
                    </form>
                </div>
            </div>

            <!-- Hiển thị các câu trả lời của câu trả lời (reply của reply) -->
            @include('page.comments_reply', ['replies' => $reply->replies])
        </div>
    </div>
@endforeach

<!-- Script JavaScript hiển thị form trả lời -->
<script>
    function showReply(replyId) {
        const replyForm = document.getElementById(`reply-form-${replyId}`);
        if (replyForm) {
            replyForm.style.display = 'block'; // Hiển thị form trả lời
        }
    }

    function alertAndRedirect() {
        alert('Vui lòng đăng nhập để bình luận.');
        window.location.href = "{{ asset('/login') }}";
    }
</script>
