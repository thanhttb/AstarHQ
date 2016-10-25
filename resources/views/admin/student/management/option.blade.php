
@extends('admin.master')
@section('content')
    <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Quản lý học sinh 
                            <small>{!!$student['lastName'].$student['firstName']!!}</small>
                        
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example"  style="border:none">
                       <tr class="odd gradeX" align="center">
                           <td style="border:none">
                               <a href="{!!URL::route('admin.student.management.getTuition',$student['studentNumber'])!!}"><h3>QUẢN LÝ HỌC PHÍ</h3></a>
                           </td>
                           <td  style="border:none">
                               <a href="{!!URL::route('admin.student.management.getResult',$student['studentNumber'])!!}"><h3>QUẢN LÝ KẾT QUẢ HỌC TẬP</h3></a>
                           </td>
                       </tr>
                    </table>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->            
                @endsection()