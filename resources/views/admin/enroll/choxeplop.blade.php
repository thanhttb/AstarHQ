@extends('admin/master')
@section('content')
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Học sinh chờ xếp lớp
                            <small>Nhiệm vụ cần hoàn thành ngày <?php echo date("d/m/Y"); ?>: Thông báo cho phụ huynh kết quả và Xếp lớp</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            
                            <tr align="center">
                                <th>Stt</th>
                                <th>Họ đệm</th>
                                <th>Tên</th>
                                <th>Khối Lớp</th>
                                <th>Phụ huynh</th>
                                <th>SĐT Phụ huynh</th>
                                <th>Môn học</th>
                                <th>Ngày Kiểm tra</th>
                                <th>Ghi chú</th>
                                <th>Kết quả</th>
                                <th>Lớp</th>
                                <th>Tình trạng</th>
                                <th>Xếp lớp</th>
                            </tr>
                        </thead>
                        <tbody>     
                            <?php $stt=0?>
                            @foreach($dacokq as $val)
                            <?php $stt++; ?>
                            
                                <tr class="odd gradeX" align="center">
                                    <td>{!!$stt!!}</td>
                                    <td>{!!$val['lastName']!!}</td>
                                    <td>{!!$val['firstName']!!}</td>
                                    <td>{!!$val['class']!!}</td>
                                    <td>{!!$val['parentName']!!}</td>
                                    <td>{!!$val['parentPhone1']!!}</td>
                                    <td>{!!$val['subject']!!}</td>
                                    <td><?php $date=$val['entranceTestDate'];
                                              $newDate=date('d-m-Y',strtotime($date));
                                              echo $newDate;
                                         ?>      
                                    </td>                                
                                    <td>{!!$val['note']!!}</td>    
                                    <td>
                                        <form action="{!!route('admin.enroll.postXeplop',$val['enrollNumber'])!!}" method="POST" >
                                         <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                                         <input type="text" name="result" value="{!!old('result'), isset($val['result']) ? $val['result']:null!!}">
                                    </td>

                                    <td>                                     

                                         <select class="form-control" name="idLophoc">
                                            
                                             @foreach($xeplop as $xl)
                                                    <option value="{!!$xl['classNumber']!!}">{!!$xl['className']!!}</option>
                                             @endforeach
                                             <option selected="selected">Chọn lớp</option>
                                         </select>    
                                        
                                    </td>
                                    <td>{!! $val['status']!!}</td>
                                    <td><button type="submit" class="btn btn-default">Ghi nhận</button> </td>
                                </form>
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