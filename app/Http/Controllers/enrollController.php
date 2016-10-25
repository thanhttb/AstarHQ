<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Datetime;
use Illuminate\Http\Request;
use App\Http\Requests\StudentRequest;
use App\Http\Requests\ChuaXepLichRequest;
use App\Http\Requests\ChoxeplopRequest;
use App\enrolls;
use App\status;
use App\students;
use App\classes;
use App\class_student;
use App\attendances;
use App\days;
class enrollController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getDacoketqua(){
		$dacokq=enrolls::where('enrolls.statusNumber','=','4')
					   ->orWhere('enrolls.statusNumber','=','3')
					   ->join('students','students.studentNumber','=','enrolls.studentNumber')
					   ->join('statuses','statuses.statusNumber','=','enrolls.statusNumber')
					   ->get()->toArray();
		$xeplop=classes::all()->toArray();
		return view('admin/enroll/choxeplop',compact('dacokq','xeplop'));
	}	
	public function postXeplop($id, ChoxeplopRequest $request){
		$data=enrolls::find($id);
		$data->result=$request->result;
		//echo $request->result;
		
		if ($request->idLophoc==0) {
			# code...
			if(!is_null($data->result)){
					$data->statusNumber=4;
				}
				$data->save();			
			return redirect()->route('admin.enroll.dacoketqua');
		}
		//echo $request->idLophoc;
		$data->statusNumber=6;
		$data->save();
		$idHocsinh=$data->studentNumber;
		$xeplop=new class_student;
		
		$xeplop->studentNumber=$idHocsinh;
		$xeplop->classNumber=$request->idLophoc;
		$xeplop->start=date('Y-m-d');
		$xeplop->statusNumber=8;
		$xeplop->save();
		
		//Tao diem danh
		$day=days::where('classNumber',$request->idLophoc)->where('day','>=',date('Y-m-d'))->get();
		foreach($day as $val){
			$atd=new attendances;
			$atd->class_studentNumber=$xeplop->id;
			$atd->dayNumber=$val->dayNumber;
			$atd->save();
		}
		return redirect()->route('admin.enroll.dacoketqua');
	}
	public function update($id){
		$daKiemTra=enrolls::find($id);		
		$daKiemTra->statusNumber=3;
		$daKiemTra->save();
		return redirect()->route('admin.enroll.kiemtrahomnay');
	}
	public function getKiemtrahomnay(){
		//$tomorrow=new datetime('tomorrow');
		$today= date('Y-m-d');
		//echo $today;

		$kiemTraHomNay=enrolls::whereDate('enrolls.entranceTestDate','=',$today)
		->where('enrolls.statusNumber','=','2')
		->join('students','students.studentNumber','=','enrolls.studentNumber')
		->join('statuses','statuses.statusNumber','=','enrolls.statusNumber')
		->get();
		return view('admin.enroll.kiemtrahomnay',compact('kiemTraHomNay'));
		
		}
	public function postDaxeplich($id, ChuaXepLichRequest $request){
		$daxeplich=enrolls::find($id);
		if($request->entranceDate==''){
			$daxeplich->entranceTestDate=NULL;
		}
		else $daxeplich->entranceTestDate=$request->entranceDate;
		
		$daxeplich->note 			=$request->note;
		$daxeplich->statusNumber	=$request->status;
		$daxeplich->save();
		return redirect()->route('admin.enroll.chuaxeplich');
	}
	public function getChuaxeplich(){
		$tomorrow=new datetime('tomorrow');
		$today= date('Y-m-d');
		$chuaXepLich=enrolls::where('enrolls.statusNumber','<=','1')->orWhereNull('enrolls.entranceTestDate')
		->orWhere('enrolls.entranceTestDate','=','')
		->join('students','students.studentNumber','=','enrolls.studentNumber')
		->join('statuses','statuses.statusNumber','=','enrolls.statusNumber')
		->get()->toArray();

		return view('admin.enroll.chuaxeplich',compact('chuaXepLich'));
	}

	
	public function getList(){
		$data=enrolls::join('students','students.studentNumber','=','enrolls.studentNumber')
					->join('statuses','statuses.statusNumber','=','enrolls.statusNumber')
					->orderBy('enrollNumber','DESC')->get();

		return view('admin.enroll.list',compact('data'));
	}
	public function getEdit($id){
		//echo $id;
		$edit=enrolls::where('enrollNumber',$id)
		->join('students','students.studentNumber','=','enrolls.studentNumber')
		->join('statuses','statuses.statusNumber','=','enrolls.statusNumber')
		->get()->toArray();
		$data=$edit[0];
		return view('admin.enroll.edit',compact('data','id'));
	}
	// Nhận request từ Form Enroll

	public function postEdit($id,StudentRequest $request){
		echo $request->class;
		$edit=enrolls::where('enrollNumber',$id)
		->join('students','students.studentNumber','=','enrolls.studentNumber')
		->join('statuses','statuses.statusNumber','=','enrolls.statusNumber')
		->get()->toArray();
		//echo $request->test;
		$data=$edit[0];
		//print_r($data);
		$stu=students::find($data['studentNumber']);
		$stu->lastName=$request->lastName;
		$stu->firstName=$request->firstName;
		$stu->parentName=$request->parentName;
		$stu->parentPhone1=$request->parentPhone;
		$stu->class=$request->class;
		$stu->save();

		$enr=enrolls::find($id);
		$enr->studentNumber=$data['studentNumber'];
		$enr->subject=$request->subject;

		if ($request->DateTest!=0) {
			# code..
			echo "test";
			$enr->entranceTestDate=$request->DateTest;	
		}
		if ($request->status!=0) {
			# code...
			$enr->statusNumber=$request->status;
		}		
		$enr->note=$request->note;
		$enr->result=$request->result;
		$enr->save();
		return redirect()->route('admin.enroll.getList');
	}
	// Xóa đơn ghi danh theo ID
	public function getDelete($id){
		//echo $id;
		$enroll=enrolls::where('enrollNumber',$id);
		//print_r($enroll);
		$enroll->delete();
		return redirect()->route('admin.enroll.getList');

	}

	public function getAdd(){
		$xeplop=classes::orderby('class')->join('subjects','subjects.subjectNumber','=','classes.subjectNumber')->get()->toArray();
		return view('admin.enroll.add',compact('xeplop'));
	}
	public function postAdd(StudentRequest $request)
	{
		//

		//echo $request->DateTestT;
		$stu=new students;
		$stu->lastName=$request->lastName;
		$stu->firstName=$request->firstName;
		$stu->parentName=$request->parentName;
		$stu->parentPhone1=$request->parentPhone;
		$stu->class=$request->class;
		$stu->save();
		$id=$stu::max('studentNumber');		
		if($request->cbToan){
			//echo $request->DateTestT;
			echo $request->DateTestT;
			echo $request->idLophocT;
			if($request->idLophocT!=0){
				
				$xeplop=new class_student;
				$xeplop->studentNumber=$id;
				$xeplop->classNumber=$request->idLophocT;
				$xeplop->statusNumber=8;
				$xeplop->start=date('Y-m-d');
				$xeplop->save();
				$day=days::where('classNumber',$request->idLophocT)->where('day','>=',date('Y-m-d'))->get();
			}
			else{
				$enrT=new enrolls;
				$enrT->studentNumber=$id;
				$enrT->note=$request->noteT;
				$enrT->subject=$request->cbToan;
				if($request->DateTestT=='')
				{
					$enrT->entranceTestDate=NULL;
				}
				else {$enrT->entranceTestDate=$request->DateTestT; echo"2";}
				//unset($enrT->entranceTestDate);
				$enrT->statusNumber=$request->statusT;
				$enrT->save();	
			}
			$day=days::where('classNumber',$request->idLophocT)->where('day','>=',date('Y-m-d'))->get();
			foreach($day as $val){
				echo $val->dayNumber;
				$atd=new attendances;
				$atd->class_studentNumber=$xeplop->id;
				$atd->dayNumber=$val->dayNumber;
				$atd->save();
			}
		}
		
		if($request->cbLy){
			if($request->idLophocL!=0){
				echo "test";
				$xeplop=new class_student;
				$xeplop->studentNumber=$id;
				$xeplop->classNumber=$request->idLophocL;
				$xeplop->statusNumber=8;
				$xeplop->start=date('Y-m-d');
				$xeplop->save();
				$day=days::where('classNumber',$request->idLophocL)->where('day','>=',date('Y-m-d'))->get();
			}
			else{
				$enrL=new enrolls;
				$enrL->studentNumber=$id;
				$enrL->note=$request->noteL;
				$enrL->subject=$request->cbLy;
				if($request->DateTestL=='')
				{
					$enrL->entranceTestDate=NULL;
				}
				else $enrL->entranceTestDate=$request->DateTestL;
				$enrL->statusNumber=$request->statusL;
				$enrL->save();
			}
			$day=days::where('classNumber',$request->idLophocL)->where('day','>=',date('Y-m-d'))->get();
			foreach($day as $val){
				echo $val->dayNumber;
				$atd=new attendances;
				$atd->class_studentNumber=$xeplop->id;
				$atd->dayNumber=$val->dayNumber;
				$atd->save();
			}
		}		
		if($request->cbHoa){
			if($request->idLophocH!=0){
				echo "test";
				$xeplop=new class_student;
				$xeplop->studentNumber=$id;
				$xeplop->classNumber=$request->idLophocH;
				$xeplop->statusNumber=8;
				$xeplop->start=date('Y-m-d');
				$xeplop->save();
				$day=days::where('classNumber',$request->idLophocH)->where('day','>=',date('Y-m-d'))->get();
			}
			else{
				$enrH=new enrolls;
				$enrH->studentNumber=$id;
				$enrH->subject=$request->cbHoa;
					$enrH->note=$request->noteH;
				if($request->DateTestH=='')
				{
					$enrH->entranceTestDate=NULL;
				}
				else $enrH->entranceTestDate=$request->DateTestH;
				$enrH->statusNumber=$request->statusH;
				$enrH->save();
			}
			$day=days::where('classNumber',$request->idLophocH)->where('day','>=',date('Y-m-d'))->get();
		foreach($day as $val){
			echo $val->dayNumber;
			$atd=new attendances;
			$atd->class_studentNumber=$xeplop->id;
			$atd->dayNumber=$val->dayNumber;
			$atd->save();
		}
		}		
		if($request->cbVan){
			if($request->idLophocV!=0){
				echo "test";
				$xeplop=new class_student;
				$xeplop->studentNumber=$id;
				$xeplop->classNumber=$request->idLophocV;
				$xeplop->statusNumber=8;
				$xeplop->start=date('Y-m-d');
				$xeplop->save();
				$day=days::where('classNumber',$request->idLophocV)->where('day','>=',date('Y-m-d'))->get();
			}
			else{
				$enrV=new enrolls;
				$enrV->studentNumber=$id;
				$enrV->note=$request->noteV;
				$enrV->subject=$request->cbVan;
				if($request->DateTestV=='')
				{
					$enrV->entranceTestDate=NULL;
				}
				else $enrV->entranceTestDate=$request->DateTestV;
				$enrV->statusNumber=$request->statusV;
				$enrV->save();
			}
			$day=days::where('classNumber',$request->idLophocV)->where('day','>=',date('Y-m-d'))->get();
		foreach($day as $val){
			echo $val->dayNumber;
			$atd=new attendances;
			$atd->class_studentNumber=$xeplop->id;
			$atd->dayNumber=$val->dayNumber;
			$atd->save();
		}
		}		
		if($request->cbAnh){
			if($request->idLophocA!=0){
				echo "test";
				$xeplop=new class_student;
				$xeplop->studentNumber=$id;
				$xeplop->classNumber=$request->idLophocA;
				$xeplop->statusNumber=8;
				$xeplop->start=date('Y-m-d');
				$xeplop->save();
				$day=days::where('classNumber',$request->idLophocA)->where('day','>=',date('Y-m-d'))->get();
			}
			else{
				$enrA=new enrolls;
				$enrA->studentNumber=$id;
				$enrA->subject=$request->cbAnh;
					$enrA->note=$request->noteA;
				if($request->DateTestA=='')
				{
					$enrA->entranceTestDate=NULL;
				}
				else $enrA->entranceTestDate=$request->DateTestA;
				$enrA->statusNumber=$request->statusA;
				$enrA->save();
			}
			$day=days::where('classNumber',$request->idLophocA)->where('day','>=',date('Y-m-d'))->get();
		foreach($day as $val){
			echo $val->dayNumber;
			$atd=new attendances;
			$atd->class_studentNumber=$xeplop->id;
			$atd->dayNumber=$val->dayNumber;
			$atd->save();
		}
		}		
		if($request->cbSinh){
			if($request->idLophocSi!=0){
				echo "test";
				$xeplop=new class_student;
				$xeplop->studentNumber=$id;
				$xeplop->classNumber=$request->idLophocSi;
				$xeplop->statusNumber=8;
				$xeplop->start=date('Y-m-d');
				$xeplop->save();
				$day=days::where('classNumber',$request->idLophocSi)->where('day','>=',date('Y-m-d'))->get();
			}
			else{
				$enrSi=new enrolls;
				$enrSi->studentNumber=$id;
				$enrSi->subject=$request->cbSinh;
				if($request->DateTestSi=='')
				{
					$enrSi->entranceTestDate=NULL;
				}
				else $enrSi->entranceTestDate=$request->DateTestSi;
					$enrSi->note=$request->noteSi;
				$enrSi->statusNumber=$request->statusSi;
				$enrSi->save();
			}
			$day=days::where('classNumber',$request->idLophocSi)->where('day','>=',date('Y-m-d'))->get();
		foreach($day as $val){
			echo $val->dayNumber;
			$atd=new attendances;
			$atd->class_studentNumber=$xeplop->id;
			$atd->dayNumber=$val->dayNumber;
			$atd->save();
		}
		}		
		if($request->cbSu){
			if($request->idLophocSu!=0){
				echo "test";
				$xeplop=new class_student;
				$xeplop->studentNumber=$id;
				$xeplop->classNumber=$request->idLophocSu;
				$xeplop->statusNumber=8;
				$xeplop->start=date('Y-m-d');
				$xeplop->save();
				$day=days::where('classNumber',$request->idLophocSu)->where('day','>=',date('Y-m-d'))->get();
			}
			else{
				$enrS=new enrolls;
				$enrS->studentNumber=$id;
				$enrS->subject=$request->cbSu;
				if($request->DateTestSu=='')
				{
					$enrS->entranceTestDate=NULL;
				}
				else $enrS->entranceTestDate=$request->DateTestSu;
					$enrS->note=$request->noteSu;
				$enrS->statusNumber=$request->statusSu;
				$enrS->save();
			}
			$day=days::where('classNumber',$request->idLophocSu)->where('day','>=',date('Y-m-d'))->get();
		foreach($day as $val){
			echo $val->dayNumber;
			$atd=new attendances;
			$atd->class_studentNumber=$xeplop->id;
			$atd->dayNumber=$val->dayNumber;
			$atd->save();
		}
		}	
		if($request->cbDia){
			if($request->idLophocD!=0){
				echo "test";
				$xeplop=new class_student;
				$xeplop->studentNumber=$id;
				$xeplop->classNumber=$request->idLophocD;
				$xeplop->statusNumber=8;
				$xeplop->start=date('Y-m-d');
				$xeplop->save();
				$day=days::where('classNumber',$request->idLophocD)->where('day','>=',date('Y-m-d'))->get();
			}
			else{
				$enrD=new enrolls;
				$enrD->studentNumber=$id;
				$enrD->subject=$request->cbDia;
					$enrD->note=$request->noteD;
				if($request->DateTestD=='')
				{
					$enrD->entranceTestDate=NULL;
				}
				else $enrD->entranceTestDate=$request->DateTestD;
				$enrD->statusNumber=$request->statusD;
				$enrD->save();
			}
			$day=days::where('classNumber',$request->idLophocD)->where('day','>=',date('Y-m-d'))->get();
		foreach($day as $val){
			echo $val->dayNumber;
			$atd=new attendances;
			$atd->class_studentNumber=$xeplop->id;
			$atd->dayNumber=$val->dayNumber;
			$atd->save();
		}
		}
		
		return redirect()->route('admin.enroll.getAdd');
	}


	


}
