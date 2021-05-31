@extends('layout.index')

@section('content')

<div class="container">
    <div class="row">

        @include('layout.menu')
        <?php
            function highlight($str,$key){
                return str_ireplace($key,"<span style='color:red;'>$key</span>",$str);
            }
        ?>
        <div class="col-md-9 ">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color:#337AB7; color:white;">
                    <h4><b>Tìm kiếm: {{$tukhoa}}</b></h4>
                </div>
                @foreach($tintuc as $tt)
                <div class="row-item row">
                    <div class="col-md-3">

                        <a href="tintuc/{{$tt->id}}/{{$tt->TieuDeKhongDau}}.html">
                            <br>
                            <img width="200px" height="200px" class="img-responsive" src="upload/tintuc/{{$tt->Hinh}}" alt="">
                        </a>
                    </div>

                    <div class="col-md-9">
                        <h3>{!!highlight($tt->TieuDe,$tukhoa)!!}</h3>
                        <p>{!!highlight($tt->TomTat,$tukhoa)!!}</p>
                        <a class="btn btn-primary" href="tintuc/{{$tt->id}}/{{$tt->TieuDeKhongDau}}.html">Xem tin<span class="glyphicon glyphicon-chevron-right"></span></a>
                    </div>
                    <div class="break"></div>
                </div>
                @endforeach


                 <center>{{$tintuc->appends(Request::all())->links()}}</center>
            </div>
        </div>

    </div>

</div>
@endsection
