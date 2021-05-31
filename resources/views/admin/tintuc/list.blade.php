@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Tin tức
                    <small>List</small>
                </h1>
            </div>
        </div>

        <br>
        @if (session('thongbao'))
        <div class="row">
            <div class="alert alert-success">
                {{session('thongbao')}}<br>
            </div>

        </div>
        @endif
            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Tiêu đề</th>
                        <th>Tóm tắt</th>
                        <th>Thể loại</th>
                        <th>Loại tin</th>
                        <th>Xem</th>
                        <th>Nổi bật</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tintuc as $tt)
                    <tr class="odd gradeX" align="center">

                        <td>{{ $tt->id  }}</td>
                        <td>{{ $tt->TieuDe }}<br>
                        <img width="100px" src="upload/tintuc/{{$tt->Hinh}}" >
                        </td>
                        <td>{{ $tt->TomTat }}</td>
                        <td>{{ $tt->loaitin->theloai->Ten }}</td>
                        <td>{{ $tt->loaitin->Ten }}</td>
                        <td>{{ $tt->SoLuotXem }}</td>
                        <td>{{ $tt->NoiBat }}</td>
                        <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="{{route('ttgetdelete',['id'=>$tt->id])}}"> Delete</a></td>
                        <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{{route('ttgetedit',['id'=>$tt->id])}}">Edit</a></td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>

@endsection
