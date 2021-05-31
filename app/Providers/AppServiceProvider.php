<?php

namespace App\Providers;

use App\Models\Slide;
use App\Models\TheLoai;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $slide = Slide::all();
        $theloai = TheLoai::all();
        View::share('theloai',$theloai);
        View::share('slide',$slide);

    }
}
