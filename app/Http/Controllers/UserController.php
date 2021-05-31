<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function getList(){
        $user = User::all();
        return view('admin.user.list',['user'=>$user]);
    }

    public function getDelete($id){
        $user = User::find($id);
        $user->delete();
        return redirect()->route('usergetlist')->with('thongbao','Bạn đã xóa user '.$user->email.' thành công');
    }

    public function getAdd(){
        return view('admin.user.add');
    }

    public function postAdd(Request $request){
        $this->validate($request,[
            'ten'=> 'required|min:4',
            'email' => 'required|unique:users,email|email',
            'password' => 'required|min:6',
            'passwordAgain' => 'required|same:password'
        ],
        [
            'ten.required' => 'Bạn chưa nhập tên user',
            'ten.min' => 'Tên user phải có ít nhất 4 ký tự',
            'email.required' => 'Bạn chưa nhập email',
            'email.unique' => 'Email đã tồn tại',
            'email.email' => 'Bạn chưa nhập đúng định dạng email',
            'password.required' => 'Bạn chưa nhập mật khẩu',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            'passwordAgain.required' => 'Bạn chưa nhập lại mật khẩu',
            'passwordAgain.same' => 'Mật khẩu nhập lại không khớp'
        ]);

        $user = new User();
        $user->name = $request->ten;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->level = $request->level;
        $user->save();
        return redirect()->route('usergetadd')->with('thongbao','Bạn đã thêm user thành công');
    }



    public function getEdit($id){
        $user = User::find($id);
        return view('admin.user.edit',['user'=>$user]);
    }

    public function postEdit(Request $request,$id){
        $this->validate($request,[
            'ten'=> 'required|min:4',

        ],
        [
            'ten.required' => 'Bạn chưa nhập tên user',
            'ten.min' => 'Tên user phải có ít nhất 4 ký tự',

        ]);

        $user = User::find($id);
        $user->name = $request->ten;

        $user->level = $request->level;
        if ($request->changePassword == "on")
        {
             $this->validate($request,[
            'password' => 'required|min:6',
            'passwordAgain' => 'required|same:password'
        ],
        [
            'password.required' => 'Bạn chưa nhập mật khẩu',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            'passwordAgain.required' => 'Bạn chưa nhập lại mật khẩu',
            'passwordAgain.same' => 'Mật khẩu nhập lại không khớp'
        ]);
        $user->password = bcrypt($request->password);

        }
        $user->save();
        return redirect()->route('usergetedit',['id'=>$id])->with('thongbao','Bạn đã sửa user thành công');

    }
    public function getLoginAdmin(){
        return view('admin.login');
    }
    public function postLoginAdmin(Request $request){
        $this->validate($request,
        [
            'email' => 'required',
            'password'=> 'required'
        ],
        [
            'email.required' => 'Bạn chưa nhập email',
            'password.required' => 'Bạn chưa nhập password'
        ]);
        $credentials = $request->only('email','password');
        if(Auth::attempt($credentials))
        {
            return redirect()->route('tlgetlist');
        }
        else{
            return redirect('admin/login')->with('thongbao','Sai tên đăng nhập hoặc mật khẩu');
        }
    }
    public function getLogout(){
        Auth::logout();
        return redirect('admin/login');
    }
}
