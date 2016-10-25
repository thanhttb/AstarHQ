@extends('admin/master')
@section('content')
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Điểm danh lớp {!!$class['className']!!} Tháng {!!$month!!} Năm {!!$year!!}
                            <small></small>
                       
                        
                        </h1>
                    </div>
                   
                      <form method="post" action="{!!route('admin.attendance.postMonth',$class['classNumber'])!!}">  
                      <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                        <label>Chọn tháng</label>   
                        <input class="form_control" type="month" name="thang">
                        <button class="btn" type="submit">Xem</button>                        
                       </form>   
                       <br>
                     <form method="POST" action="{!!route('admin.attendance.postAttendance',$class['classNumber'])!!}">  
                    <input type="hidden" name="_token" value="{!!csrf_token()!!}">                       
                    <?php $stt=0; $status=0; ?>
                        
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">

                        <thead>
                            <tr align="center">
                                <th>Stt</th>
                                <th>Họ đệm</th>
                                <th>Tên</th>
                               
                                <th>Tên Phụ Huynh</th>
                                <th>Điện thoại PH</th>
                                @foreach($day as $d)
                                    <th><?php echo date('d/m',strtotime($d['day'])) ?></th>
                                @endforeach
                                <th>Discount</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        @foreach($studentInClass as $student)
                            <?php $stt++; ?>
                            <tr class="odd gradeX" align="center" >
                                <td >{!!$stt!!}</td>
                                <td>{!!$student['lastName']!!}</td>
                                <td>{!!$student['firstName']!!}</td>                               
                                
                                <td>{!!$student['parentName']!!}</td>
                                <td>{!!$student['parentPhone1']!!}</td>
                                <?php $discount=0 ?>
                                @foreach($atdMonth as $atd)
                                    <td>
                                    <?php $status++;?>
                                    @foreach($atd as $data)
                                        @if($data['class_studentNumber']==$student['id'])
                                            <input class="form-control" type="text" size="1" name="{!!"status".$status!!}" value="{!!old("status"+$status,isset($atd) ? $data['statusNumber']: null)!!}">
                                            <?php $discount=$data['discount'] ?>
                                        @endif
                                    @endforeach
                                    
                                    </td>

                                @endforeach
                                <td><input class="form-control" type="number" name="{!!"discount".$stt!!}" value="{!!old("discount"+$stt, isset($atdMonth) ?  $discount :null)!!}" size="1"></td>
                        @endforeach

                           </tr>
                        </tbody>
                    </table>
                    <input type="hidden" name="month" value="{!!$month!!}">
                    <input type="hidden" name="year" value="{!!$year!!}">
                    <button type="submit" class="btn">Lưu</button>
                    </form>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
@endsection()