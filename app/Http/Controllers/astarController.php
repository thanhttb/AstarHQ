<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Http\Request;
use App\students;
use App\Enroll;
class astarController extends Controller {

	//
	public function them(Request $request){
		$v=Validator::make($request->all(),[
				'txtName'=>'required',
				'txtphones'=>'required'
			],
			[
				'txtName.required'=>'Vui long nhap ten hoc sinh',
				'txtphones.required'=>'Vui long nhap so dien thoai'
			]
			);
		if($v->fails()){
			return redirect()->back()->withErrors($v->errors());
		}


		$stu=new students;
		$stu->Name=$request->txtName;
		$stu->parentPhone=$request->txtphones;
		$stu->save();
		$id=$stu::max('id');

		$enr=new Enroll;

		if($request->cbMath){
			$enr->studentId=$id;
			$enr->subject=$request->cbMath;
			$enr->save();
		}
		$enr2=new Enroll;
		if($request->cbPhy){
			$enr2->studentId=$id;
			$enr2->subject=$request->cbPhy;
			$enr2->save();
		}
		$enr3=new Enroll;
		if($request->cbChe){
			$enr3->studentId=$id;
			$enr3->subject=$request->cbChe;
			$enr3->save();
		}

		

	}

}

