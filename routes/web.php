<?php

use App\Http\Controllers\TinTucController;
use Illuminate\Support\Facades\Route;
use App\Models\TheLoai;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('pages.trangchu');
});
Route::get('/admin',function(){
    return view('admin.login');
});
Route::get('admin/login','UserController@getLoginAdmin');
Route::post('admin/login','UserController@postLoginAdmin');
Route::get('admin/logout','UserController@getLogout');

Route::group(['prefix'=>'admin','middleware'=>'adminLogin'],function (){
    Route::group(['prefix'=>'theloai'],function(){
        Route::get('list','TheLoaiController@getList')->name('tlgetlist');

        Route::get('edit/{id}','TheLoaiController@getEdit')->name('getedit');
        Route::post('edit/{id}','TheLoaiController@postEdit')->name('postedit');


        Route::get('add','TheLoaiController@getAdd');
        Route::post('add','TheLoaiController@postAdd') ->name('postadd');

        Route::get('delete/{id}','TheLoaiController@getDelete')->name('getdelete');
    });

    Route::group(['prefix'=>'loaitin'],function(){
        Route::get('list','LoaiTinController@getList')->name('ltlist');

        Route::get('edit/{id}','LoaiTinController@getEdit')->name('ltgetedit');
        Route::post('edit/{id}','LoaitinController@postEdit')->name('ltpostedit');


        Route::get('add','LoaiTinController@getAdd')->name('ltadd');
        Route::post('add','LoaiTinController@postAdd')->name('ltpostadd');

        Route::get('delete/{id}','LoaiTinController@getDelete')->name('ltgetdelete');
    });

    Route::group(['prefix'=>'tintuc'],function(){
        Route::get('list','TinTucController@getList')-> name('ttgetlist');
        Route::get('edit','TinTucController@getEdit')-> name('ttgetedit');

        Route::get('add','TinTucController@getAdd')->name('ttgetadd');
        Route::post('add','TinTucController@postAdd')->name('ttpostadd');

        Route::get('edit/{id}','TinTucController@getEdit')->name('ttgetedit');
        Route::post('edit/{id}','TinTucController@postEdit')->name('ttpostedit');




        Route::get('delete/{id}','TinTucController@getDelete')->name('ttgetdelete');
    });
    Route::group(['prefix'=>'comment'],function(){
        Route::get('delete/{id}/{idTinTuc}','CommentController@getDelete')->name('cmgetdelete');

    });
//
    Route::group(['prefix'=>'slide'],function(){
        Route::get('list','SlideController@getList')->name('slidegetlist');

        Route::get('edit/{id}','SlideController@getEdit')->name('slidegetedit');
        Route::post('edit/{id}','SlideController@postEdit')->name('slidepostedit');

        Route::get('add','SlideController@getAdd')->name('slidegetadd');
        Route::post('add','SlideController@postAdd')->name('slidepostadd');
        Route::get('delete/{id}','SlideController@getDelete')->name('slidegetdelete');
    });

    Route::group(['prefix'=>'user'],function(){
        Route::get('list','UserController@getList')->name('usergetlist');
        Route::get('edit/{id}','UserController@getEdit')->name('usergetedit');
        Route::post('edit/{id}','UserController@postEdit')->name('userpostedit');


        Route::get('add','UserController@getAdd')->name('usergetadd');
        Route::post('add','UserController@postAdd')->name('userpostadd');

        Route::get('delete/{id}','UserController@getDelete')->name('usergetdelete');
    });

    Route::group(['prefix'=>'ajax'],function(){
        Route::get('loaitin/{idTheLoai}','AjaxController@getLoaiTin')->name('ajaxgetloaitin');
    });




});

Route::get('trangchu','PageController@trangchu');
Route::get('lienhe','PageController@lienhe');
Route::get('loaitin/{id}/{TenKhongDau}.html','PageController@loaitin');
Route::get('tintuc/{id}/{TenKhongDau}.html','PageController@tintuc');

Route::get('login','PageController@getLogin');
Route::post('login','PageController@postLogin');
Route::get('logout','PageController@getLogout');

Route::post('comment/{id}','CommentController@postComment');

Route::get('account','PageController@getAccount');
Route::post('account','PageController@postAccount');

Route::get('register','PageController@getRegister');
Route::post('register','PageController@postRegister');

Route::get('timkiem','PageController@timkiem');




