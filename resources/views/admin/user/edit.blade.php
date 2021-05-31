@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Edit
                    <small>{{$user->name}}</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $err )
                            {{$err}}<br>
                        @endforeach
                    </div>
                @endif

                @if (session('thongbao'))
                    <div class="alert alert-success">
                        {{session('thongbao')}}
                    </div>
                @endif
                @csrf



                <form action="{{ route('userpostedit',['id'=>$user->id])}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Họ Tên</label>
                        <input class="form-control" name="ten" placeholder="Nhập họ tên" value="{{$user->name}}"/>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" type="email" name="email" readonly value="{{$user->email}}" />
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="changePassword" id="changePassword">
                        <label>Đổi mật khẩu</label>
                        <input class="form-control password" type="password" name="password" disabled placeholder="Nhập mật khẩu" />
                    </div>
                    <div class="form-group">
                        <label>Nhập lại mật khẩu</label>
                        <input class="form-control password" type="password" name="passwordAgain" disabled placeholder="Nhập lại mật khẩu" />
                    </div>

                    <div class="form-group">
                        <label>Level</label>
                        <label class="radio-inline">
                            <input name="level" value="1" type="radio"
                            @if ($user->level == 1)
                                {{'checked'}}
                            @endif>Admin
                        </label>
                        <label class="radio-inline">
                            <input name="level" value="0"  @if ($user->level == 0)
                            {{'checked'}}
                        @endif type="radio">Normal
                        </label>
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

@section('script')
    <script>
        $(document).ready(function () {
            $("#changePassword").change(function (){
                if ($(this).is(":checked")){
                    $(".password").removeAttr("disabled");
                }
                else{
                    $(".password").attr("disabled","");

                }
            });
        });
    </script>
@endsection
