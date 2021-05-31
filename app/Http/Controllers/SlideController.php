<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use DateTime;
use Illuminate\Http\Request;
use Image;

class SlideController extends Controller
{
    //
    public function getList(){
        $slide = Slide::all();
        return view('admin.slide.list',['slide'=>$slide]);
    }

    public function getEdit($id){
        $slide = Slide::find($id);
        return view('admin.slide.edit',['slide'=>$slide]);
    }

    public function postEdit(Request $request,$id){
        $slide = Slide::find($id);
        $this->validate($request,
        [
            'Ten' => 'required|unique:Slide,Ten|min:3|max:100',
            'NoiDung'=>'required|min:10',
            'Hinh' => 'mimes:png,jpeg,jpg',
            'Link' => 'required',
        ],
        [
            'Ten.required' => 'Bạn chưa nhập tên',
            'Ten.unique' => 'Tên bạn nhập đã tồn tại',
            'Ten.min' => 'Tên phải có độ dài từ 3 đến 100 ký tự',
            'Ten.max' => 'Tên phải có độ dài từ 3 đến 100 ký tự',
            'NoiDung.required' => 'Bạn chưa nhập nội dung',
            'NoiDung.min' => 'Nội dung phải có độ dài từ 10 ký tự',
            'Link.required' => 'Bạn chưa nhập Link',
            'Link.url' => 'Link bạn nhập không phù hợp',
            'Hinh.mimes'=> 'Hình phải có đuôi là png,jpeg,jpg',

        ]);
        $slide->Ten = $request->Ten;
        $slide->NoiDung = $request->NoiDung;
        $slide->link = $request->Link;
        if ($request->hasFile('Hinh'))
        {
            unlink("upload/slide/".$slide->Hinh);
            $file = $request->file('Hinh');
            $name = $file->getClientOriginalName();
            $Hinh = time()."_".$name;
            $img = Image::make($file->getRealPath())->resize(800,300)->save("upload/slide".$Hinh);

            // while(file_exists("t/upload/tintuc".$Hinh))
            // $request->file('Hinh')->move("upload/slide",$Hinh);
            $slide->Hinh = $Hinh;


        }
        $slide->updated_at = new DateTime();
        $slide->save();
        return redirect()->route('slidegetlist')->with('thongbao','Đã sửa slide thành công.');

    }

    public function getAdd(){
        return view('admin.slide.add');
    }

    public function postAdd(Request $request){
        $this->validate($request,
        [
            'Ten' => 'required|unique:Slide,Ten|min:3|max:100',
            'NoiDung'=>'required|min:10',
            'Hinh' => 'mimes:png,jpeg,jpg',
            'Link' => 'required',
        ],
        [
            'Ten.required' => 'Bạn chưa nhập tên',
            'Ten.unique' => 'Tên bạn nhập đã tồn tại',
            'Ten.min' => 'Tên phải có độ dài từ 3 đến 100 ký tự',
            'Ten.max' => 'Tên phải có độ dài từ 3 đến 100 ký tự',
            'NoiDung.required' => 'Bạn chưa nhập nội dung',
            'NoiDung.min' => 'Nội dung phải có độ dài từ 10 ký tự',
            'Link.required' => 'Bạn chưa nhập Link',
            'Link.url' => 'Link bạn nhập không phù hợp',
            'Hinh.mimes'=> 'Hình phải có đuôi là png,jpeg,jpg',

        ]);
        $slide = new Slide();
        $slide->Ten = $request->Ten;
        $slide->NoiDung = $request->NoiDung;
        $slide->link = $request->Link;
        if ($request->hasFile('Hinh'))
        {
            $file = $request->file('Hinh');
            $name = $file->getClientOriginalName();
            $Hinh = time()."_".$name;
            // while(file_exists("t/upload/tintuc".$Hinh))
            $request->file('Hinh')->move("upload/slide",$Hinh);
            $slide->Hinh = $Hinh;
        }
        else{
            $slide->Hinh = "";
        }
        $slide->created_at = new DateTime();
        $slide->save();
        return redirect()->route('slidegetadd')->with('thongbao','Đã thêm slide thành công.');

    }
    public function getDelete($id){
        $slide = Slide::find($id);
        if (file_exists('upload/slide/'.$slide->Hinh))
        {
            unlink("upload/slide/".$slide->Hinh);
        }
        $slide->delete();
        return redirect()->route('slidegetlist')->with('thongbao','Bạn đã xóa Slide '.$slide->Ten.' thành công');
    }


}
