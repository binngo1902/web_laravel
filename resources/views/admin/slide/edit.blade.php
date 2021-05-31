@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Slide
                    <small>Edit</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                <form action="{{ route('slidepostedit',['id'=>$slide->id])}}" method="POST" enctype="multipart/form-data">
                   @if (count($errors)>0)
                   <div class="alert alert-danger">
                       @foreach ($errors->all() as $err)
                           {{$err}}<br>
                       @endforeach
                   </div>

                   @endif

                    @csrf


                    <div class="form-group">
                        <label>Tên</label>
                        <input class="form-control" name="Ten" placeholder="Nhập tên"value="{{$slide->Ten}}" />
                    </div>
                    <div class="form-group">
                        <label>Nội dung</label>
                        <textarea name="NoiDung" id="demo" class='ckeditor' >{{$slide->NoiDung}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Hình</label>
                        <div>
                            <img src="upload/slide/{{$slide->Hinh}}" width="200px">
                            <br>
                        </div>
                        <input type="file" name="Hinh" accept="image/*" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Link</label>
                        <input class="form-control" name='Link' value="{{$slide->link}}">
                    </div>

                    <button type="submit" class="btn btn-default">Edit</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                <form>
            </div>

        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>

@endsection
