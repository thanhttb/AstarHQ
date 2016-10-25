<!DOCTYPE html>
<html>
<head>
	<title>TranThanh- Laravel
			
	</title>
	<style type="text/css">
		#wrapper{
			width: 980px;
			height: auto;
			margin:0px auto; 
		}
		#header{width: auto; height: 200px; background: red;}
		#content{width: auto; height: 500px; background: white;}
		#footer{width: auto; height: 200px; background: red;}
	</style>

</head>	
<body>
	
	<div id="wrapper">
		<div id="header">
			@section('sidebar')
				This is the master sidebar
			@show
		</div>
		<div id="content">
			@yield('noidung')
		</div>

		<div id="footer"></div>
	</div>
</body>
</html>