@extends('admin/master')
@section('content')
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Danh sách lớp học
                            <small>List</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example" style="overflow-x:auto">
                        <thead>
                            <tr align="center">
                                <th>Stt</th>
                                <th>Tên lớp</th>
                                <th>Miêu tả</th>
                                <th>Khối Lớp</th>
                                <th>Giáo viên</th>
                                <th>Thứ</th>
                                <th>Giờ bắt đầu</th>
                                <th>Giờ kết thúc</th>
                                <th>Học phí</th>
                                <th>Địa chỉ</th>
                                <th>Sĩ số</th>
                                <th>Xóa</th>
                                <th>Sửa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $stt=0?>
                            @foreach($data as $val)
                            <?php $stt++; ?>
                            <tr class="odd gradeX" align="center">
                                <td>{!!$stt!!}</td>
                                <td><a href="{!!URL::route('admin.class.getStudentList',$val->classNumber)!!}">{!!$val->className!!}</a></td>
                                <td>{!!$val->description!!}</td>
                                <td>{!!$val->class!!}</td>
                                <td>{!!$val->teacherName!!}</td>
                                <td>{!!$val->day!!}</td>
                                <td>{!!$val->startTime!!}</td>
                                <td>{!!$val->endTime!!}</td>
                                <td>{!!$val->tuition!!}</td>
                                <td>{!!$val->location!!}</td>
                                <td>{!!$val->sum!!}</td>
                               <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="{!! URL::route('admin.class.delete',$val->classNumber)!!}"> Delete</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{!! URL::route('admin.class.getEdit',$val->classNumber)!!}">Edit</a></td>
                            </tr>
                           @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
@endsection()