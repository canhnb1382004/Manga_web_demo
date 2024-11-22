<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = user::orderBy('id','ASC')->paginate(10);
        return view('admin.user.index' , compact('users'));
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
        $user = new User();
        $user->name = $data['account_name'];
        $user->email = $data['account_email'];
        $user->password = Hash::make($data['account_password']); // Mã hóa mật khẩu
        
        
    if ($request->hasFile('account_avatar')) {
        $image = $request->file('account_avatar');
        $path = 'public/images/user';
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $image->move($path, $filename);
        $user->avatar = $filename;
    }

    $user->save();
    return redirect()->route('login');
        
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
        // Tìm người dùng dựa trên ID
        $user = User::findOrFail($id);

        // Cập nhật role dựa trên giá trị từ form
        $user->role = $request->input('role');
        
        // Lưu thay đổi
        $user->save();

        // Chuyển hướng với thông báo thành công
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
