<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Manga;
use App\Models\Chapter;
use App\Models\User;
use App\Models\Gallery;
use Illuminate\Support\Facades\Hash;

class PageController extends Controller
{
    public function home()
    {
        $manga = Manga::where('manga_status', 'Đang Cập Nhật')
            ->orderBy('manga_id', 'DESC')
            ->get();
        $manga1 = Manga::where('manga_status', 'Hoàn Thành')
            ->orderBy('manga_id', 'DESC')
            ->get();
        $manga2 = Manga::orderBy('manga_like', 'desc')->take(6)->get();

        return view("page.home", compact('manga', 'manga1', 'manga2'));
    }

    public function manga_detail($manga_id)
{
    // Lấy manga cùng với các thông tin cần thiết
    $manga = Manga::with(['categories', 'comments' => function ($query) {
        // Lấy các bình luận gốc (reply_to là null)
        $query->whereNull('reply_to')
              ->with(['replies' => function ($query) {
                  // Lấy các câu trả lời cho bình luận gốc
                  $query->orderBy('created_at', 'asc');
              }]);
    }])->where('manga_id', $manga_id)->firstOrFail();
    
    // Lấy tất cả các chương của manga
    $chapter = Chapter::where('manga_id', $manga_id)->get();
    
    // Lấy chương đầu tiên của manga
    $firstChapter = $chapter->first();
    
    // Tính tổng số bình luận
    $totalComments = $manga->comments->count();

    return view("page.manga_detail", compact('manga', 'chapter', 'firstChapter', 'totalComments'));
}

    public function chapter_detail($chapter_id)
    {
        $chapter = Chapter::where('chapter_id', $chapter_id)->first();
        if (!$chapter) {
            abort(404);
        }

        $manga_id = $chapter->manga_id;
        $previousChapter = Chapter::where('manga_id', $manga_id)
            ->where('chapter_id', '<', $chapter_id)
            ->orderBy('chapter_id', 'desc')
            ->first();

        $nextChapter = Chapter::where('manga_id', $manga_id)
            ->where('chapter_id', '>', $chapter_id)
            ->orderBy('chapter_id', 'asc')
            ->first();

        $gallery = Gallery::where('chapter_id', $chapter_id)->get();

        return view("page.chapter_detail", compact('gallery', 'chapter', 'previousChapter', 'nextChapter'));
    }

    public function category_detail($category_id)
    {
        $category = Category::with('mangas')->findOrFail($category_id);
        $manga = $category->mangas;

        return view("page.category_detail", compact('category', 'manga'));
    }

    public function login()
    {
        return view("page.login");
    }

    public function register()
    {
        return view("page.register");
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $manga = Manga::where('manga_name', 'LIKE', '%' . $search . '%')->get();

        return view('page.search_result', compact('manga', 'search'));
    }

    public function check_account(Request $request)
    {
        $data = $request->only(['name', 'email']);
        $user = User::where('name', $data['name'])
            ->where('email', $data['email'])
            ->first();

        if ($user) {
            return redirect()->route('show_reset_password', ['user_id' => $user->id]);
        } else {
            return redirect()->route('check_info')->withErrors([
                'login_error' => 'Tên hoặc Email không đúng.',
            ]);
        }
    }

    public function reset_password(Request $request, $user_id)
    {
        $data = $request->validate([
            'new_password' => 'required|min:8',
            'new_password_again' => 'required',
        ]);

        if ($data['new_password'] !== $data['new_password_again']) {
            return redirect()->route('show_reset_password', ['user_id' => $user_id])
                ->withErrors([
                    'password_error' => 'Hai mật khẩu phải giống nhau.',
                ])
                ->withInput();
        }

        $user = User::find($user_id);
        $user->password = Hash::make($data['new_password']);
        $user->save();

        return redirect()->route('login')->with('success', 'Mật khẩu đã được cập nhật');
    }

    public function check_info()
    {
        return view('page.check_info');
    }

    public function showResetPasswordForm($user_id)
    {
        $user = User::findOrFail($user_id);
        return view('page.reset_password', compact('user'));
    }
}
