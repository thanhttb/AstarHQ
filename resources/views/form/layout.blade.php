{!!Form::open(array('route'=>'sendEmail','files'=>true))!!}
{!!Form::label('Hoten','Họ Tên')!!}
{!!Form::text('Hoten','',array('class'=>'input','placeholder'=>'Vui lòng nhập'))!!}</br></br>

{!!Form::label('email','Email')!!}
{!!Form::email('Email','',array('class'=>'input','placeholder'=>'Vui lòng nhập'))!!}
{!!Form::label('Mk','Mật Khẩu')!!}
{!!Form::password('Mat Khau','',array('class'=>'input','placeholder'=>'Vui lòng nhập'))!!}</br></br>

{!!Form::label('GC','Ghi chú')!!}
{!!Form::textarea('GC','',array('class'=>'input','row'=>'5'))!!}</br></br>

{!!Form::label('GT','Giới tính')!!}
{!!Form::radio('rdoGT','Nam',true)!!} Nam 
{!!Form::radio('rdoGT','Nu')!!} Nu </br></br>

{!!Form::label('sltThanhpho','Thành Phố')!!}
{!!Form::select('txtGhichu',array(
  		'hn'=>'Hà Nội',
  		'hcm'=>'TP Hồ Chí Minh',
  		'h'=>"Huế"
),'hcm')!!}</br></br>

{!!Form::label('monhoc','Môn Học')!!}
{!!Form::checkbox('chkMonHoc','Toan')!!}Toán
{!!Form::checkbox('chkMonHoc','Van')!!}Văn
{!!Form::checkbox('chkMonHoc','Lý')!!}Lý</br></br>

{!!Form::hidden('website','Khoapham')!!}
{!!Form::label('hinh','Avatar')!!}
{!!Form::file('fimage')!!}</br></br>

{!!Form:: submit('Submit')!!}
{!!Form:: button('Save')!!}
{!!Form:: reset('Reset')!!}
{!!Form::close()!!}