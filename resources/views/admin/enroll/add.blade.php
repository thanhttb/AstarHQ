
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
                <form action="{!!route('admin.enroll.postAdd')!!}" method="POST" >

                    <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                     <h3>THÔNG TIN HỌC SINH</h3> 
                    <div class="form-group">
                        <label>Họ đệm*</label>
                        {!!$errors->first('lastName')!!}
                        <input class="form-control" name="lastName" placeholder="Xin nhập họ đệm" />
                       <!-- <select class="form-control">
                            <option value="0">Please Choose Category</option>
                            <option value="">Tin Tức</option>
                        </select>-->
                    </div>
                    <div class="form-group">
                        <label>Tên*</label>
                        {!!$errors->first('firstName')!!}
                        <input class="form-control" name="firstName" placeholder="Xin nhập tên" />
                    </div>
                    <div class="form-group">
                        <label>Họ tên Phụ Huynh*</label>
                         {!!$errors->first('parentName')!!}

                        <input class="form-control" name="parentName" placeholder="Xin nhập tên phụ huynh" />
                    </div>
                    <div class="form-group">
                        <label>Số điện thoại Phụ huynh*</label>
                         {!!$errors->first('parentPhone')!!}

                        <input class="form-control" name="parentPhone" placeholder="Xin nhập số điện thoại phụ huynh" />
                    </div>
                    <div class="form-group">
                        <label>Khối lớp*</label>
                        {!!$errors->first('class')!!}
                        <select class='form-control' name="class">


                            <option value=1>Lớp 1</option><option value=2>Lớp 2</option><option value=3>Lớp 3</option><option value=4>Lớp 4</option><option value=5>Lớp 5</option><option value=6>Lớp 6</option><option value=7>Lớp 7</option><option value=8>Lớp 8</option><option value=9>Lớp 9</option><option value=10>Lớp 10</option><option value=11>Lớp 11</option><option value=12>Lớp 12</option><option selected="selected"></option>

                        </select>
                    </div>


                    <h3>NGUYỆN VỌNG</h3>
                    <div >
                        <label></label>
                        <table class="table table-striped table-bordered table-hover" style="width:1000px" >
                            <thead>
                                <tr align="center">
                                    <th>Môn học</th>
                                    <th>Lịch kiểm tra đầu vào</th>
                                    <th>Ghi chú</th>
                                    <th>Trạng thái</th>
                                    <th>Xếp lớp ngay</th>
                                </tr>

                            </thead>


                            <tbody>
                                <tr>
                               
                                <td><input type="checkbox" name="cbToan" value="Toán"> Toán </td>            
                                <td><input type="date" name="DateTestT"></td>
                                <td><textarea class="form-control" rows="2" name="noteT"></textarea></td>
                                <td>
                                     <select class="form-control" name="statusT">
                                         <option selected value="1">Chưa hẹn lịch</option>
                                        <option value="2">Đã hẹn lịch kiểm tra</option>
                                        <option value="3">Đã kiểm tra</option>
                                        <option value="4">Đã có kết quả</option>
                                        <option value="5">Đã thông báo phụ huynh</option>
                                        <option value="6">Đã xếp lớp</option>
                                        
                                    </select>  
                                </td>
                                <td>
                                    <select class="form-control" name="idLophocT">
                                            
                                             @foreach($xeplop as $xl)    
                                                @if($xl['subjectNumber']==1){
                                                    <option value="{!!$xl['classNumber']!!}">{!!$xl['className']!!}</option>
                                                }
                                                @endif                                          
                                                
                                             @endforeach
                                             <option selected="selected">Chọn lớp</option>
                                         </select>   
                                </td>      
                            </tr>
                            <tr >
                                
                                <td><input type="checkbox" name="cbLy" value="Lý"> Lý </td>                                  
                                <td><input type="date" name="DateTestL"></td>
                                <td><textarea class="form-control" rows="2" name="noteL"></textarea></td>
                                <td>
                                     <select class="form-control" name="statusL">
                                         <option selected value="1">Chưa hẹn lịch</option>
                                        <option value="2">Đã hẹn lịch kiểm tra</option>
                                        <option value="3">Đã kiểm tra</option>
                                        <option value="4">Đã có kết quả</option>
                                        <option value="5">Đã thông báo phụ huynh</option>
                                        <option value="6">Đã xếp lớp</option>
                                        
                                    </select>  
                                </td>
                                <td>
                                    <select class="form-control" name="idLophocL">
                                            <option selected="selected">Chọn lớp</option>
                                             @foreach($xeplop as $xl)                                             
                                                @if($xl['subjectNumber']==2){
                                                    <option value="{!!$xl['classNumber']!!}">{!!$xl['className']!!}</option>
                                                }
                                                @endif
                                             @endforeach
                                    </select>    
                                </td> 
                            </tr>
                            <tr >
                     
                                <td><input type="checkbox" name="cbHoa" value="Hóa"> Hóa </td>
                                <td><input type="date" name="DateTestH"></td>
                                <td><textarea class="form-control" rows="2" name="noteH"></textarea></td>
                                <td>
                                     <select class="form-control" name="statusH">
                                         <option selected value="1">Chưa hẹn lịch</option>
                                        <option value="2">Đã hẹn lịch kiểm tra</option>
                                        <option value="3">Đã kiểm tra</option>
                                        <option value="4">Đã có kết quả</option>
                                        <option value="5">Đã thông báo phụ huynh</option>
                                        <option value="6">Đã xếp lớp</option>
                                    </select>  
                                </td>
                                <td>
                                    <select class="form-control" name="idLophocH">
                                            <option selected="selected">Chọn lớp</option>
                                             @foreach($xeplop as $xl)                                             
                                                @if($xl['subjectNumber']==3){
                                                    <option value="{!!$xl['classNumber']!!}">{!!$xl['className']!!}</option>
                                                }
                                                @endif
                                             @endforeach
                                    </select>    
                                </td> 
                               
                            </tr>
                            <tr >
                                
                                <td><input type="checkbox" name="cbVan" value="Văn"> Văn       </td>                                        
                                <td><input type="date" name="DateTestV"></td>
                                <td><textarea class="form-control" rows="2" name="noteV"></textarea></td>
                               <td>
                                     <select class="form-control" name="statusV">
                                         <option selected value="1">Chưa hẹn lịch</option>
                                        <option value="2">Đã hẹn lịch kiểm tra</option>
                                        <option value="3">Đã kiểm tra</option>
                                        <option value="4">Đã có kết quả</option>
                                        <option value="5">Đã thông báo phụ huynh</option>
                                        <option value="6">Đã xếp lớp</option>
                                        
                                    </select>  
                                </td>
                                <td>
                                    <select class="form-control" name="idLophocV">
                                            <option selected="selected">Chọn lớp</option>
                                             @foreach($xeplop as $xl)                                             
                                                @if($xl['subjectNumber']==4){
                                                    <option value="{!!$xl['classNumber']!!}">{!!$xl['className']!!}</option>
                                                }
                                                @endif
                                             @endforeach
                                    </select>    
                                </td> 
                            </tr>
                            <tr >
                         
                                <td><input type="checkbox" name="cbAnh" value="Anh"> Anh </td>
                                
                                <td><input type="date" name="DateTestA"></td>
                                <td><textarea class="form-control" rows="2" name="noteA"></textarea></td>
                                <td>
                                     <select class="form-control" name="statusA">
                                         <option selected value="1">Chưa hẹn lịch</option>
                                        <option value="2">Đã hẹn lịch kiểm tra</option>
                                        <option value="3">Đã kiểm tra</option>
                                        <option value="4">Đã có kết quả</option>
                                        <option value="5">Đã thông báo phụ huynh</option>
                                        <option value="6">Đã xếp lớp</option>
                                        
                                    </select>  
                                </td>
                                <td>
                                    <select class="form-control" name="idLophocA">
                                            <option selected="selected">Chọn lớp</option>
                                             @foreach($xeplop as $xl)                                             
                                                @if($xl['subjectNumber']==5){
                                                    <option value="{!!$xl['classNumber']!!}">{!!$xl['className']!!}</option>
                                                }
                                                @endif
                                             @endforeach
                                    </select>    
                                </td> 
                            </tr>
                            <tr >
                               
                                <td><input type="checkbox" name="cbSinh" value="Sinh">     Sinh </td>
                                
                                <td><input type="date" name="DateTestSi"></td>
                                <td><textarea class="form-control" rows="2" name="noteSi"></textarea></td>
                                <td>
                                     <select class="form-control" name="statusSi">
                                         <option selected value="1">Chưa hẹn lịch</option>
                                        <option value="2">Đã hẹn lịch kiểm tra</option>
                                        <option value="3">Đã kiểm tra</option>
                                        <option value="4">Đã có kết quả</option>
                                        <option value="5">Đã thông báo phụ huynh</option>
                                        <option value="6">Đã xếp lớp</option>
                                       
                                    </select>  
                                </td>
                                <td>
                                    <select class="form-control" name="idLophocSi">
                                            <option selected="selected">Chọn lớp</option>
                                             @foreach($xeplop as $xl)                                             
                                                @if($xl['subjectNumber']==6){
                                                    <option value="{!!$xl['classNumber']!!}">{!!$xl['className']!!}</option>
                                                }
                                                @endif
                                             @endforeach
                                    </select>    
                                </td> 
                            </tr>
                            <tr>
                                
                                <td><input type="checkbox" name="cbSu" value="Sử"> Sử </td>
                                
                                <td><input type="date" name="DateTestSu"></td>
                                <td><textarea class="form-control" rows="2" name="noteSu"></textarea></td>
                                <td>
                                     <select class="form-control" name="statusSu">
                                         <option selected value="1">Chưa hẹn lịch</option>
                                        <option value="2">Đã hẹn lịch kiểm tra</option>
                                        <option value="3">Đã kiểm tra</option>
                                        <option value="4">Đã có kết quả</option>
                                        <option value="5">Đã thông báo phụ huynh</option>
                                        <option value="6">Đã xếp lớp</option>
                                       
                                    </select>  
                                </td>
                                <td>
                                    <select class="form-control" name="idLophocSu">
                                            <option selected="selected">Chọn lớp</option>
                                             @foreach($xeplop as $xl)                                             
                                                @if($xl['subjectNumber']==7){
                                                    <option value="{!!$xl['classNumber']!!}">{!!$xl['className']!!}</option>
                                                }
                                                @endif
                                             @endforeach
                                    </select>    
                                </td> 
                            </tr >
                            <tr>    
                                      
                                <td><input type="checkbox" name="cbDia" value="Địa"> Địa </td>
                                
                                <td><input type="date" name="DateTestD"></td>
                                <td><textarea class="form-control" rows="2" name="noteD"></textarea></td>
                                <td>
                                     <select class="form-control" name="statusD">
                                         <option selected value="1">Chưa hẹn lịch</option>
                                        <option value="2">Đã hẹn lịch kiểm tra</option>
                                        <option value="3">Đã kiểm tra</option>
                                        <option value="4">Đã có kết quả</option>
                                        <option value="5">Đã thông báo phụ huynh</option>
                                        <option value="6">Đã xếp lớp</option>
                                        
                                    </select>  
                                </td>
                                <td>
                                    <select class="form-control" name="idLophocD">
                                            <option selected="selected">Chọn lớp</option>
                                             @foreach($xeplop as $xl)                                             
                                               @if($xl['subjectNumber']==8){
                                                    <option value="{!!$xl['classNumber']!!}">{!!$xl['className']!!}</option>
                                                }
                                                @endif
                                             @endforeach
                                    </select>    
                                </td> 
                            </tr>
                            </tbody>
                                
                        </table>
                    </div> 

                    

                    <button type="submit" class="btn btn-default">Ghi danh</button>
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