<?php

namespace App\Http\Controllers;

use App\Models\LoaiTin;
use App\Models\TheLoai;
use App\Models\TinTuc;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function trangchu(){
        return view('pages.trangchu');
    }

    public function lienhe(){
        return view('pages.lienhe');
    }
    public function loaitin($id){
        $loaitin = LoaiTin::find($id);
        $tintuc = TinTuc::where('idLoaiTin',$id)->paginate(5);
        return view('pages.loaitin',['loaitin'=>$loaitin,'tintuc'=>$tintuc]);
    }

    public function tintuc($id)
    {
        $tintuc = TinTuc::find($id);
        $noibat = TinTuc::where('NoiBat',1)->take(4)->get();
        $lienquan = TinTuc::where('idLoaiTin',$tintuc->idLoaiTin)->take(4)->get();
        return view('pages.tintuc',['tintuc'=>$tintuc,'noibat'=>$noibat,'lienquan'=>$lienquan]);
    }

    public function getLogin(){
        return view('pages.login');
    }

    public function postLogin(Request $request){
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
            return redirect('trangchu');
        }
        else{
            return redirect('login')->with('thongbao','Sai tên đăng nhập hoặc mật khẩu');
        }
    }

    public function getLogout(){
        Auth::logout();
        return redirect('trangchu');
    }

    public function getAccount(){

        return view('pages.accountdetail');
    }

    public function postAccount(Request $request){
        $this->validate($request,[
            'ten'=> 'required|min:4',

        ],
        [
            'ten.required' => 'Bạn chưa nhập tên user',
            'ten.min' => 'Tên user phải có ít nhất 4 ký tự',

        ]);
        $id = Auth::user()->id;
        $user = User::find($id);
        $user->name = $request->ten;

        if ($request->checkpassword == "on")
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
        return redirect('account')->with('thongbao','Bạn đã sửa user thành công');

    }
    public function getRegister(){
        if (Auth::check())
        {
            return redirect('trangchu');
        }
        return view('pages.register');
    }

    public function postRegister(Request $request){
        $this->validate($request,
        [
            'ten' => 'required|min:4',
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
        $user->namef = $request->ten;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->level = 0;
        $user->created_at = new DateTime();
        $user->save();
        return redirect('register')->with('thongbao','Bạn đã đăng ký thành công');

    }

    public function timkiem(Request $request){
        $tukhoa = $request->timkiem;
        $tintuc = TinTuc::where('TieuDe','like',"%$tukhoa%")->orwhere('TomTat','like',"%$tukhoa%")
        ->orwhere('NoiDung','like',"%$tukhoa%")->take(30)->paginate(5);
        return view('pages.timkiem',['tintuc'=>$tintuc,'tukhoa'=>$tukhoa]);
    }
}
