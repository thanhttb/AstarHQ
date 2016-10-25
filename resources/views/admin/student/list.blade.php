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
                                <th>Khối Lớp</th>
                                <th>Ngày sinh</th>
                                <th>Giới tính</th>
                                <th>SĐT</th>
                                <th>Email</th>
                                <th>Phụ huynh</th>
                                <th>SĐT1 PH</th>
                                <th>SĐT2 PH</th>
                                <th>Email PH</th>                                
                            
                                <th>Sửa</th>
                              
                            </tr>
                        </thead>
                        <tbody>
                            <?php $stt=0?>
                            @foreach($data as $val)
                            <?php $stt++; ?>
                            <tr class="odd gradeX" align="center">
                                <td>{!!$stt!!}</td>
                                 
                                @if ($arrCount[$val->studentNumber] > 1)
                                    <td class="center" style="background-color:yellow">
                                    <a style="text-decoration:none" href="{!!URL::route('admin.student.getClass',$val->studentNumber)!!}">
                                     {!!$val->lastName!!}</a>
                                    </td  >
                                @elseif($arrCount[$val->studentNumber] == 1)
                                    <td class="center" style="background-color:lightgreen">
                                    <a style="text-decoration:none" href="{!!URL::route('admin.student.getClass',$val->studentNumber)!!}">{!!$val->lastName!!}</a>
                                    </td>
                                @else
                                    <td>
                                    {!!$val->lastName!!}
                                    </td>
                                @endif
                                
                                <td>{!!$val->firstName!!}</td>
                                <td>{!!$val->school!!}</td>
                                <td>{!!$val->class!!}</td>
                                <td>{!!$val->birthday!!}</td>                                
                                <td>{!!$val->gender!!}</td>
                                <td>{!!$val->phone!!}</td>
                                <td>{!!$val->email!!}</td>
                                <td>{!!$val->parentName!!}</td>
                                <td>{!!$val->parentPhone1!!}</td>
                                <td>{!!$val->parentPhone2!!}</td>
                                <td>{!!$val->parentEmail!!}</td>
                                
                               
                                <td class="center"> <a href="{!! URL::route('admin.student.getEdit',$val->studentNumber)!!}"><i class="fa fa-pencil fa-fw"></i></a></td>
                                
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