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
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <h3>Học sinh chưa xếp lịch</h3>
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
                                <th>Hẹn lịch</th>
                            </tr>
                        </thead>
                        <tbody>     
                            <?php $stt=0?>
                            @foreach($chuaXepLich as $val)
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
                                <td>{!!$val['status']!!}</td>
                                <td class="center"><!--<i class="fa fa-trash-o  fa-fw"></i>--><a href="{!! URL::route('admin.enroll.delete',$val->enrollNumber)!!}">Lên lịch</a></td>
                            </tr>
                           @endforeach
                        </tbody>
                    </table>
                </div>
                <div>
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
                                <th>Lưu</th>
                            </tr>
                        </thead>
                        <tbody>     
                            <?php $stt=0?>
                            @foreach($daXepLich as $val)
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
                                    <select class='form-control' name="status">
                                        <option selected="selected">{!!$val['status']!!}</option>
                                        <option value="3">Đã đến kiểm tra</option>
                                    </select>

                                </td>
                                <td class="center"><!--<i class="fa fa-trash-o  fa-fw"></i>--><a href="{!! URL::route('admin.updateDashboard',$val['enrollNumber'])!!}">Lưu thay đổi</a>

                                </td>
                            </tr>
                           @endforeach
                        </tbody>
                    </table>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" ,id="dataTables-example">
                        <thead>
                            <h3>Học sinh đã có kết quả</h3>
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
                                <th>Kết quả</th>
                                <th>Xếp lớp</th>
                                <th>Xóa</th>
                            </tr>
                        </thead>
                        <tbody>     
                            <?php $stt=0?>
                            @foreach($daXepLich as $val)
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
                                    <select class='form-control' name="status">
                                        <option selected="selected">{!!$val['status']!!}</option>
                                        <option value="3">Đã báo phụ huynh</option>
                                    </select>

                                </td>
                                <td>{!!$val['result']!!}</td>
                                <td class="center"><!--<i class="fa fa-trash-o  fa-fw"></i>--><a href="{!! URL::route('admin.updateDashboard',$val['enrollNumber'])!!}">Lưu thay đổi</a>
                                <td><a href="{!! URL::route('admin.enroll.delete',$val['enrollNumber'])!!}">Xóa đơn</a></td>
                                </td>
                            </tr>
                           @endforeach
                        </tbody>
                    </table>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" ,id="dataTables-example">
                        <thead>
                            <h3>Học sinh đã có kết quả</h3>
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
                                <th>Kết quả</th>
                                <th>Xếp lớp</th>
                                <th>Xóa</th>
                            </tr>
                        </thead>
                        <tbody>     
                            <?php $stt=0?>
                            @foreach($daXepLich as $val)
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
                                    <select class='form-control' name="status">
                                        <option selected="selected">{!!$val['status']!!}</option>
                                        <option value="3">Đã báo phụ huynh</option>
                                    </select>

                                </td>
                                <td>{!!$val['result']!!}</td>
                                <td class="center"><!--<i class="fa fa-trash-o  fa-fw"></i>--><a href="{!! URL::route('admin.updateDashboard',$val['enrollNumber'])!!}">Lưu thay đổi</a>
                                <td><a href="{!! URL::route('admin.enroll.delete',$val['enrollNumber'])!!}">Xóa đơn</a></td>
                                </td>
                            </tr>
                            <div>


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