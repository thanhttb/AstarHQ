
@extends('admin.master')
@section('content')
    <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                    @foreach($data as $val)
                        <h1 class="page-header">Lớp {!!$val['className']!!}
                            <small>Sửa</small>                     
                        

                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="{!!URL::route('admin.class.postEdit',$id)!!}" method="POST" >
                            <input type="hidden" name="test" value="1">
                           
                            <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                            <div class="form-group">
                                <label>Tên lớp</label>                             

                                {!!$errors->first('className')!!}
                                <input class="form-control" name="className" placeholder="Xin nhập tên lớp" value="{!!old('className' ,isset($val) ? $val['className'] : null)!!}" />
                               <!-- <select class="form-control">
                                    <option value="0">Please Choose Category</option>
                                    <option value="">Tin Tức</option>
                                </select>-->
                            </div>

                            <div class="form-group">
                                <label>Miêu tả</label>
                                {!!$errors->first('description')!!}
                                <input class="form-control" name="description" placeholder="Xin nhập miêu tả" value="{!!old('description' ,isset($val) ? $val['description'] : null)!!}" />
                            </div>
                           
                            <div class="form-group">
                                <label>Khối lớp*</label>
                                <select class='form-control' name="class" >
                                    <option value=1>Lớp 1</option><option value=2>Lớp 2</option><option value=3>Lớp 3</option><option value=4>Lớp 4</option><option value=5>Lớp 5</option><option value=6>Lớp 6</option><option value=7>Lớp 7</option><option value=8>Lớp 8</option><option value=9>Lớp 9</option><option value=10>Lớp 10</option><option value=11>Lớp 11</option><option value=12>Lớp 12</option><option selected="selected" value="{!!$val['class']!!}">Lớp {!!$val['class']!!}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Môn học</label>
                                <select class='form-control' name="subject" >
                                   @foreach($subject as $sub)
                                        <option value="{!!$sub->subjectNumber!!}">{!!$sub->subjectName!!}</option>
                                   @endforeach
                                   <option selected="selected" value="{!!$val['subjectNumber']!!}"> {!!$val['subjectName']!!}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Giáo viên 1</label>
                                <select class='form-control' name="teacher" >
                                   @foreach($teacher as $tec)
                                        <option value="{!!$tec->teacherNumber!!}">{!!$tec->teacherName!!}</option>
                                   @endforeach
                                   <option selected="selected" value="{!!$val['teacherNumber']!!}"> {!!$val['teacherName']!!}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Giáo viên 2</label>
                                <select class='form-control' name="teacher2" >
                                   @foreach($teacher as $tec)
                                        <option value="{!!$tec->teacherNumber!!}">{!!$tec->teacherName!!}</option>
                                   @endforeach
                                   <option selected="selected" value="{!!$val['teacherNumber']!!}"> {!!$val['teacherName']!!}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Thứ</label>
                                <input class='form-control' name="day" value="{!!old('day',isset($val) ? $val['day'] : null)!!}">
                            </div>
                            <div class="form-group">
                                <label>Giờ bắt đầu</label>
                                <input class='form-control' name="startTime" value="{!!old('startTime',isset($val) ? $val['startTime'] : null)!!}">
                            </div>
                            <div class="form-group">
                                <label>Giờ kết thúc</label>
                                <input class='form-control' name="endTime" value="{!!old('endTime',isset($val) ? $val['endTime'] : null)!!}">
                            </div>
                            <div class="form-group">
                                <label>Học phí</label>
                                <input class='form-control' name="tuition" value="{!!old('tuition',isset($val) ? $val['tuition'] : null)!!}">
                            </div>
                            
                            
                            
                         

                            <button type="  " class="btn btn-default">Lưu</button>

                        <form>
                    </div>
                    @endforeach
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->            
                @endsection()