<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TheLoai;

class TheLoaiController extends Controller
{
    //

    public function getAdd(){
        return view('admin.theloai.add');

    }

    public function getEdit($id){
        $theloai = TheLoai::find($id);

        return view('admin.theloai.edit',['theloai'=>$theloai]);

    }

    public function postEdit(Request $request,$id){
        $theloai = TheLoai::find($id);
        $this->validate($request,
            [
                'Ten' => 'required|unique:TheLoai,Ten|min:3|max:50'
            ],
            [
                'Ten.required' => 'Bạn chưa nhập tên',
                'Ten.unique' => 'Tên thể loại đã tồn tại',
                'Ten.min' => 'Tên thể loại ít nhất 3 ký tự',
                'Ten.max' => 'Tên thể loại nhiều nhất 50 ký tự',
            ]);

        $theloai->Ten = $request->Ten;
        $theloai->TenKhongDau = changeTitle($request->Ten);
        $theloai->save();

        return redirect('admin/theloai/edit/'.$id)->with('thongbao','Sửa thành công');
    }

    public function getList(){
        $theloai = TheLoai::all();
        return view('admin.theloai.list',['theloai' =>$theloai]);
    }

    public function postAdd(Request $request){
        $this->validate($request,
            [
                'Ten'=> 'required|min:3|max:50|unique:TheLoai,Ten'
            ]
            ,
            [
                'Ten.required' => 'Bạn chưa nhập tên',
                'Ten.unique' => 'Tên thể loại đã tồn tại',

                'Ten.min' => 'Tên thể loại ít nhất 3 ký tự',
                'Ten.max' => 'Tên thể loại nhiều nhất 50 ký tự',
            ]);

        $theloai = new TheLoai();
        $theloai->Ten = $request->Ten;
        $theloai->TenKhongDau = changeTitle($request->Ten);
        $theloai->save();

        return redirect('admin/theloai/add')->with('thongbao','Thêm thành công');
    }

    public function getDelete($id){
        $theloai = TheLoai::find($id);
        $theloai->delete();
        return redirect('admin/theloai/list')->with('thongbao','Xóa thể loại '.$theloai->Ten.' thành công');

    }
}

