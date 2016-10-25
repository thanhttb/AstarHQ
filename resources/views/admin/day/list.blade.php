@extends('admin/master')
@section('content')
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Ngày học lớp {!!$class['className']!!}
                            <small>List</small>
                        
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>Stt</th>
                                <th>Ngày</th>
                                <th>Giáo viên</th>
                                <th>Học phí</th>
                                <th>Ghi chú</th>
                                <th>Sửa</th>
                                <th>Xóa</th>                           

                            </tr>
                        </thead>
                        <tbody>
                            <?php $stt=0?>
                            @foreach($day as $val)
                            <?php $stt++; ?>
                            <tr class="odd gradeX" align="center">
                                <td>{!!$stt!!}</td>
                                <td>{!!date('d-m-Y (D)',strtotime($val->day))!!}</td>
                                <td>{!!$val->teacherName!!}</td>
                                <td>{!!$val->tuition!!}</td>
                                <td>{!!$val->note!!}</td>
                                
                               <td class="center"><a href="{!! URL::route('admin.day.getEdit',$val->dayNumber)!!}"><i class="fa fa-pencil fa-fw"></i> </a></td>
                               <td class="center"><a style="text-decoration:none" href="{!!URL::route('admin.day.getDelete',$val->dayNumber)!!}">Xóa</a></td>
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