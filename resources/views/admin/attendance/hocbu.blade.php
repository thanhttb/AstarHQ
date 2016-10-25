@extends('admin/master')
@section('content')
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Danh sách học bù Từ ngày {!!$firstOfThisWeek!!} đến ngày {!!$lastOfThisWeek!!}
                            <small></small>
                       
                        
                        </h1>
                    </div>
                   
                      <form method="post" action="{!!route('admin.attendance.postWeek')!!}">  
                      <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                        <label>Chọn tuần</label>   
                        <input class="form_control" type="week" name="tuan">
                        <button class="btn" type="submit">Xem</button>                        
                       </form>   
                       <br>
                                       
                    <?php $stt=0; $status=0; ?>
                        
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example" >
                       
                        <thead style="" >
                            <tr align="center" >
                                <th>STT</th>
                                <th>Họ và Tên</th> 
                                <th>Ghi chú</th>                              
                                <th>Điện thoại PH</th>
                                <th>Người xử lý</th>
                                <th>Lớp</th>
                                <th>Ngày nghỉ</th>
                                <th>Hẹn ngày</th>
                                <th>Trạng thái</th>
                                <th>Lưu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hocbuList as $hocbu)
                            <?php $stt++; ?>
                            <tr align="center">
                                <?php $student=$studentList[$hocbu['attendanceNumber']];
                                      $class=$classList[$hocbu['attendanceNumber']];
                                 ?>
                                <form method="POST" action="{!!route('admin.attendance.postHocbu',$hocbu['attendanceNumber'])!!}">  
                                <input type="hidden" name="_token" value="{!!csrf_token()!!}">    
                                <td> {!!$stt!!}</td>

                                <td>{!!$student['lastName']." ".$student['firstName']!!}</td>

                                <td><textarea class="form-control" rows="2" name="hocbuNote">{!!$hocbu['hocbuNote']!!}</textarea></td>

                                <td>{!!$student['parentPhone1']!!}</td>

                                <td><input type="text" size="2" class="form-control" name="handler" value="{!!old('handler',isset($hocbu)? $hocbu['hocbuHandler'] : null)!!}"></td>

                                <td>{!!$class['className']!!}</td>

                                <td>{!!$hocbu['day']!!}</td>
                                <td><input type="date" name="hocbuDay" value="{!!old('hocbuDay', isset($hocbu) ? $hocbu['hocbuDay'] : null)!!}"></td>
                                <td>
                                        <select class="form-control" name="status">
                                            <option value="10">Chờ chốt lịch</option>
                                            <option value="11">Đã chốt lịch</option>
                                            <option value="12">Đã đến học</option>
                                            <option value="{!!old('status', isset($hocbu) ? $hocbu['hocbuStatus'] : null)!!}" selected="selected">{!!$hocbu['status']!!}</option>
                                        </select>
                                    </td>

                                <td><button type="submit" class="   glyphicon glyphicon-floppy-saved"></button></td>
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