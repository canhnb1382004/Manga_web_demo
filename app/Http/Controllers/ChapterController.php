<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\manga;
use App\Models\chapter;
use App\Models\gallery;
class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
{
    // Tạo một query ban đầu để có thể áp dụng tìm kiếm nếu có từ khóa
    $query = chapter::with('manga')->orderBy('chapter_id', 'DESC');

    // Kiểm tra nếu request có từ khóa tìm kiếm
    if ($request->has('search') && $request->search != '') {
        $searchTerm = $request->search;
        
        // Tìm kiếm theo tên chapter hoặc tên truyện (manga)
        $query->where('chapter_name', 'LIKE', '%' . $searchTerm . '%')
              ->orWhereHas('manga', function ($q) use ($searchTerm) {
                  $q->where('manga_name', 'LIKE', '%' . $searchTerm . '%');
              });
    }

    // Thực hiện phân trang
    $chapter = $query->paginate(10);

    // Lấy toàn bộ gallery, không phân trang (hoặc có thể thêm điều kiện tùy ý)
    $gallery = gallery::orderBy('chapter_id', 'ASC')->get();

    // Trả về view với các dữ liệu cần thiết
    return view("admin.chapter.index", compact('chapter', 'gallery'));
}



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $manga = manga::orderBy('manga_id','ASC')->get();
        
        return view("admin.chapter.create",compact('manga'));
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
        
        // Tạo đối tượng Chapter mới
        $chapter = new Chapter();
        $chapter->chapter_name = $data['chapter_name'];
        $chapter->manga_name = $data['manga_name'];
        $chapter->manga_id = $data['manga_id'];

        // Lưu ảnh chính của chapter nếu có
       

        // Lưu chapter vào cơ sở dữ liệu
         $chapter->save();

        // Kiểm tra và lưu nhiều ảnh vào bảng gallery
        if ($request->hasFile('gallery_images')) {
          
            foreach ($request->file('gallery_images') as $image) {
                if ($image->isValid()) {  // Kiểm tra file hợp lệ
                    
                    $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('images/chapter'), $filename);
                    
                    // Tạo gallery mới với đường dẫn ảnh
                    gallery::create([
                        'gallery_name' => $filename,           // Lưu đường dẫn ảnh
                        'chapter_id' => $chapter->chapter_id,  // Liên kết với chapter
                    ]);
                }
            }
        }
       
        return redirect()->route('chapter.index')->with('success', 'Chapter và ảnh đã được lưu thành công!');
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
    public function edit(Request $request,string $chapter_id)
    {
       $chapter = chapter::find($chapter_id);
       $manga = manga::orderBy('manga_id','ASC')->get();
       return view("admin.chapter.edit",compact('chapter','manga'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$chapter_id)
    {
        $data = $request->all();

        // Tạo đối tượng Manga mới
        $chapter =  chapter::find($chapter_id);
        $chapter->chapter_name = $data['chapter_name'];
        $chapter->manga_name = $data['manga_name'];
       
        $chapter->save();
    
        return redirect()->route('chapter.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $chapter_id)
    {
        $chapter = chapter::find($chapter_id);    
        $gallery = gallery::where('chapter_id',$chapter_id );    
       
        $chapter->delete();
        $gallery->delete();
        return redirect()->route('chapter.index'); 
    }
}
