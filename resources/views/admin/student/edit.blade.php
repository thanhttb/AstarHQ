
@extends('admin.master')
@section('content')
    <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Student
                            <small>Edit</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="{!!URL::route('admin.student.postEdit',$id)!!}" method="POST" >
                            <input type="hidden" name="test" value="1">
                           
                            <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                            <h3>THÔNG TIN HỌC SINH</h3> 
                            <div class="form-group">
                                <label>Họ đệm*</label>                             

                                {!!$errors->first('lastName')!!}
                                <input class="form-control" name="lastName" placeholder="Xin nhập họ đệm" value="{!!old('lastname' ,isset($data) ? $data['lastName'] : null)!!}" />
                               <!-- <select class="form-control">
                                    <option value="0">Please Choose Category</option>
                                    <option value="">Tin Tức</option>
                                </select>-->
                            </div>

                            <div class="form-group">
                                <label>Tên*</label>
                                {!!$errors->first('firstName')!!}
                                <input class="form-control" name="firstName" placeholder="Xin nhập tên" value="{!!old('firstName' ,isset($data) ? $data['firstName'] : null)!!}" />
                            </div>
                             <div class="form-group">
                                <label>Khối lớp*</label>
                                <select class='form-control' name="class" >
                                    <option value="1">Lớp 1</option><option value=2>Lớp 2</option><option value=3>Lớp 3</option><option value=4>Lớp 4</option><option value=5>Lớp 5</option><option value=6>Lớp 6</option><option value=7>Lớp 7</option><option value=8>Lớp 8</option><option value=9>Lớp 9</option><option value=10>Lớp 10</option><option value=11>Lớp 11</option><option value=12>Lớp 12</option><option selected="selected" value="{!!old('parentPhone' ,isset($data) ? $data['parentPhone1'] : null)!!}">{!!$data['class']!!}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Trường</label>
                                
                                <input class="form-control" name="school" placeholder="Xin nhập trường" value="{!!old('school' ,isset($data) ? $data['school'] : null)!!}" />
                            </div>
                            <div class="form-group">
                                <label>Ngày sinh</label>
                                <?php
                                    
                                    $newDate=date('Y-m-d', strtotime($data['birthday']));
                                    if(is_null($newDate)) $newDate="0000-00-00"; 
                                 ?>
                                <input type="date" name="birthday" class="form-control" value="{!!old('birthday', isset($data['birthday'])? $newDate : null)!!}">
                            </div>
                            <div class="form-group">
                                <label>Giới tính</label>
                                @if($data['gender']=="female")
                                    <input type="radio" name="gender" value="{!!old('gender', isset($data) ? $data['gender'] : "female")!!}"> Nữ <br>
                                    <input class="form-control"  type="radio" name="gender" value="male"> Nam<br>
                                
                                @elseif($data['gender']=="male")
                                    <input class="form-control" type="radio" name="gender" value="{!!old('gender', isset($data)? $data['gender'] : "male")!!}"> Nam <br>
                                    <input  class="form-control"  type="radio" name="gender" value="female"> Nữ<br>
                                @elseif($data['gender']=="")
                                    <input class="form-control" type="radio" name="gender" value="male"> Nam
                                    <input  class="form-control"  type="radio" name="gender" value="female"> Nữ
                                @endif

                            </div>
                            <div class="form-group">
                                <label>Số điện thoại học sinh</label>
                                <input class="form-control" name="phone" placeholder="Xin nhập số điện thoại" value="{!!old('phone ' ,isset($data) ? $data['phone'] : null)!!}"/>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" name="email" placeholder="Xin nhập email" value="{!!old('email' ,isset($data) ? $data['email'] : null)!!}"/>
                            </div>
                            <h3>Thông tin phụ huynh</h3>
                            <div class="form-group">
                                <label>Họ tên Phụ Huynh*</label>
                                <input class="form-control" name="parentName" placeholder="Xin nhập tên phụ huynh" value="{!!old('parentName' ,isset($data) ? $data['parentName'] : null)!!}" />
                            </div>
                            <div class="form-group">
                                <label>Số điện thoại Phụ huynh*</label>
                                <input class="form-control" name="parentPhone" placeholder="Xin nhập số điện thoại phụ huynh" value="{!!old('parentPhone' ,isset($data) ? $data['parentPhone1'] : null)!!}"/>
                            </div>
                            <div class="form-group">
                                <label>Số điện thoại Phụ huynh*</label>
                                <input class="form-control" name="parentPhone2" placeholder="Xin nhập số điện thoại phụ huynh" value="{!!old('parentPhone' ,isset($data) ? $data['parentPhone2'] : null)!!}"/>
                            </div>
                            <div class="form-group">
                                <label>Email Phụ huynh*</label>
                                <input class="form-control" name="parentEmail" placeholder="Xin nhập email phụ huynh" value="{!!old('parentEmail' ,isset($data) ? $data['parentEmail'] : null)!!}"/>
                            </div>
                            <div class="form-group">
                                <label>Nơi công tác</label>
                                <input class="form-control" name="parentWork" placeholder="Xin nhập nơi công tác" value="{!!old('parentWork' ,isset($data) ? $data['parentWork'] : null)!!}"/>
                            </div>
                           


                           

                            <button type=" submit " class="btn btn-default">Lưu</button>

                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->            
                @endsection()