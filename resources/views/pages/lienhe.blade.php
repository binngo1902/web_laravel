@extends('layout.index')
@section('content')
<div class="container">

    <!-- slider -->
    @include('layout.slide')
    <!-- end slide -->

    <div class="space20"></div>


    <div class="row main-left">
        @include('layout.menu')

        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color:#337AB7; color:white;" >
                    <h2 style="margin-top:0px; margin-bottom:0px;">Liên hệ</h2>
                </div>

                <div class="panel-body">
                    <!-- item -->
                    <h3><span class="glyphicon glyphicon-align-left"></span> Thông tin liên hệ</h3>

                    <div class="break"></div>
                       <h4><span class= "glyphicon glyphicon-home "></span> Địa chỉ : </h4>
                    <p> HCM </p>

                    <h4><span class="glyphicon glyphicon-envelope"></span> Email : </h4>
                    <p> HCM </p>

                    <h4><span class="glyphicon glyphicon-phone-alt"></span> Điện thoại : </h4>
                    <p> HCM </p>




                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
</div>
@endsection
