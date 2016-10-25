
@extends('admin.master')
@section('content')
    <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                   
                        <h1 class="page-header">Ngày 
                            <small>Sửa</small>                     
                        

                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="{!!URL::route('admin.day.postEdit',$id)!!}" method="POST" >
                            
                           
                            <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                            <div class="form-group">
                                <label>Ngày</label>                             

                                
                                <input class="form-control" type="date" name="day" value="{!!old('day',isset($day) ? $day['day'] : null)!!}">
                               <!-- <select class="form-control">
                                    <option value="0">Please Choose Category</option>
                                    <option value="">Tin Tức</option>
                                </select>-->
                            </div>

                            <div class="form-group">
                                <label>Giáo viên</label>
                                
                                <select name="teacher" class="form-control">
                                    @foreach($teacher as $tec)
                                        <option value="{!!$tec['teacherNumber']!!}">{!!$tec['teacherName']!!}</option>
                                    @endforeach
                                        <option selected value="{!!$day['teacherNumber']!!}">{!!$day['teacherName']!!}</option>
                                </select>
                            </div>                           
                            
                            <div class="form-group">
                                <label>Học phí</label>
                                <input type="number"class='form-control' name="tuition" value="{!!old('tuition',isset($day) ? $day['tuition'] : null)!!}">
                            </div>
                            
                            
                            
                         

                            <button type="  " class="btn btn-default">Lưu</button>

                        <form>
                    </div>

                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->            
                @endsection()