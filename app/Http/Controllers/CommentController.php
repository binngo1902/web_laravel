<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\TinTuc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    //
    public function getDelete($id,$idTinTuc){
        $comment = Comment::find($id);
        $comment->delete();
        return redirect()->route('ttgetedit',['id'=>$idTinTuc])->with('thongbao','Đã xóa comment thành công');
    }

    public function postComment(Request $request,$id){

        $comment = new Comment();
        $tintuc = TinTuc::find($id);
        $comment->idTinTuc = $id;
        $comment->idUser = Auth::user()->id;
        $comment->NoiDung = $request->NoiDung;
        $comment->save();
        return redirect('tintuc/'.$id.'/'.$tintuc->TieuDeKhongDau.'.html');
    }
}
