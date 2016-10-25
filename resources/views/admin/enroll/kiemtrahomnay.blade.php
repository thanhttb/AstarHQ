@extends('admin/master')
@section('content')
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Dashboard
                            <small>Nhiệm vụ cần hoàn thành ngày <?php echo date("d/m/Y"); ?></small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                     <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" ,id="dataTables-example">
                        <thead>
                            <h3>Học sinh kiểm tra hôm nay</h3>
                            <tr align="center">
                                <th>ID</th>
                                <th>Họ đệm</th>
                                <th>Tên</th>
                                <th>Khối Lớp</th>
                                <th>Phụ huynh</th>
                                <th>SĐT Phụ huynh</th>
                                <th>Môn học</th>
                                <th>Ngày Kiểm tra</th>
                                <th>Ghi chú</th>
                                <th>Tình trạng</th>
                                <th>Đã đến kiểm tra</th>
                            </tr>
                        </thead>
                        <tbody>     
                            <?php $stt=0?>
                            @foreach($kiemTraHomNay as $val)
                            <?php $stt++; ?>
                            <tr class="odd gradeX" align="center">
                                <td>{!!$stt!!}</td>
                                <td>{!!$val['lastName']!!}</td>
                                <td>{!!$val['firstName']!!}</td>
                                <td>{!!$val['class']!!}</td>
                                <td>{!!$val['parentName']!!}</td>
                                <td>{!!$val['parentPhone1']!!}</td>
                                <td>{!!$val['subject']!!}</td>
                                <td>{!!$val['entranceTestDate']!!}</td>
                                <td>{!!$val['note']!!}</td>
                                <td>
                                  {!!$val['status']!!}

                                </td>
                                <td class="center"><!--<i class="fa fa-trash-o  fa-fw"></i>--><a class="btn btn-info btn-lg" href="{!! URL::route('admin.enroll.update',$val['enrollNumber'])!!}"><span class="glyphicon glyphicon-ok"></span> Đã KT</a>

                                </td>
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