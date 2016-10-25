
@extends('admin.master')
@section('content')
    <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Quản lý học phí tháng {!!$thisMonth!!} năm {!!$thisYear!!} của
                            <small>{!!$student['lastName'].$student['fistName']!!}</small>
                        </h1>

                    </div>
                    <div>
                        <form method="POST" action="{!!route('admin.student.management.postMonth',$id)!!}">
                            <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                            <label class=".control-label">Chọn tháng</label>
                            <input class=". form-inline" type="month" name="month">
                            <button type="submit" class="btn">Xem</button>
                        </form>
                        
                    </div>
                    <!-- /.col-lg-12 -->
                    <?php $i=0; $totalTuition=0;?>
                    @foreach($tuitionAllClass as $tuitionEachClass)
                        <h3>{!!$class_student[$i]['className']!!}</h3>
                        <?php $i++; ?>
                        <?php $stt=0; ?>
                        
                            <table class="table table-striped table-bordered table-hover">
                            <thead>
                                
                                <tr align="center">
                                    
                                    <th>Tháng</th>                                
                                    <th>Số buổi học</th>
                                    <th>Disount</th>
                                    <th>Tổng học phí</th>
                                    <th>Phụ phí</th>
                                    <th>Số dư kỳ trước</th>  
                                    <th>Đã thu</th> 
                                    <th>Số dư</th>                           
                                    <th>Ghi chú</th>
                                    <th>Ngày thu</th>
                                    <th>Lưu</th>                              
                            </tr>
                            </thead>
                        @foreach($tuitionEachClass as $val)

                            <tbody>                            
                            <tr align="center">
                            <?php $stt+=1; ?>

                                <th>{!!($thisMonth+$stt-1)."/".($thisYear)!!}</th>
                                <th>{!!$val[$i-1]!!}</th>
                                <th>{!!$val['discount']."%"!!}</th>
                                <th>{!!$val['totalTuition']!!}</th>
                                 <form action="{!!URL::route('admin.student.management.postTuition',$val['tuitionNumber'])!!}" method="POST" >
                                    <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                                    <th><input type="number" name="other" value="{!!old('other',isset($val) ? $val['other'] : null)!!}" style="width:7em"></th>
                                    <th>{!!$val['previousRemained']!!}</th>
                                    <th><input type="number" name="received" value="{!!old('received',isset($val) ? $val['received'] : null)!!}" style="width:7em"></th>

                                    <th>{!!$val['remained']!!}</th>


                                    <th><input type="text"  name="note" value="{!!old('received',isset($val) ? $val['note'] : null)!!}" style="width:7em"></th>

                                    <th>{!!$val['dayReceive']!!}</th>

                                    <th><button type="submit">Lưu</button></th>
                                </form>
                                <?php $totalTuition+=$val['remained'] ?>
                            </tr>
                           
                        </tbody>
                    @endforeach
                    </table>
                    <div><h3>Tổng số tiền cần đóng tháng {!! $thisMonth."và ".($thisMonth+1). " năm ".$thisYear."Lớp ".$class_student[$i-1]['className']." : ".number_format($totalTuition)."VND"; !!}</h3></div>    
                    @endforeach
                    
                    
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->            
                @endsection()