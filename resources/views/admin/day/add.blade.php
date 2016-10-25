@extends('admin.master')
@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Thêm ngày học lớp {!!$class['className']!!}
                    <small>Thêm</small>
                
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                <form action="{!!URL::route('admin.day.postAdd',$class['classNumber'])!!}" method="POST" >

                    <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                    
                     <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>#</th>
                                <th>Ngày học</th>
                                <th>Giáo viên</th>
                                <th>Học phí</th>
                                <th>Ghi chú</th>                              
                            </tr>
                        </thead>
                        <tbody>
                            <?php $stt=1?>
                            @for($stt;$stt<=30;$stt++)                            
                            <tr class="odd gradeX" align="center">
                                <td>{!!$stt!!}</td>
                                <td>
                                    <input class="form-controll" type="date" name="{!!"date".$stt!!}">
                                </td> 
                                <td>
                                    <select class="form-control" name="{!!"teacher".$stt!!}">
                                            @foreach($teacher as $tec)
                                                <option value="{!!$tec['teacherNumber']!!}">{!!$tec['teacherName']!!}</option>
                                            @endforeach
                                            <option selected value="{!!$class['teacherNumber']!!}">{!!$class['teacherName']!!}</option>
                                    </select>
                                </td>
                                <td>
                                    <input class="form-control" type="number" name="{!!"tuition".$stt!!}" value="{!!old("tuition"+$stt, isset($class) ? $class['tuition'] : null)!!}">

                                </td>
                                <td>
                                    <textarea name="{!!"note".$stt!!}"></textarea>
                                </td>
                            </tr>
                           @endfor
                        </tbody>
                    </table>
                    

                    <button type="submit" class="btn btn-default">Đăng ký</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                </form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->            
        @endsection()