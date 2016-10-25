
@extends('admin.master')
@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Chuyển lớp
                    <small></small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                <form action="{!!route('admin.student.postChuyenlop',$data['studentNumber'])!!}" method="POST" >

                    <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                    <div class="form-group">
                                <label>Họ đệm*</label>
                                
                                <input class="form-control" name="lastName" placeholder="Xin nhập họ đệm" value="{!!old('lastname' ,isset($data) ? $data['lastName'] : null)!!}" />
                               <!-- <select class="form-control">
                                    <option value="0">Please Choose Category</option>
                                    <option value="">Tin Tức</option>
                                </select>-->
                            </div>

                            <div class="form-group">
                                <label>Tên*</label>                                
                                <input class="form-control" name="firstName" placeholder="Xin nhập tên" value="{!!old('firstName' ,isset($data) ? $data['firstName'] : null)!!}" />
                            </div>
                             <div class="form-group">
                                <label>Khối lớp*</label>
                                <select class='form-control' name="class" >
                                    <option value="1">Lớp 1</option><option value=2>Lớp 2</option><option value=3>Lớp 3</option><option value=4>Lớp 4</option><option value=5>Lớp 5</option><option value=6>Lớp 6</option><option value=7>Lớp 7</option><option value=8>Lớp 8</option><option value=9>Lớp 9</option><option value=10>Lớp 10</option><option value=11>Lớp 11</option><option value=12>Lớp 12</option><option selected="selected" value="{!!old('parentPhone' ,isset($data) ? $data['parentPhone1'] : null)!!}">{!!$data['class']!!}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="class">
                                            <option selected="selected">Chọn lớp</option>
                                             @foreach($class as $cl)                                               
                                                <option value="{!!$cl['classNumber']!!}">{!!$cl['className']!!}</option>
                                             @endforeach
                                         </select>    
                            </div>


                    
                    

                    <button type="submit" class="btn btn-default">Đăng ký</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                <form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->            
        @endsection()