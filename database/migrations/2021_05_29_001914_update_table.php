<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Comment', function (Blueprint $table) {
            // $table->dropForeign('comment_iduser_foreign');
            // $table->dropForeign('comment_idtintuc_foreign');
            $table->foreign('idUser')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('idTinTuc')->references('id')->on('tintuc')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('loaitin',function (Blueprint $table){
            $table->dropForeign('loaitin_idtheloai_foreign');
            $table->foreign('idTheLoai')->references('id')->on('theloai')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('tintuc',function (Blueprint $table){
            $table->dropForeign('tintuc_idloaitin_foreign');
            $table->foreign('idLoaiTin')->references('id')->on('loaitin')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
