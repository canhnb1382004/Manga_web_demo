<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Manga;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $comment = new comment();
        $comment->content = $data['content'];
        $comment->user_id = Auth::id();
        $comment->manga_id = $request->input('manga_id');;
        
        $comment->save();
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $comment = comment::find($id);
        $comment->delete();
        return Redirect::back();

    }
    public function reply(Request $request, $commentId)
    {
        // Validate nội dung trả lời
        $request->validate([
            'reply_content' => 'required|string|max:500',
        ]);

        // Lấy thông tin của bình luận cha
        $parentComment = Comment::findOrFail($commentId);

        // Tạo mới một bình luận trả lời
        $replyComment = new Comment();
        $replyComment->content = $request->input('reply_content');
        $replyComment->user_id = Auth::id(); // ID người dùng đang trả lời
        $replyComment->manga_id = $parentComment->manga_id; // ID của truyện
        $replyComment->reply_to = $parentComment->id; // Gán ID của bình luận cha

        // Lưu bình luận trả lời vào CSDL
        $replyComment->save();

        // Chuyển hướng lại trang chi tiết truyện hoặc bình luận sau khi trả lời thành công
        return redirect()->back()->with('success', 'Trả lời bình luận thành công!');
    }
}
