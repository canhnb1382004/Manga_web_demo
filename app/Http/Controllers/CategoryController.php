<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use Reflector;
use Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $categories = category::orderBy('category_id','ASC')->paginate(10);
        return view("admin.category.index", compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.category.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $data = $request->validate([
        "category_name" =>"required|unique:category",
         "category_description" => "required"
       ]);
       $category = new category();
       $category->category_name = $data['category_name'];
       $category->category_description = $data['category_description'];
       $category->save();
       return redirect()->route('category.index');
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
    public function edit(Request $request,string $category_id)
    {
        $category = category::find($category_id);
        return view("admin.category.edit",compact('category')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $category_id)
    {
        $data = $request->validate([
            "category_name" =>"required|unique:category",
             "category_description" => "required"
           ]);
           
           $category =  category::find($category_id);
           $category->category_name = $data['category_name'];
           $category->category_description = $data['category_description'];
           $category->save();
           return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $category_id )
    {
        $categories = category::find($category_id);
        $categories->delete();
        return redirect()->route('category.index');
    }
}
