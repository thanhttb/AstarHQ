@extends('view.master')
@section('sidebar')
@parent
	This is the sub sidebar
@stop
@section('noidung')
Day la trang sub
</br>
<?php $hoten="<b>TranThanh<b>";
//{{}} va {!!!!!} Thay the cho echo 
?>
{{$hoten}}
</br>
{!!$hoten!!}

</br>
<?php $diem=8; ?>
@if($diem<=7)
	Hoc Sinh Trung Binh
@endif
@if($diem>=7)
	Hoc Sinh Gioi
@endif

</br>
{{isset($diem)? $diem:'Khong co diem'}}

</br>
