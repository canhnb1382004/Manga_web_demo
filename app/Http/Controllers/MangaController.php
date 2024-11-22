<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\manga;
use App\Models\category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
class MangaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
{
    // Lấy dữ liệu manga cùng với liên kết tới categories và comments
    $manga = Manga::with(['categories', 'comments'])->orderBy('manga_id', 'DESC')->paginate(10);
    
    return view("admin.manga.index", compact("manga"));
}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $category = category::orderBy('category_id','DESC')->get();
        return view("admin.manga.create",compact("category"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    // Lấy tất cả dữ liệu từ request
    $data = $request->all();

    // Tạo đối tượng Manga mới
    $manga = new Manga();
    $manga->manga_name = $data['manga_name'];
    $manga->manga_othername = $data['manga_othername'];
    $manga->manga_author = $data['manga_author'];
    $manga->manga_description = $data['manga_description'];
    $manga->manga_status = $data['manga_status'];

    // Xử lý hình ảnh nếu có
    if ($request->hasFile('manga_img')) {
        $image = $request->file('manga_img');
        $path = 'public/images/manga';
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $image->move($path, $filename);
        $manga->manga_img = $filename;
    }

    // Lưu manga vào cơ sở dữ liệu
    $manga->save();

    // Gán các danh mục đã chọn cho manga qua bảng pivot
    if (isset($data['category_id'])) {
        $manga->categories()->attach($data['category_id']); // Lưu mảng category_id vào bảng pivot
    }

    return redirect()->route('manga.index');
}





    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,string $manga_id)
    {
        $manga = manga::find($manga_id);  
        $category = category::orderBy('category_id','ASC')->get();

        
        return view("admin.manga.edit",compact("manga","category"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request , $manga_id)
    {
        $data = $request->all();
        $manga = manga::find($manga_id);
        $manga->manga_name = $data['manga_name'];
        $manga->manga_othername = $data['manga_othername'];
        $manga->manga_author = $data['manga_author'];
        $manga->manga_description = $data['manga_description'];
        $manga->manga_status = $data['manga_status'];
        
        if ($request->hasFile('manga_img')) {
            $image = $request->file('manga_img');
            $path = 'public/images/manga';
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move($path, $filename);
            $manga->manga_img = $filename;
        }
    
        // Lưu manga vào cơ sở dữ liệu
        $manga->save();
    
        // Gán các danh mục đã chọn cho manga qua bảng pivot
        if (isset($data['category_id'])) {
            $manga->categories()->attach($data['category_id']); // Lưu mảng category_id vào bảng pivot
        }
    
        return redirect()->route('manga.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $manga_id)
    {
        $manga = manga::find($manga_id);    
        $manga->delete();
        return redirect()->route('manga.index'); 
    }
        public function likeManga($manga_id)
    {
        $manga = Manga::findOrFail($manga_id);

        // Tăng số lượng like lên 1
        $manga->increment('manga_like');

        return Redirect::back();
    }

}
