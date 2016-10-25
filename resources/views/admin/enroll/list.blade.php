@extends('admin/master')
@section('content')
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Eroll
                            <small>List</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
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
                                <td>{!!$val->lastName!!}</td>
                                <td>{!!$val->firstName!!}</td>
                                <td>{!!$val->class!!}</td>
                                <td>{!!$val->parentName!!}</td>
                                <td>{!!$val->parentPhone1!!}</td>
                                <td>{!!$val->subject!!}</td>
                                <td>{!!$val->entranceTestDate!!}</td>
                                <td>{!!$val->note!!}</td>
                                <td>{!!$val->status!!}</td>
                                <td>{!!$val->result!!}</td>
                               <td class="center"><a href="{!! URL::route('admin.enroll.delete',$val->enrollNumber)!!}"><i class="fa fa-trash-o  fa-fw"></i></a></td>
                                <td class="center"> <a href="{!! URL::route('admin.enroll.getEdit',$val->enrollNumber)!!}"><i class="fa fa-pencil fa-fw"></i></a></td>
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