<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }
    public function login()
    {
        return view('admin.login');
    }
    public function postlogin(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ], [
            'username.required' => 'Bạn chưa nhập username',
            'password.required' => 'Bạn chưa nhập password',

        ]);

        $username = $request->get('username');
        $pass = $request->get('password');

        if (Auth::attempt(['name' => $username, 'password' => $pass])) {
            return redirect()->to('admin');
        } else {
            return redirect('admin/login')->with('thongbao', 'Đăng nhập không thành công');
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect('admin/login');
    }
    public function taikhoan()
    {
        return view('admin.quanlytaikhoan.thongtintaikhoan');
    }
    public function posttaikhoan(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'email' => 'email'

        ], [
            'name.required' => 'Bạn chưa nhập tên ',
            'name.min' => 'Tên phải có ít nhất 3 ký tự',
            'email.email' => 'Bạn chưa nhập đúng định dạng email'
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        if (Auth::user()->image != '') {
            if ($request->anh != '') {
                $Hinh = $request->anh;
                if ($request->hasFile('anh')) {
                    $file = $request->file('anh');

                    $duoi = $file->getClientOriginalExtension();//lay ten duoi
                    if ($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg' && $duoi != 'PNG' && $duoi != 'JPEG' && $duoi != 'JPG') {
                        return redirect()->back()->with('thongbao', 'Đuôi file phải là jpg hoặc png hoặc jpeg');
                    }
                    $name = $file->getClientOriginalName();//lay ten hinh
                    $Hinh = $name;
                    while (file_exists("images/" . $Hinh)) {
                        return redirect()->back()->with('thongbao', 'Hình ảnh đã tồn tại');
                    }
                    $file->move('images', $Hinh);

                    unlink('images/' . Auth::user()->image);
                }
            } else {
                $Hinh = Auth::user()->image;
            }
        } else {
            if ($request->hasFile('anh')) {
                $file = $request->file('anh');
                $duoi = $file->getClientOriginalExtension();//lay ten duoi
                if ($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg' && $duoi != 'PNG' && $duoi != 'JPEG' && $duoi != 'JPG') {
                    return redirect()->back()->with('thongbao', 'Đuôi file phải là jpg hoặc png hoặc jpeg');
                }
                $name = $file->getClientOriginalName();//lay ten hinh
                $Hinh = $name;
                while (file_exists("images/" . $Hinh)) {
                    return redirect()->back()->with('thongbao', 'Hình ảnh đã tồn tại');
                }
                $file->move('images', $Hinh);
            } else {
                $Hinh = null;
            }
        }
        if ($Hinh != null) {
            $user->image = "images/" . $Hinh;
        } else {
            $user->image = $Hinh;
        }
        if ($request->changePassword == "on") {
            $this->validate($request, [

                'password' => 'required|min:3|max:32',
                'passwordAgain' => 'required|same:password'
            ], [

                'password.required' => 'Bạn chưa nhập mật khẩu',
                'password.min' => 'Mật khẩu phải có ít nhất 3 ký tự',
                'password.max' => 'Mật khẩu tối đa 32 ký tự',
                'passwordAgain.required' => 'Bạn chưa nhập lại mật khẩu',
                'passwordAgain.same' => 'Mật khẩu nhập lại chưa khớp'
            ]);
            $user->password = Hash::make($request->password);
        }

        $user->save();
        return redirect()->back()->with('thongbao', 'Sửa thành công');

    }
}
