
@extends('admin.master')
@section('content')
    <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Enroll
                            <small>Add</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="{!!URL::route('admin.enroll.postEdit',$id)!!}" method="POST" >
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
                                <label>Họ tên Phụ Huynh*</label>
                                <input class="form-control" name="parentName" placeholder="Xin nhập tên phụ huynh" value="{!!old('parentName' ,isset($data) ? $data['parentName'] : null)!!}" />
                            </div>
                            <div class="form-group">
                                <label>Số điện thoại Phụ huynh*</label>
                                <input class="form-control" name="parentPhone" placeholder="Xin nhập số điện thoại phụ huynh" value="{!!old('parentPhone' ,isset($data) ? $data['parentPhone1'] : null)!!}"/>
                            </div>
                            <div class="form-group">
                                <label>Khối lớp*</label>
                                <select class='form-control' name="class" >
                                    <option value="1">Lớp 1</option><option value=2>Lớp 2</option><option value=3>Lớp 3</option><option value=4>Lớp 4</option><option value=5>Lớp 5</option><option value=6>Lớp 6</option><option value=7>Lớp 7</option><option value=8>Lớp 8</option><option value=9>Lớp 9</option><option value=10>Lớp 10</option><option value=11>Lớp 11</option><option value=12>Lớp 12</option><option selected="selected" value="{!!old('parentPhone' ,isset($data) ? $data['parentPhone1'] : null)!!}">{!!$data['class']!!}</option>
                                </select>
                            </div>


                            <h3>NGUYỆN VỌNG</h3>
                             <div class="form-group">
                                <label>Môn học</label>
                                <select class='form-control' name="subject" >
                                    <option value="Toán">Toán</option><option value="Lý">Lý</option><option value="Hóa">Hóa</option><option value="Văn">Văn</option><option value="Anh">Anh</option><option value="Sinh">Sinh</option><option value="Sử">Sử</option><option value="Địa">Địa</option><option selected="selected" value="{!!$data['subject']!!}">{!!$data['subject']!!}</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Lịch kiểm tra đầu vào </label>
                                <?php                                    

                                    $ngay= date('Y-m-d',strtotime($data['entranceTestDate']));
                                ?>


                                <input class="form-control" type="date" name="DateTest" value="{!!old('DateTestT' ,isset($data['entranceTestDate']) ? $ngay : null)!!}">

                            </div>
                            
                            <div class="form-group">
                                <label>Ghi chú</label>
                                <textarea class="form-control" rows="3" name="note" value="{!!old('note' ,isset($data) ? $data['note'] : null)!!}"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Kết quả</label>
                                    <input class="form-control" name="result" value="{!!old('result' ,isset($data) ? $data['result'] : null)!!}" />
                            </div>
                            
                            <div class="form-group">
                                <label>Trạng thái</label>
                                <select class="form-control" name="status">
                                    <option value="1">Chưa hẹn lịch</option>
                                    <option value="2">Đã hẹn lịch kiểm tra</option>
                                    <option value="3">Đã kiểm tra</option>
                                    <option value="4">Đã có kết quả</option>
                                    <option value="5">Đã thông báo phụ huynh</option>
                                    <option value="6">Đã xếp lớp</option>
                                    <option selected="selected" value="{!!$data['statusNumber']!!}">{!!$data['status']!!}</option>
                                </select>
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