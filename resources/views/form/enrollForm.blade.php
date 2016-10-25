<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Enroll</title>
</head>
<body>

@if(count($errors)>0)

@endif

	<form action="{!!route('efinish')!!}" method="POST" name="enrollForm">
		<input type="hidden" name="_token" value="{!!csrf_token()!!}">
		<h3>THÔNG TIN HỌC SINH</h3> 
		<table>
			<tr>
				<td>Họ đệm*</td>
				<td><input type="text" name="lastName"></td>
				<td>{!!$errors->first('lastName')!!}</td>
			</tr>
			<tr>
				<td>Tên*</td>
				<td><input type="text" name="firstName"></td>
				<td>{!!$errors->first('firstName')!!}</td>
			</tr>
			<tr>
				<td>Họ tên Phụ huynh*</td>
				<td><input type="text" name="parentName"></td>
				<td>{!!$errors->first('parentName')!!}</td>
			</tr>
			<tr>
				<td>Điện thoại phụ huynh*</td>
				<td><input type="tel" name="parentPhone"></td>
				<td>{!!$errors->first('parentName')!!}</td>
			</tr>
			<tr>
				<td>Khối lớp*</td>
				<td>
					<select name="class">
						<option value=1>Lớp 1</option><option value=2>Lớp 2</option><option value=3>Lớp 3</option><option value=4>Lớp 4</option><option value=5>Lớp 5</option><option value=6>Lớp 6</option><option value=7>Lớp 7</option><option value=8>Lớp 8</option><option value=9>Lớp 9</option><option value=10>Lớp 10</option><option value=11>Lớp 11</option><option value=12>Lớp 12</option><option selected="selected"></option>
					</select>
				</td>
			</tr>
			<tr>
				<td><h3>NGUYỆN VỌNG</h3></t3>
			</tr>
			<tr>
				<td>Môn học </td>
				<td><input type="checkbox" name="cbToan" value="Toán"> Toán</td>					
				<td>Lịch kiểm tra đầu vào môn Toán</td>
				<td><input type="date" name="DateTestT"></td>					
						
			</tr>
			<tr>
				<td></td>
				<td><input type="checkbox" name="cbLy" value="Lý"> Lý</td>
				<td>Lịch kiểm tra đầu vào môn Lý</td>
				<td><input type="date" name="DateTestL"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="checkbox" name="cbHoa" value="Hóa">Hóa</td>
				<td>Lịch kiểm tra đầu vào môn Hóa</td>
				<td><input type="date" name="DateTestH"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="checkbox" name="cbVan" value="Văn">Văn</td>
				<td>Lịch kiểm tra đầu vào môn Văn</td>
				<td><input type="date" name="DateTestV"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="checkbox" name="cbAnh" value="Anh">Anh</td>
				<td>Lịch kiểm tra đầu vào môn Anh</td>
				<td><input type="date" name="DateTestA"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="checkbox" name="cbSinh" value="Sinh">Sinh</td>
				<td>Lịch kiểm tra đầu vào môn Sinh</td>
				<td><input type="date" name="DateTestSi"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="checkbox" name="cbSu" value="Sử">Sử</td>
				<td>Lịch kiểm tra đầu vào môn Sử</td>
				<td><input type="date" name="DateTestSu"></td>
			</tr>
			<tr>	
				<td></td>			
				<td><input type="checkbox" name="cbDia" value="Địa">Địa</td>
				<td>Lịch kiểm tra đầu vào môn Địa</td>
				<td><input type="date" name="DateTestD"></td>
			</tr>
			
			<tr>
				<td>Ghi chú</td>
				<td><input type="textarea" name="txtnote"></td>
			</tr>
			<tr>
				<td>Trạng Thái</td>
				<td><select name="status">
					<option value="1">Chưa hẹn lịch</option>
					<option value="2">Đã hẹn lịch kiểm tra</option>
					<option value="3">Đã kiểm tra</option>
					<option value="4">Đã có kết quả</option>
					<option value="5">Đã thông báo phụ huynh</option>
					<option value="6">Đã xếp lớp</option>
					<option selected="selected"></option>
				</select></td>
			</tr>
			<tr>
				
				<td><input type="submit" name="sub" value="Save & New"></td>
			</tr>
		</table>


	</form> 
</body>
</html>