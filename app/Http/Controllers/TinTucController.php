<?php

namespace App\Http\Controllers;

use App\Models\LoaiTin;
use App\Models\Slide;
use App\Models\TheLoai;
use App\Models\TinTuc;
use DateTime;
use Illuminate\Http\Request;


class TinTucController extends Controller
{
    //
    public function getList(){
        $tintuc = TinTuc::orderBy('id','DESC')->get();
        return view('admin.tintuc.list',['tintuc'=>$tintuc]);
    }

    public function getDelete($id){
        $tintuc = TinTuc::find($id);
        $tintuc->delete();
        return redirect()->route('ttgetlist')->with('thongbao','Xóa tin tức "'.$tintuc->TieuDe.'" thành công');
    }

    public function getAdd(){
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();
        return view('admin.tintuc.add',['loaitin'=>$loaitin,'theloai'=>$theloai]);
    }

    public function postAdd(Request $request){
        $this -> validate($request,
        [
            'LoaiTin' => 'required',
            'TieuDe' => 'required|unique:TinTuc,TieuDe|min:3|max:100',
            'TomTat' => 'required|min:10| max:200',
            'NoiDung' => 'required|min:10',
            'Hinh' => 'mimes:png,jpeg,jpg',
        ],
        [
            'LoaiTin.required' => 'Bạn chưa chọn loại tin',
            'TieuDe.required' => 'Bạn chưa nhập tiêu đề',
            'TieuDe.min' => 'Tiêu đề có độ dài từ 3 đến 100 ký tự',
            'TieuDe.max' => 'Tiêu đề có độ dài từ 3 đến 100 ký tự',
            'TieuDe.unique' => 'Tên tiêu đề đã tồn tại',
            'TomTat.required' => 'Bạn chưa nhập tóm tắt',
            'TomTat.min' => 'Tóm tắt có độ dài từ 10 đến 200 ký tự',
            'TomTat.max' => 'Tóm tắt có độ dài từ 10 đến 200 ký tự',
            'NoiDung.required'=> 'Bạn chưa nhập nội dung',
            'NoiDung.min' => 'Nội dung có ít nhất 10 ký tự',
            'Hinh.mimes' => 'File bạn chọn phải có đuôi là .png .jpeg .jpg',


        ]);
        $tintuc = new TinTuc();
        $tintuc->TieuDe = $request->TieuDe;
        $tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
        $tintuc->TomTat = $request->TomTat;
        $tintuc->NoiDung = $request->NoiDung;
        $tintuc->NoiBat = $request->NoiBat;
        $tintuc->SoLuotXem = 0;
        $tintuc->idLoaiTin = $request->LoaiTin;
        $tintuc->created_at = new DateTime();
        if ($request->hasFile('Hinh'))
        {
            $file = $request->file('Hinh');
            $name = $file->getClientOriginalName();
            $Hinh = time()."_".$name;
            // while(file_exists("t/upload/tintuc".$Hinh))
            $request->file('Hinh')->move("upload/tintuc",$Hinh);
            $tintuc->Hinh = $Hinh;
        }
        else{
            $tintuc->Hinh = "";
        }
        $tintuc->save();
        return redirect()->route('ttgetadd')->with('thongbao','Bạn đã thêm thành công');

    }

    public function getEdit($id){
        $tintuc = TinTuc::find($id);
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();
        return view('admin.tintuc.edit',['tintuc'=>$tintuc,'theloai'=>$theloai,'loaitin'=>$loaitin]);
    }
    public function postEdit(Request $request,$id){
        $tintuc = TinTuc::find($id);
        $this -> validate($request,
        [
            'LoaiTin' => 'required',
            'TieuDe' => 'required|unique:TinTuc,TieuDe|min:3|max:100',
            'TomTat' => 'required|min:10| max:200',
            'NoiDung' => 'required|min:10',
            'Hinh' => 'mimes:png,jpeg,jpg',
        ],
        [
            'LoaiTin.required' => 'Bạn chưa chọn loại tin',
            'TieuDe.required' => 'Bạn chưa nhập tiêu đề',
            'TieuDe.min' => 'Tiêu đề có độ dài từ 3 đến 100 ký tự',
            'TieuDe.max' => 'Tiêu đề có độ dài từ 3 đến 100 ký tự',
            'TieuDe.unique' => 'Tên tiêu đề đã tồn tại',
            'TomTat.required' => 'Bạn chưa nhập tóm tắt',
            'TomTat.min' => 'Tóm tắt có độ dài từ 10 đến 200 ký tự',
            'TomTat.max' => 'Tóm tắt có độ dài từ 10 đến 200 ký tự',
            'NoiDung.required'=> 'Bạn chưa nhập nội dung',
            'NoiDung.min' => 'Nội dung có ít nhất 10 ký tự',
            'Hinh.mimes' => 'File bạn chọn phải có đuôi là .png .jpeg .jpg',


        ]);
        $tintuc->TieuDe = $request->TieuDe;
        $tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
        $tintuc->TomTat = $request->TomTat;
        $tintuc->NoiDung = $request->NoiDung;
        $tintuc->NoiBat = $request->NoiBat;
        $tintuc->idLoaiTin = $request->LoaiTin;
        $tintuc->updated_at = new DateTime();

        if ($request->hasFile('Hinh'))
        {
            $file = $request->file('Hinh');
            $name = $file->getClientOriginalName();
            $Hinh = time()."_".$name;
            // while(file_exists("t/upload/tintuc".$Hinh))
            $request->file('Hinh')->move("upload/tintuc",$Hinh);
            unlink("upload/tintuc/".$tintuc->Hinh);
            $tintuc->Hinh = $Hinh;
        }

        $tintuc->save();
        return redirect()->route('ttgetedit',['id'=>$id])->with('thongbao','Bạn đã tsửa thành công');

    }
}
