<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Project thiết kế hệ thống quản lý">
    <meta name="author" content="Team A*">
    <title>ASTAR</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{url('public/admin/bower_components/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{url('public/admin/bower_components/metisMenu/dist/metisMenu.min.css')}}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{url('public/admin/dist/css/sb-admin-2.css')}}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{url('public/admin/bower_components/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

    <!-- DataTables CSS -->
    <link href="{{url('public/admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css')}}" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="{{url('public/admin/bower_components/datatables-responsive/css/dataTables.responsive.css')}}" rel="stylesheet">
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{!!URL::route('admin.dashboard')!!}">ASTAR EDUCATION CENTER</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="{!!URL::route('admin.dashboard')!!}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw"></i><b>GHI DANH</b><span class="fa arrow"></span></a>
                            
                            <ul class="nav nav-second-level">
                                 <li>
                                        <a href="{!!URL::route('admin.enroll.getAdd')!!}">Ghi danh</a>
                                    </li>                                
                                <li>
                                    <a href="{!!URL::route('admin.dashboard')!!}"> Công việc cần xử lý <span class="fa arrow"></span> </a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="{!!URL::route('admin.enroll.chuaxeplich')!!}">Học sinh chưa xếp lịch</a>
                                        </li>
                                        <li>
                                            <a href="{!!URL::route('admin.enroll.kiemtrahomnay')!!}">Học sinh kiểm tra hôm nay</a>
                                        </li>
                                        <li>
                                            <a href="{!!URL::route('admin.enroll.dacoketqua')!!}">Học sinh chờ xếp lớp</a>
                                        </li>
                                    </ul>
                                </li>
                                    
                                <li>
                                    <a href="{!!URL::route('admin.enroll.getList')!!}">Danh sách ghi danh</a>
                                </li>
                               
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw"></i><b>QUẢN LÝ HỌC SINH</b><span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    
                                    <li>
                                        <a href="#">Thêm học sinh</a>
                                        <a href="{!!URL::route('admin.student.getList')!!}">Danh sách học sinh</a>
                                    </li>
                                </ul>
                               
                        </li>
                       
                        <li>
                            <a href="#"><i class="fa fa-fw"></i><b>QUẢN LÝ LỚP HỌC</b><span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    
                                    <li>
                                        <a href="{!!URL::route('admin.class.getAdd')!!}">Thêm lớp học</a>
                                        <a href="{!!URL::route('admin.class.getList')!!}">Danh sách lớp học</a>
                                    </li>
                                </ul>
                               
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw"></i><b>QUẢN LÝ NGÀY HỌC</b><span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    
                                    <li>
                                        <a href="{!!URL::route('admin.day.getClasslist')!!}">Thêm ngày học</a>
                                        <a href="{!!URL::route('admin.day.getClasslist')!!}">Danh sách ngày học</a>
                                    </li>
                                </ul>
                               
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw"></i><b>QUẢN LÝ ĐIỂM DANH</b><span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    
                                    <li>
                                        <a href="{!!URL::route('admin.attendance.getClasslist')!!}">Điểm danh</a>
                                        <a href="{!!URL::route('admin.attendance.getHocbu')!!}">Học bù</a>
                                    </li>
                                </ul>
                               
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-users fa-fw"></i> User<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#">List User</a>
                                </li>
                                <li>
                                    <a href="#">Add User</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

       
                    <!--ĐÂY LÀ PHẦN NỘI DUNG-->
                    @yield('content')

                    <!--ĐÂY LÀ PHẦN NỘI DUNG-->

                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="{{url('public/admin/bower_components/jquery/dist/jquery.min.js')}}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{url('public/admin/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{url('public/admin/bower_components/metisMenu/dist/metisMenu.min.js')}}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{url('public/admin/dist/js/sb-admin-2.js')}}"></script>

    <!-- DataTables JavaScript -->
    <script src="{{url('public/admin/bower_components/DataTables/media/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('public/admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js')}}"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>
</body>

</html>
