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
                                    <td><a href="{!!URL::route('admin.enroll.getEdit',$val['enrollNumber'])!!}">{!!$stt!!}</a></td>
                                    <td>{!!$val['lastName']!!}</td>
                                    <td>{!!$val['firstName']!!}</td>
                                    <td>{!!$val['class']!!}</td>
                                    <td>{!!$val['parentName']!!}</td>
                                    <td>{!!$val['parentPhone1']!!}</td>
                                    <td>{!!$val['subject']!!}</td>
                                    <td>         
                                        <form action="{!!route('admin.enroll.daxeplich',$val['enrollNumber'])!!}" method="POST" >

                                        <input type="hidden" name="_token" value="{!!csrf_token()!!}">                             
                                       
                                            <?php 
                                                $date=$val['entranceTestDate'];                            
                                                $newDate=date("Y-m-d", strtotime($date));
                                                if(is_null($date)) $newDate="00/00/0000";                                            
                                             ?>
                                        <input class="form-control" type="date" name="entranceDate" value="{!!old('entranceDate',isset($val) ? $newDate : null)!!}">                                
                                        
                                    </td>

                                    <td>

                                        <textarea class="form-control" rows="1" name="note" value="{!!old('note', isset($val) ? $val['note']:null)!!}"></textarea>
                                    </td>
                                    <td>
                                        <select class="form-control" name="status">
                                            <option value="2">Đã xếp lịch</option>
                                            <option value="{!!old('status', isset($val) ? $val['statusNumber'] : null)!!}" selected="selected">{!!isset($val) ? $val['status'] : "Chưa xếp lịch"!!}</option>
                                        </select>
                                    </td>
                                    <td><button type="submit" class="btn btn-default">Xếp lịch</button> </td>
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