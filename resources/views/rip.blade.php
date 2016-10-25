<html xmlns="http://www.w3.org/1999/xhtml"><head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Cổng thông tin đào tạo</title>
    <link rel="stylesheet" href="css/general.css" type="text/css">
    <link rel="stylesheet" href="css/layout.css" type="text/css">
    <link rel="stylesheet" href="css/class.css" type="text/css">
    <link href="../css/default.css" rel="stylesheet" type="text/css">
    <style type="text/css">
        .notice
        {
            background: none repeat scroll 0 0 #FFF1A8;
            border-color: -moz-use-text-color #FFF1A8 #AAF1A8;
            border-top: 0 none; /*border-top-left-radius: 0;     border-top-right-radius: 0;*/
            border-radius: 0px 0px 6px 6px;
            color: #000000;
            width: 350px;
            margin: auto;
            height: 25px;
            text-align: center;
            vertical-align: middle;
            padding: 6px 0px;
        }
        .module-title
        {
            margin: auto;
            padding: 5px 10px;
            background: #f5f5f5;
            border-top: none;
            text-align: center;
            text-transform: uppercase;
            color: #099D5E;
            font-size: 13px;
            font-weight: bold;
        }
    </style>

    <script src="../JS/jquery-1.11.3.min.js" type="text/javascript"></script>

    <script type="text/javascript" src="javascripts/scripts.js"></script>

    <script type="text/javascript">
        function winOnload() {
            SMS.reSizeBox('divMain', 'divLeft', 'divRight', 180, 'ifrRight');
            showApp(getCookie("first"), "Help/default.asp");
        }
        function winOnResize() {
            SMS.reSizeBox('divMain', 'divLeft', 'divRight', 180, 'ifrRight');

        }
        var barr = new Array();

        /* Huydq 28 May 2013: Không dùng hàm này vì mỗi lần F5 hoặc reload trang là bị logout. 
        window.onbeforeunload = function()
        {
        ajaxComponent.enviar("login.asp?Logout=logout&sidx=" + Math.random(), null, "", "", "");
        }
        */
        window.onclose =
        function() {
            ajaxComponent.enviar("login.asp?Logout=logout&sidx=" + Math.random(), null, "", "", "");
        }
        function changePass() {

            var url = "../changepass/changepass1.asp"
            var windowFeature = "localtion=no,menubar=no,dialog=yes,top=100,left=400,resizable=no,scrollbars=no,status=yes,width=400,height=200";
            window.open(url, "change pass", windowFeature);
            //$('#ifrRight').attr('src', url);
        }
        function Exit_onclick() {
            parent.window.close();
        }
        function logout() {
            parent.document.location.replace("login.asp?Logout=logout");
        }
        var lastelement = null;
        function SwitchWaitMsgOn(isOn) {
            if (isOn == true) {
                document.getElementById("divWaitMsg").style.display = "block";
            }
            else {
                document.getElementById("divWaitMsg").style.display = "none";
            }

        }
        function showApp(id, app_path) {


            

            SwitchWaitMsgOn(true);
            $('#modTitle').html($('#' + id).attr('title'));
            if (lastelement) {
                lastelement.style.backgroundColor = "";
                lastelement.style.color = "#444";
            }
            if (!crossObj(id)) return
            console.log(id);
            var el = crossObj(id);
            el.style.backgroundColor = "#099d5e"; //#eeeafe
            el.style.color = "#fff";
            lastelement = el;
            if (app_path.substring(0, 7) == "http://")
                crossObj("ifrRight").contentWindow.document.location = app_path;
            else
                crossObj("ifrRight").contentWindow.document.location = "../../" + app_path;
            //Gọi hàm ajax để xóa/ghi người dùng nào đang ở chức năng nào.
            tmp = id.split("_");
            portalModId = tmp[1];
            //ajaxComponent.enviar("PortalCurrentAction.asp?portalModId=" + portalModId, null, "", "", "");
        }

     

        var lastUniv = null;
        function changeUniv(id) {
            tmp = id.split("_");
            activeUniv = tmp[1];
            if (!crossObj(id)) return
            crossObj("ifrRight").contentWindow.document.location = "changeUniv.asp?activeUniv=" + activeUniv;
            //ajaxComponent.enviar("changeUniv.asp?activeUniv=" + activeUniv, null, "", "", "");
            if (lastUniv)
                lastUniv.style.display = "none";
            if (crossObj(id).style.display == "block") {
                crossObj(id).style.display = "none";
            }
            else {
                crossObj(id).style.display = "block";
            }
            lastUniv = crossObj(id);
        }

     
        /////////////////Kiểm tra hết session thì thoát ra///////////////////////
        var callChk;
        var timeCheck = 10 * 60 * 1000;   // 5 phut kiem tra 1 lan
        var txtChk = '';
        var timeBegin = new Date().getTime();
        var timeEnd = new Date().getTime();

        function chkSession() {

            txtChk = ajaxComponent.enviar("chkSession.asp?sid=" + Math.random(), null, "", "", "");
            if (txtChk == "timeout") {
                alert("Phiên làm việc của bạn đã hết! ");
                timeEnd = new Date().getTime();
                c = getCookie(intUserLogedin);
                document.location.replace("login.asp?Logout=logout&cu=" + c);

            }

            else {
                callChk = setTimeout("chkSession()", timeCheck);
            }
        }
        //setTimeout("chkSession()", 1000);
        /////////////////KẾT THÚC Kiểm tra hết session thì thoát ra///////////////////////


        var showOnlineUser;
        function showNumberUserOnline() {
            if (txtChk != "timeout") {
                var number = '19';
                $('#numUserOnline').html(number);
                showOnlineUser = setTimeout("showNumberUserOnline()", timeCheck);
            }
        }
        //setTimeout("showNumberUserOnline()", 1000);



        function whoOnline() {
            showNumberUserOnline();
            var url = "whoOnline.asp?ctid=" + Math.random();
            $('#ifrRight').attr('src', url);
        }
        function ThongBaoOnline() {

            var url = 'ThongBao_BQT.asp?ctid=' + Math.random();
            $('#ifrRight').attr('src', url);


        }
        function readMessage() {
            var url = "../Messages/Receive.asp?sid=" + Math.random();
            $('#ifrRight').attr('src', url);

        }

        //Dành cho người quản trị đơn vị viết thông báo hướng dẫn cho sinh viên
        function createNote() {
            var url = "/help/CreateNote.asp";
            $('#ifrRight').attr('src', url);

        }
    </script>

</head>
<body onload="javascript:winOnload();" onresize="javascript:winOnResize();">
    <div id="divTop">
        
<form name="frmTop" id="frmTop" method="post">
<div id="header">
    <div class="logo">
        <img src="http://dangkyhoc.daotao.vnu.edu.vn/Images/logo.png" height="78" alt="logo vnu">
    </div>
    <div class="header-title">
        <h3>
            CỔNG THÔNG TIN ĐÀO TẠO
        </h3>
        <h4>
            DÀNH CHO <span>
                SINH VIÊN
            </span>
        </h4>
    </div>
    <div class="header-right">
        <div id="headerWelcome">
            Xin chào bạn: <strong>
                Trần Trịnh Bình Thành</strong> [13020389]
</div>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tbody><tr height="25" bgcolor="#FFFFFF"><td colspan="4" align="left" nowrap="" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc; border-left:1px solid #ccc;"><b>&nbsp;&nbsp;&nbsp;&nbsp;HỌC KỲ 2 - 2015-2016. MÃ HỌC KỲ 152</b></td><td colspan="14" align="right" nowrap="" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;"><b>&nbsp;&nbsp;&nbsp;&nbsp;</b></td></tr>
<tr height="20"><td width="10%" align="center" nowrap="" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-left:1px solid #ccc;">&nbsp;&nbsp;1</td><td width="10%" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Mã môn học">&nbsp;&nbsp;INT3508</td><td width="40%" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Môn học">Học máy</td><td width="5%" align="center" nowrap="" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Số tín chỉ">&nbsp;&nbsp;3</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;0</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;F</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;0</td>
                            <td width="5%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;">&nbsp;&nbsp;<img height="22" src="../../Themes/ice/icons/button_edit1.gif" onclick="detailPoint('000703','0','00000005057','020');" title="Chi tiết"></td>
                           
</tr>
<tr height="20"><td width="10%" align="center" nowrap="" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-left:1px solid #ccc;">&nbsp;&nbsp;1</td><td width="10%" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Mã môn học">&nbsp;&nbsp;INT3508</td><td width="40%" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Môn học">&nbsp;&nbsp;Trí tuệ nhân tạo</td><td width="5%" align="center" nowrap="" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Số tín chỉ">&nbsp;&nbsp;3</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;8.3</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;A</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;3.5</td>
                            <td width="5%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;">&nbsp;&nbsp;<img height="22" src="../../Themes/ice/icons/button_edit1.gif" onclick="detailPoint('000703','0','00000005057','020');" title="Chi tiết"></td>
                           
</tr>
<tr height="20"><td width="10%" align="center" nowrap="" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-left:1px solid #ccc;">&nbsp;&nbsp;1</td><td width="10%" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Mã môn học">&nbsp;&nbsp;INT3508</td><td width="40%" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Môn học">&nbsp;&nbsp;Thiết kế hướng đối tượng</td><td width="5%" align="center" nowrap="" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Số tín chỉ">&nbsp;&nbsp;3</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;9.2</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;A+</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;4</td>
                            <td width="5%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;">&nbsp;&nbsp;<img height="22" src="../../Themes/ice/icons/button_edit1.gif" onclick="detailPoint('000703','0','00000005057','020');" title="Chi tiết"></td>
                           
</tr><tr height="20"><td width="10%" align="center" nowrap="" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-left:1px solid #ccc;">&nbsp;&nbsp;1</td><td width="10%" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Mã môn học">&nbsp;&nbsp;INT3508</td><td width="40%" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Môn học">&nbsp;&nbsp;Đồ họa máy tính</td><td width="5%" align="center" nowrap="" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Số tín chỉ">&nbsp;&nbsp;3</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;7.4</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;B</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">3</td>
                            <td width="5%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;">&nbsp;&nbsp;<img height="22" src="../../Themes/ice/icons/button_edit1.gif" onclick="detailPoint('000703','0','00000005057','020');" title="Chi tiết"></td>
                           
</tr><tr height="25" bgcolor="#FFFFFF"><td colspan="4" align="left" nowrap="" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc; border-left:1px solid #ccc;"><b>&nbsp;&nbsp;&nbsp;&nbsp;HỌC KỲ 1 - 2015-2016. MÃ HỌC KỲ 151</b></td><td colspan="14" align="right" nowrap="" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;"><b>&nbsp;&nbsp;&nbsp;&nbsp;</b></td></tr><tr height="20"><td width="10%" align="center" nowrap="" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-left:1px solid #ccc;">&nbsp;&nbsp;1</td><td width="10%" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Mã môn học">&nbsp;&nbsp;MAT1100</td><td width="40%" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Môn học">&nbsp;&nbsp;Tối ưu hóa</td><td width="5%" align="center" nowrap="" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Số tín chỉ">&nbsp;&nbsp;2</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;5.7</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;C</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;2</td>
                            <td width="5%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;">&nbsp;&nbsp;<img height="22" src="../../Themes/ice/icons/button_edit1.gif" onclick="detailPoint('000529','5.7','00000005057','019');" title="Chi tiết"></td>
                           
</tr><tr height="20"><td width="10%" align="center" nowrap="" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-left:1px solid #ccc;">&nbsp;&nbsp;2</td><td width="10%" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Mã môn học">&nbsp;&nbsp;INT2207</td><td width="40%" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Môn học">&nbsp;&nbsp;Cơ sở dữ liệu</td><td width="5%" align="center" nowrap="" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Số tín chỉ">&nbsp;&nbsp;3</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;8.9</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;A</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;3.7</td>
                            <td width="5%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;">&nbsp;&nbsp;<img height="22" src="../../Themes/ice/icons/button_edit1.gif" onclick="detailPoint('000530','8.9','00000005057','019');" title="Chi tiết"></td>
                           
</tr><tr height="20"><td width="10%" align="center" nowrap="" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-left:1px solid #ccc;">&nbsp;&nbsp;3</td><td width="10%" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Mã môn học">&nbsp;&nbsp;ELT2035</td><td width="40%" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Môn học">&nbsp;&nbsp;Tín hiệu và hệ thống</td><td width="5%" align="center" nowrap="" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Số tín chỉ">&nbsp;&nbsp;3</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;9.4</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;A+</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;4</td>
                            <td width="5%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;">&nbsp;&nbsp;<img height="22" src="../../Themes/ice/icons/button_edit1.gif" onclick="detailPoint('000537','1.8','00000005057','019');" title="Chi tiết"></td>
                           
</tr><tr height="20"><td width="10%" align="center" nowrap="" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-left:1px solid #ccc;">&nbsp;&nbsp;4</td><td width="10%" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Mã môn học">&nbsp;&nbsp;PHY1100</td><td width="40%" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Môn học">&nbsp;&nbsp;Cơ - Nhiệt</td><td width="5%" align="center" nowrap="" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Số tín chỉ">&nbsp;&nbsp;3</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;8.2</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;B+</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;3.5</td>
                            <td width="5%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;">&nbsp;&nbsp;<img height="22" src="../../Themes/ice/icons/button_edit1.gif" onclick="detailPoint('000569','8.2','00000005057','019');" title="Chi tiết"></td>
                           
</tr><tr height="20"><td width="10%" align="center" nowrap="" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-left:1px solid #ccc;">&nbsp;&nbsp;5</td><td width="10%" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Mã môn học">&nbsp;&nbsp;BSA2002</td><td width="40%" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Môn học">&nbsp;&nbsp;Nguyên lý marketing</td><td width="5%" align="center" nowrap="" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Số tín chỉ">&nbsp;&nbsp;3</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;7.9</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;B</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;3</td>
                            <td width="5%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;">&nbsp;&nbsp;<img height="22" src="../../Themes/ice/icons/button_edit1.gif" onclick="detailPoint('000795','7.9','00000005057','019');" title="Chi tiết"></td>
                           
</tr><tr height="25" bgcolor="#FFFFFF"><td colspan="4" align="left" nowrap="" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc; border-left:1px solid #ccc;"><b>&nbsp;&nbsp;&nbsp;&nbsp;HỌC KỲ 2 - 2014-2015. MÃ HỌC KỲ 142</b></td><td colspan="14" align="right" nowrap="" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;"><b>&nbsp;&nbsp;&nbsp;&nbsp;</b></td></tr><tr height="20"><td width="10%" align="center" nowrap="" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-left:1px solid #ccc;">&nbsp;&nbsp;1</td><td width="10%" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Mã môn học">&nbsp;&nbsp;INT1050</td><td width="40%" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Môn học">&nbsp;&nbsp;Toán học rời rạc</td><td width="5%" align="center" nowrap="" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Số tín chỉ">&nbsp;&nbsp;4</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;7.5</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;B</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;3</td>
                            <td width="5%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;">&nbsp;&nbsp;<img height="22" src="../../Themes/ice/icons/button_edit1.gif" onclick="detailPoint('000231','7.5','00000005057','018');" title="Chi tiết"></td>
                           
</tr><tr height="20"><td width="10%" align="center" nowrap="" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-left:1px solid #ccc;">&nbsp;&nbsp;2</td><td width="10%" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Mã môn học">&nbsp;&nbsp;PHY1103</td><td width="40%" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Môn học">&nbsp;&nbsp;Điện và Quang</td><td width="5%" align="center" nowrap="" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Số tín chỉ">&nbsp;&nbsp;3</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;8.8</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;A</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;3.7</td>
                            <td width="5%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;">&nbsp;&nbsp;<img height="22" src="../../Themes/ice/icons/button_edit1.gif" onclick="detailPoint('000544','8.8','00000005057','018');" title="Chi tiết"></td>
                           
</tr><tr height="20"><td width="10%" align="center" nowrap="" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-left:1px solid #ccc;">&nbsp;&nbsp;3</td><td width="10%" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Mã môn học">&nbsp;&nbsp;MAT1093</td><td width="40%" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Môn học">&nbsp;&nbsp;Đại số</td><td width="5%" align="center" nowrap="" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Số tín chỉ">&nbsp;&nbsp;4</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;8.5</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;A</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;3.7</td>
                            <td width="5%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;">&nbsp;&nbsp;<img height="22" src="../../Themes/ice/icons/button_edit1.gif" onclick="detailPoint('000547','8.5','00000005057','018');" title="Chi tiết"></td>
                           
</tr><tr height="20"><td width="10%" align="center" nowrap="" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-left:1px solid #ccc;">&nbsp;&nbsp;4</td><td width="10%" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Mã môn học">&nbsp;&nbsp;MAT1095</td><td width="40%" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Môn học">&nbsp;&nbsp;Giải tích 2</td><td width="5%" align="center" nowrap="" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Số tín chỉ">&nbsp;&nbsp;5</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;6.4</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;C</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;2</td>
                            <td width="5%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;">&nbsp;&nbsp;<img height="22" src="../../Themes/ice/icons/button_edit1.gif" onclick="detailPoint('000568','6.4','00000005057','018');" title="Chi tiết"></td>
                           
</tr><tr height="20"><td width="10%" align="center" nowrap="" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-left:1px solid #ccc;">&nbsp;&nbsp;5</td><td width="10%" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Mã môn học">&nbsp;&nbsp;INT2206</td><td width="40%" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Môn học">&nbsp;&nbsp;Nguyên lý hệ điều hành</td><td width="5%" align="center" nowrap="" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Số tín chỉ">&nbsp;&nbsp;3</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;9.2</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;A+</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;4</td>
                            <td width="5%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;">&nbsp;&nbsp;<img height="22" src="../../Themes/ice/icons/button_edit1.gif" onclick="detailPoint('000580','9.2','00000005057','018');" title="Chi tiết"></td>
                           
</tr><tr height="25" bgcolor="#FFFFFF"><td colspan="4" align="left" nowrap="" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc; border-left:1px solid #ccc;"><b>&nbsp;&nbsp;&nbsp;&nbsp;HỌC KỲ 1 - 2014-2015. MÃ HỌC KỲ 141</b></td><td colspan="14" align="right" nowrap="" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;"><b>&nbsp;&nbsp;&nbsp;&nbsp;</b></td></tr><tr height="20"><td width="10%" align="center" nowrap="" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-left:1px solid #ccc;">&nbsp;&nbsp;1</td><td width="10%" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Mã môn học">&nbsp;&nbsp;MAT1094</td><td width="40%" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Môn học">&nbsp;&nbsp;Giải tích 1</td><td width="5%" align="center" nowrap="" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Số tín chỉ">&nbsp;&nbsp;5</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;9.2</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;A+</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;4</td>
                            <td width="5%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;">&nbsp;&nbsp;<img height="22" src="../../Themes/ice/icons/button_edit1.gif" onclick="detailPoint('000550','9.2','00000005057','017');" title="Chi tiết"></td>
                           
</tr><tr height="20"><td width="10%" align="center" nowrap="" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-left:1px solid #ccc;">&nbsp;&nbsp;2</td><td width="10%" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Mã môn học">&nbsp;&nbsp;INT2203</td><td width="40%" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Môn học">&nbsp;&nbsp;Cấu trúc dữ liệu và giải thuật</td><td width="5%" align="center" nowrap="" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Số tín chỉ">&nbsp;&nbsp;3</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;8.3</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;B+</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;3.5</td>
                            <td width="5%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;">&nbsp;&nbsp;<img height="22" src="../../Themes/ice/icons/button_edit1.gif" onclick="detailPoint('000628','8.3','00000005057','017');" title="Chi tiết"></td>
                           
</tr><tr height="25" bgcolor="#FFFFFF"><td colspan="4" align="left" nowrap="" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc; border-left:1px solid #ccc;"><b>&nbsp;&nbsp;&nbsp;&nbsp;HỌC KỲ 2 - 2013-2014. MÃ HỌC KỲ 132</b></td><td colspan="14" align="right" nowrap="" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;"><b>&nbsp;&nbsp;&nbsp;&nbsp;</b></td></tr><tr height="20"><td width="10%" align="center" nowrap="" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-left:1px solid #ccc;">&nbsp;&nbsp;1</td><td width="10%" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Mã môn học">&nbsp;&nbsp;POL1001</td><td width="40%" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Môn học">&nbsp;&nbsp;Tư tưởng Hồ Chí Minh</td><td width="5%" align="center" nowrap="" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Số tín chỉ">&nbsp;&nbsp;2</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;7.2</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;B</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;3</td>
                            <td width="5%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;">&nbsp;&nbsp;<img height="22" src="../../Themes/ice/icons/button_edit1.gif" onclick="detailPoint('000005','7.2','00000005057','016');" title="Chi tiết"></td>
                           
</tr><tr height="20"><td width="10%" align="center" nowrap="" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-left:1px solid #ccc;">&nbsp;&nbsp;2</td><td width="10%" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Mã môn học">&nbsp;&nbsp;FLF1108</td><td width="40%" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Môn học">&nbsp;&nbsp;Tiếng Anh B2</td><td width="5%" align="center" nowrap="" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Số tín chỉ">&nbsp;&nbsp;5</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;10</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;A+</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;4</td>
                            <td width="5%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;">&nbsp;&nbsp;<img height="22" src="../../Themes/ice/icons/button_edit1.gif" onclick="detailPoint('000542','10','00000005057','016');" title="Chi tiết"></td>
                           
</tr><tr height="20"><td width="10%" align="center" nowrap="" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-left:1px solid #ccc;">&nbsp;&nbsp;3</td><td width="10%" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Mã môn học">&nbsp;&nbsp;FLF1109</td><td width="40%" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Môn học">&nbsp;&nbsp;Tiếng Anh C1</td><td width="5%" align="center" nowrap="" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Số tín chỉ">&nbsp;&nbsp;5</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;10</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;A+</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;4</td>
                            <td width="5%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;">&nbsp;&nbsp;<img height="22" src="../../Themes/ice/icons/button_edit1.gif" onclick="detailPoint('000543','10','00000005057','016');" title="Chi tiết"></td>
                           
</tr><tr height="20"><td width="10%" align="center" nowrap="" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-left:1px solid #ccc;">&nbsp;&nbsp;4</td><td width="10%" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Mã môn học">&nbsp;&nbsp;INT1006</td><td width="40%" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Môn học">&nbsp;&nbsp;Tin học cơ sở 4</td><td width="5%" align="center" nowrap="" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Số tín chỉ">&nbsp;&nbsp;3</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;9.8</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;A+</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;4</td>
                            <td width="5%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;">&nbsp;&nbsp;<img height="22" src="../../Themes/ice/icons/button_edit1.gif" onclick="detailPoint('000549','9.8','00000005057','016');" title="Chi tiết"></td>
                           
</tr><tr height="20"><td width="10%" align="center" nowrap="" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-left:1px solid #ccc;">&nbsp;&nbsp;5</td><td width="10%" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Mã môn học">&nbsp;&nbsp;PHI1005</td><td width="40%" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Môn học">&nbsp;&nbsp;Những nguyên lý cơ bản của Chủ nghĩa Mác-Lênin 2</td><td width="5%" align="center" nowrap="" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Số tín chỉ">&nbsp;&nbsp;3</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;5.5</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;C</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;2</td>
                            <td width="5%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;">&nbsp;&nbsp;<img height="22" src="../../Themes/ice/icons/button_edit1.gif" onclick="detailPoint('000868','5.5','00000005057','016');" title="Chi tiết"></td>
                           
</tr><tr height="20"><td width="10%" align="center" nowrap="" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-left:1px solid #ccc;">&nbsp;&nbsp;6</td><td width="10%" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Mã môn học">&nbsp;&nbsp;INT 2202</td><td width="40%" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Môn học">&nbsp;&nbsp;Lập trình nâng cao</td><td width="5%" align="center" nowrap="" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Số tín chỉ">&nbsp;&nbsp;3</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;8.4</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;B+</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;3.5</td>
                            <td width="5%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;">&nbsp;&nbsp;<img height="22" src="../../Themes/ice/icons/button_edit1.gif" onclick="detailPoint('000877','8.4','00000005057','016');" title="Chi tiết"></td>
                           
</tr><tr height="25" bgcolor="#FFFFFF"><td colspan="4" align="left" nowrap="" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc; border-left:1px solid #ccc;"><b>&nbsp;&nbsp;&nbsp;&nbsp;HỌC KỲ 1 - 2013-2014. MÃ HỌC KỲ 131</b></td><td colspan="14" align="right" nowrap="" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;"><b>&nbsp;&nbsp;&nbsp;&nbsp;</b></td></tr><tr height="20"><td width="10%" align="center" nowrap="" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-left:1px solid #ccc;">&nbsp;&nbsp;1</td><td width="10%" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Mã môn học">&nbsp;&nbsp;FLF1106</td><td width="40%" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Môn học">&nbsp;&nbsp;Tiếng Anh A2</td><td width="5%" align="center" nowrap="" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Số tín chỉ">&nbsp;&nbsp;5</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;8.3</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;B+</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;3.5</td>
                            <td width="5%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;">&nbsp;&nbsp;<img height="22" src="../../Themes/ice/icons/button_edit1.gif" onclick="detailPoint('000434','8.3','00000005057','015');" title="Chi tiết"></td>
                           
</tr><tr height="20"><td width="10%" align="center" nowrap="" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-left:1px solid #ccc;">&nbsp;&nbsp;2</td><td width="10%" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Mã môn học">&nbsp;&nbsp;FLF1105</td><td width="40%" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Môn học">&nbsp;&nbsp;Tiếng Anh A1</td><td width="5%" align="center" nowrap="" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Số tín chỉ">&nbsp;&nbsp;4</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;7.8</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;B</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;3</td>
                            <td width="5%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;">&nbsp;&nbsp;<img height="22" src="../../Themes/ice/icons/button_edit1.gif" onclick="detailPoint('000539','7.8','00000005057','015');" title="Chi tiết"></td>
                           
</tr><tr height="20"><td width="10%" align="center" nowrap="" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-left:1px solid #ccc;">&nbsp;&nbsp;3</td><td width="10%" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Mã môn học">&nbsp;&nbsp;FLF1107</td><td width="40%" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Môn học">&nbsp;&nbsp;Tiếng Anh B1</td><td width="5%" align="center" nowrap="" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Số tín chỉ">&nbsp;&nbsp;5</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;8.4</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;B+</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;3.5</td>
                            <td width="5%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;">&nbsp;&nbsp;<img height="22" src="../../Themes/ice/icons/button_edit1.gif" onclick="detailPoint('000541','8.4','00000005057','015');" title="Chi tiết"></td>
                           
</tr><tr height="20"><td width="10%" align="center" nowrap="" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-left:1px solid #ccc;">&nbsp;&nbsp;4</td><td width="10%" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Mã môn học">&nbsp;&nbsp;INT1003</td><td width="40%" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Môn học">&nbsp;&nbsp;Tin học cơ sở 1</td><td width="5%" align="center" nowrap="" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Số tín chỉ">&nbsp;&nbsp;2</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;5.8</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;C</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;2</td>
                            <td width="5%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;">&nbsp;&nbsp;<img height="22" src="../../Themes/ice/icons/button_edit1.gif" onclick="detailPoint('000548','5.8','00000005057','015');" title="Chi tiết"></td>
                           
</tr><tr height="20"><td width="10%" align="center" nowrap="" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;border-left:1px solid #ccc;">&nbsp;&nbsp;5</td><td width="10%" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Mã môn học">&nbsp;&nbsp;PHI1004</td><td width="40%" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Môn học">&nbsp;&nbsp;Những nguyên lý cơ bản của Chủ nghĩa Mác-Lênin 1</td><td width="5%" align="center" nowrap="" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Số tín chỉ">&nbsp;&nbsp;2</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;5.9</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;C</td><td width="10%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;" title="Điểm hệ 10 cuối cùng">&nbsp;&nbsp;2</td>
                            <td width="5%" nowrap="" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;">&nbsp;&nbsp;<img height="22" src="../../Themes/ice/icons/button_edit1.gif" onclick="detailPoint('000867','5.9','00000005057','015');" title="Chi tiết"></td>
                           
</tr><tr height="20"><td width="5%" nowrap="" align="left" colspan="12">&nbsp;<b>Tổng tín chỉ: &nbsp;&nbsp;86</b></td></tr><tr height="20"><td width="5%" nowrap="" align="left" colspan="12">&nbsp;<b>Tổng tín chỉ tích lũy: &nbsp;&nbsp;80</b></td></tr><tr height="20"><td width="5%" nowrap="" align="left" colspan="12">&nbsp;<b>Điểm trung bình tích lũy hệ 4: &nbsp;&nbsp;3.22</b></td></tr>

        </tbody></table>

<script type="text/javascript" language="javascript">

    $(document).ready(function() {
    
        $('li.listAdModGrp').click(function() {
            $('li.listAdModGrp').removeClass('listAdModGrpSelected');
            $(this).addClass('listAdModGrpSelected');
        });
    });
    
</script>


        </div>
        <div id="divRight" style="height: 179px; width: 1180px;">
            <div id="ModuleName" style="width: 100%">
                <div id="modTitle" class="module-title">Kết quả học tập</div>
            </div>
            <div id="divWaitMsg" style="width: 100%; display: none;">
                <div class="notice">
                    <div style="background: url(../images/waiting.gif) no-repeat">
                        <span style="font-size: 10pt; font-weight: bold">Yêu cầu đang được xử lý. Vui lòng đợi...</span>
                    </div>
                </div>
            </div>
            <iframe id="ifrRight" name="ifrRight" frameborder="0" scrolling="auto" src="" style="border: 0px solid rgb(206, 206, 206); padding: 0px 5px; height: 149px; width: 1180px;" __idm_frm__="796"></iframe>
        </div>
        <div style="clear: both; height: 1px;">
        </div>
    </div>
    <div id="footer">
        <div id="footerLeft">
            <span>Số người đang online </span>
            <br>
            <span class="numberOnline" id="numUserOnline">19</span>
            <br>
            
        </div>
        <div class="footerSep">
        </div>
        <div id="footerRight">
            Công thông tin đào tạo ĐHQG Hà Nội - Phát triển bởi Trung tâm Ứng dụng CNTT @2011
            -
            2016
            <br>
            144 đường Xuân Thủy, Quận Cầu Giấy, Hà Nội, Việt Nam
            <br>
            Webmaster: support@vnu.edu.vn
            <br>
        </div>
    </div>



<script language="javascript" type="text/javascript">

    $(document).ready(function() {
        $('#ifrRight').load(function() {
            SwitchWaitMsgOn(false);
        });

        showNumberUserOnline();
        chkSession();
    });

    
   
</script>
