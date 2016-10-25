@extends('admin/master')
@section('content')
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Danh sách lớp học của 
                            <small><?php echo $data['lastName']." ".$data['firstName'] ?></small>
                        
                        
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>Stt</th>
                                <th>Tên lớp</th>
                                <th>Miêu tả</th>
                                <th>Khối Lớp</th>                              
                                
                                <th>Ngày vào học</th>
                                <th>Ngày thôi học</th>
                                <th>Trạng thái</th>
                                <th>Thôi học</th>
                                <th>Chuyển lớp</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $stt=0?>
                            @foreach($classes as $val)
                            <?php $stt++; ?>
                            <tr class="odd gradeX" align="center">
                                <td>{!!$stt!!}</td>
                                <td>{!!$val->className!!}</td>
                                <td>{!!$val->description!!}</td>
                                <td>{!!$val->class!!}</td>
                                <td>{!!$status[$val->classNumber][0]['start']!!}</td>
                                <td>{!!$status[$val->classNumber][0]['end']!!}</td>
                                <td>{!!$status[$val->classNumber][0]['status']!!}</td>
                               <td class="center"><a href="{!! URL::route('admin.student.getDrop',$status[$val->classNumber][0]['id'])!!}"><i class="fa fa-trash-o  fa-fw"></i></a></td>
                                <td class="center"><a href="{!! URL::route('admin.student.getChuyenlop',$data['studentNumber'])!!}"><i class="fa fa-pencil fa-fw"></i> </a></td>
                            </tr>
                           @endforeach
                        </tbody>
                    </table>
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example"  style="border:none">
                       <tr class="odd gradeX" align="center">
                           <td style="border:none">
                               <a href="{!!URL::route('admin.student.management.getTuition',$data['studentNumber'])!!}"><h3>QUẢN LÝ HỌC PHÍ</h3></a>
                           </td>
                           <td  style="border:none">
                               <a href="{!!URL::route('admin.student.management.getResult',$data['studentNumber'])!!}"><h3>QUẢN LÝ KẾT QUẢ HỌC TẬP</h3></a>
                           </td>
                       </tr>
                    </table>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
@endsection()