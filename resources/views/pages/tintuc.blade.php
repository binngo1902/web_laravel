@extends('layout.index')
@section('content')
<div class="container">
    <div class="row">

        <!-- Blog Post Content Column -->
        <div class="col-lg-9">

            <!-- Blog Post -->

            <!-- Title -->
            <h1>{{$tintuc->TieuDe}}</h1>

            <!-- Author -->
            <p class="lead">
                by <a href="#">Admin</a>
            </p>

            <!-- Preview Image -->
            <img class="img-responsive" src="upload/tintuc/{{$tintuc->Hinh}}" alt="">

            <!-- Date/Time -->
            <p><span class="glyphicon glyphicon-time"></span> Posted on : {{$tintuc->created_at}}</p>
            <hr>

            <!-- Post Content -->
            <p class="lead">{{$tintuc->TomTat}}</p>
            {!!$tintuc->NoiDung!!}
            <hr>

            <!-- Blog Comments -->

            <!-- Comments Form -->
            @if (Auth::check())
            <div class="well">
                <h4>Viết bình luận ...<span class="glyphicon glyphicon-pencil"></span></h4>
                <form role="form" action='comment/{{$tintuc->id}}/' method="post">
                    @csrf
                    <div class="form-group">
                        <textarea class="form-control" rows="3" name="NoiDung"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Gửi</button>
                </form>
            </div>
            @endif
            <hr>

            <!-- Posted Comments -->

            <!-- Comment -->
            @foreach ($tintuc->comment as $cm)


            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">{{$cm->user->name}}
                        <small>{{$cm->created_at}}</small>
                    </h4>
                    {!!$cm->NoiDung!!} </div>
            </div>
            @endforeach

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <div class="col-md-3">

            <div class="panel panel-default">
                <div class="panel-heading"><b>Tin liên quan</b></div>
                <div class="panel-body">

                    <!-- item -->
                    @foreach ($lienquan as $lq)


                    <div class="row" style="margin-top: 10px;">
                        <div class="col-md-5">
                            <a href="tintuc/{{$lq->id}}/{{$lq->TieuDeKhongDau}}.html">
                                <img class="img-responsive" src="upload/tintuc/{{$lq->Hinh}}" alt="">
                            </a>
                        </div>
                        <div class="col-md-7">
                            <a href="tintuc/{{$lq->id}}/{{$lq->TieuDeKhongDau}}.html"><b>{{$lq->TieuDe}}</b></a>
                        </div>
                        <p style="padding-left:5px">{!!$lq->TomTat!!}</p>
                        <div class="break"></div>
                    </div>
                    @endforeach
                </div>


            <div class="panel panel-default">
                <div class="panel-heading"><b>Tin nổi bật</b></div>
                <div class="panel-body">

                    <!-- item -->
                    @foreach($noibat as $nb)
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-md-5">
                            <a href="tintuc/{{$nb->id}}/{{$nb->TieuDeKhongDau}}.html">
                                <img class="img-responsive" src="upload/tintuc/{{$nb->Hinh}}" alt="">
                            </a>
                        </div>
                        <div class="col-md-7">
                            <a href="tintuc/{{$nb->id}}/{{$nb->TieuDeKhongDau}}.html"><b>{{$nb->TieuDe}}</b></a>
                        </div>
                        <p style="padding-left:5px">{{$nb->TomTat}}</p>
                        <div class="break"></div>
                    </div>
                    @endforeach
                    <!-- end item -->


                </div>
            </div>

        </div>

    </div>
    <!-- /.row -->
</div>

@endsection
