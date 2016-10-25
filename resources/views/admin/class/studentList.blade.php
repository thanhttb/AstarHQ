@extends('admin/master')
@section('content')
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-13">
                        <h1 class="page-header">Học sinh 
                            <small>Danh sách</small>
                        </h1>
                    </div>
                    
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>#</th>
                                <th>Họ đệm</th>
                                <th>Tên</th>
                                <th>Trường</th>
                                <th>Ngày sinh</th>
                                <th>Giới tính</th>
                                <th>SĐT</th>
                                <th>Phụ huynh</th>
                                <th>SĐT1 PH</th>
                                
                                <th>Email PH</th>                                
                                
                                <th>Thôi học</th>
                                <th>Chuyển lớp</th>
                              
                            </tr>
                        </thead>
                        <tbody>
                            <?php $stt=0?>
                            @foreach($student as $val)
                            <?php $stt++; ?>
                            <tr class="odd gradeX" align="center">
                                <td>{!!$stt!!}</td>
                                 
                                @if ($val->statusNumber == 8)
                                    <td class="center">
                                    <a style="text-decoration:none" href="{!!URL::route('admin.student.management.getOption',$val->studentNumber)!!}">
                                     {!!$val->lastName!!}</a>
                                    </td  >
                                @elseif($val->statusNumber==9)
                                    <td  class="center da_nghi_hoc" style="background-color:Gainsboro ">
                                    <a style="text-decoration:none" href="{!!URL::route('admin.student.management.getOption',$val->studentNumber)!!}">{!!$val->lastName!!}</a>
                                    </td>
                              
                                @endif
                                
                                <td>{!!$val->firstName!!}</td>
                                <td>{!!$val->school!!}</td>
                               
                                <td>{!!$val->birthday!!}</td>                                
                                <td>{!!$val->gender!!}</td>
                                <td>{!!$val->phone!!}</td>
                                <td>{!!$val->parentName!!}</td>
                                <td>{!!$val->parentPhone1!!}</td>
                                <td>{!!$val->parentEmail!!}</td>
                                
                               
                                <td class="center"> <a href="{!! URL::route('admin.student.getDrop',$val->id)!!}"><i class="fa fa-trash-o fa-fw"></i></a></td>
                                <td class="center"> <a href="{!! URL::route('admin.student.getChuyenlop',$val->id)!!}"><i class="fa fa-pencil fa-fw"></i></a></td>
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