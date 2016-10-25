@extends('admin.master')
@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Lớp học
                    <small>Thêm</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                <form action="{!!route('admin.class.postAdd')!!}" method="POST" >

                    <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                    
                    <div class="form-group">
                        <label>Tên lớp</label>
                       {!!$errors->first('className')!!}-
                        <input class="form-control" name="className" placeholder="Xin nhập tên lớp" />
                      
                    </div>
                    <div class="form-group">
                        <label>Miêu tả</label>
                         {!!$errors->first('description')!!}
                        <input class="form-control" name="description" placeholder="Xin nhập miêu tả lớp" />
                    </div>
                    
                    <div class="form-group">
                        <label>Khối lớp</label>
                        <select class='form-control' name="class">
                            <option value=1>Lớp 1</option><option value=2>Lớp 2</option><option value=3>Lớp 3</option><option value=4>Lớp 4</option><option value=5>Lớp 5</option><option value=6>Lớp 6</option><option value=7>Lớp 7</option><option value=8>Lớp 8</option><option value=9>Lớp 9</option><option value=10>Lớp 10</option><option value=11>Lớp 11</option><option value=12>Lớp 12</option><option selected="selected"></option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Bộ môn</label>
                        <select class='form-control' name="subject">
                            @foreach($subject as $val)
                            <option value="{!!$val->subjectNumber!!}">{!!$val->subjectName!!}</option>

                            @endforeach
                            <option selected="selected"></option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Giáo viên 1</label>
                        <select class='form-control' name="teacher">
                            @foreach($teacher as $val)
                            <option value="{!!$val->teacherNumber!!}">{!!$val->teacherName!!}</option>
                            @endforeach
                            <option selected="selected"></option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Giáo viên 2</label>
                        <select class='form-control' name="teacher2">
                            @foreach($teacher as $val)
                            <option value="{!!$val->teacherNumber!!}">{!!$val->teacherName!!}</option>
                            @endforeach
                            <option selected="selected"></option>
                        </select>
                    </div>
	                 <label>Ngày</label>
	                 <input class="form-control" name="day" placeholder="Thứ" />                   
	               	  <label>Giờ bắt đầu</label>             
	               	  <input class="form-control" type="time" name="startTime">
                    
                	<label>Giờ kết thúc</label>
                	<input class="form-control" type="time" name="endTime">                    	
             
                
                	<label>Học phí</label>
                	<input class="form-control" type="number" name="tuition">               


                   
                    

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