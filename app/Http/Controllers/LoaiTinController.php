<?php

namespace App\Http\Controllers;

use App\Models\LoaiTin;
use App\Models\TheLoai;
use Illuminate\Http\Request;

class LoaiTinController extends Controller
{
    //
    public function getList(){
        $loaitin = LoaiTin::all();
        return view('admin.loaitin.list',['loaitin'=>$loaitin]);
    }

    public function getDelete($id){
        $loaitin = LoaiTin::find($id);
        $loaitin->delete();
        return redirect()->route('ltlist')->with('thongbao','Xóa '.$loaitin->Ten.' thành công');
    }

    public function getAdd(){
        $theloai = TheLoai::all();
        return view('admin.loaitin.add',['theloai'=>$theloai]);
    }
    public function postAdd(Request $request){
        $this->validate($request,
        [
            'Ten' => 'required|unique:LoaiTin,Ten|min:3,max:50',
            'TheLoai' => 'required'
        ],
        [
            'Ten.required' => 'Bạn chưa nhập tên',
            'Ten.unique'=> 'Bạn nhập trùng tên',
            'Ten.min'=>'Tên phải có độ dài từ 1 đến 50 ký tự',
            'Ten.max'=>'Tên phải có độ dài từ 1 đến 50 ký tự',
            'TheLoai.required' => 'Bạn chưa chọn thể loại'
        ]);
        $loaitin = new LoaiTin();
        $loaitin->Ten = $request->Ten;
        $loaitin->TenKhongDau = changeTitle($request->Ten);
        $loaitin->idTheLoai = $request->TheLoai;
        $loaitin->save();
        return redirect()->route('ltadd')->with('thongbao','Thêm loại tin thành công');
    }

    public function getEdit($id){
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::find($id);
        return view('admin.loaitin.edit',['loaitin'=>$loaitin,'theloai'=>$theloai]);
    }
    public function postEdit(Request $request,$id){
        $this->validate($request,
        [
            'Ten' => 'required|unique:LoaiTin,Ten|min:3,max:50',
            'TheLoai' => 'required'
        ],
        [
            'Ten.required' => 'Bạn chưa nhập tên',
            'Ten.unique'=> 'Bạn nhập trùng tên',
            'Ten.min'=>'Tên phải có độ dài từ 1 đến 50 ký tự',
            'Ten.max'=>'Tên phải có độ dài từ 1 đến 50 ký tự',
            'TheLoai.required' => 'Bạn chưa chọn thể loại'
        ]);
        $loaitin = LoaiTin::find($id);
        $loaitin->Ten = $request->Ten;
        $loaitin->TenKhongDau = changeTitle($request->Ten);
        $loaitin->idTheLoai = $request->TheLoai;
        $loaitin->save();
        return redirect()->route('ltgetedit',['id'=>$id])->with('thongbao','Đã sửa thành công');
    }

}
