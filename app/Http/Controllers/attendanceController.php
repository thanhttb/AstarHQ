<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Datetime;
use Illuminate\Http\Request;
use App\Http\Requests\StudentRequest;
use App\Http\Requests\ChuaXepLichRequest;
use App\Http\Requests\ChoxeplopRequest;
use App\Http\Requests\ClassRequest;
use App\enrolls;
use App\status;
use App\students;
use App\classes;
use App\class_student;
use App\attendances;
use App\days;
use App\teacher;
class attendanceController extends Controller{
	public function getClasslist(){
		$data=classes::join('teachers','teachers.teacherNumber','=','classes.teacherNumber')->get();
		return view('admin.attendance.classList',compact('data'));
	}
	public function getAttendance($classId){
		$month=date('m');
		$year=date('Y');
		$day=days::where('day.classNumber',$classId)->wheremonth('day','=',$month)->whereyear('day','=',$year)
				 ->orderBy('day')->get()->toArray();
		$class=classes::find($classId)->toArray();
		$studentInClass=class_student::join('students','students.studentNumber','=','class_student.studentNumber')

									 ->where('classNumber',$classId)
									 ->where('statusNumber',8)->get()->toArray();
		//echo "<pre>";
		//print_r($studentInClass);
		$atdMonth = array();
		foreach ($day as $val) {
			# code...
			$atdDay=attendances::where('dayNumber',$val['dayNumber'])->get()->toArray();			
			$atdMonth[$val['dayNumber']]=$atdDay;
		}
		//echo "<pre>";
		//print_r($atdMonth);
		
		return view('admin.attendance.attendance',compact('class','day','atdMonth','studentInClass','month','year'));
	}
	public function postAttendance($classId, ChoxeplopRequest $request){
		$stt=1;
		$class=classes::find($classId)->toArray();
		$class_student=class_student::where('classNumber',$classId)->where('statusNumber',8)->get()->toArray();

		$day=days::where('day.classNumber',$classId)->wheremonth('day','=',$request->month)->whereyear('day','=',$request->year)
				 ->orderBy('day')->get()->toArray();
		//print_r($class_student);		
		$stdCount=1; 
		foreach ($class_student as $student) {
			foreach ($day as $val) {
				# code..
				$atd=attendances::where('class_studentNumber',$student['id'])->where('dayNumber',$val['dayNumber'])
								->first();
				if(!is_null($request["status".$stt])){
					echo $request["discount".$stdCount];
					$atd->discount=$request["discount".$stdCount];
					$atd->statusNumber=$request["status".$stt];
					$atd->save();
				}

				if(is_null($atd['hocbuStatus'])&& $atd['statusNumber']=='p'){
					$atd->hocbuStatus=10;
					$atd->save();
				}
				$stt++;	
			}
			$stdCount++;
		}

	return redirect()->route("admin.attendance.getAttendance",$classId);

	}
	public function postMonth($classId, ChoxeplopRequest $request){
		$month=date('m',strtotime($request->thang));
		$year=date('Y',strtotime($request->thang));
		$day=days::where('day.classNumber',$classId)->wheremonth('day','=',$month)->whereyear('day','=',$year)
				 ->orderBy('day')->get()->toArray();
		$class=classes::find($classId)->toArray();
		$studentInClass=class_student::join('students','students.studentNumber','=','class_student.studentNumber')

									 ->where('classNumber',$classId)
									 ->where('statusNumber',8)->get()->toArray();
		//echo "<pre>";
		//print_r($studentInClass);
		$atdMonth = array();
		foreach ($day as $val) {
			# code...
			$atdDay=attendances::where('dayNumber',$val['dayNumber'])->get()->toArray();			
			$atdMonth[$val['dayNumber']]=$atdDay;
		}
		//echo "<pre>";
		//print_r($atdMonth);
		//echo $request->thang;
		///echo "<br>"."<pre>";
		//print_r($day);
		return view('admin.attendance.attendance',compact('class','day','atdMonth','studentInClass','month','year'));
	}
 	public function getHocbu(){
 		$firstOfThisWeek=date('Y-m-d',strtotime('monday this week'));
 		$lastOfThisWeek=date('Y-m-d',strtotime('sunday this week'));
 		$hocbuList=attendances::wherenotnull('hocbuStatus')
 							  // ->Orwhere('attendance.statusNumber','p')
 								->join('day','day.dayNumber','=','attendance.dayNumber')
 							  ->join('class_student','class_student.id','=','attendance.class_studentNumber')
 							  ->join('statuses','statuses.statusNumber','=','attendance.hocbuStatus')
 							  ->whereBetween('day.day',[$firstOfThisWeek,$lastOfThisWeek])
 							  ->orderBy('studentNumber')->get()->toArray();
 		$dayList=array();
 		$studentList=array();
 		$classList=array();
 		foreach($hocbuList as $val){
 			$studentList[$val['attendanceNumber']]=students::find($val['studentNumber'])->toArray();
 			$classList[$val['attendanceNumber']]=classes::find($val['classNumber'])->toArray();
 		}
 		for($i=1;$i<=7;$i++){
 			$dayList[$i]=date('d-m',strtotime($firstOfThisWeek."+".$i."day"));
 		}
 		return view('admin.attendance.hocbu',compact('hocbuList','dayInWeek', 'studentList',
 					'classList','firstOfThisWeek','lastOfThisWeek','dayList'));
 		echo "<pre>";
 		print_r($dayList);
 		echo "<pre>";
 		print_r($studentList);
 		echo "<pre>";
 		print_r($classList);
 	}
 	public function postHocbu($id, ChoxeplopRequest $request){
 		$hocbu=attendances::find($id);
 		$hocbu->hocbuNote=$request->hocbuNote;
 		$hocbu->hocbuHandler=$request->handler;
 		if($request->hocbuDay!=''){
 			$hocbu->hocbuDay=$request->hocbuDay;
 		}
 		$hocbu->hocbuStatus=$request->status;
 		echo $request->status;

 		$hocbu->save();
 		return redirect()->route('admin.attendance.getHocbu');

 	}
 	public function postWeek(ChoxeplopRequest $request){
 		//echo $request->tuan;
 		$firstOfThisWeek=date('Y-m-d',strtotime('monday this week',strtotime($request->tuan)));
 		$lastOfThisWeek=date('Y-m-d',strtotime('sunday this week',strtotime($request->tuan)));
		$hocbuList=attendances::wherenotnull('hocbuStatus')
 							   //->Orwhere('attendance.statusNumber','p')
 								->join('day','day.dayNumber','=','attendance.dayNumber')
 							  ->join('class_student','class_student.id','=','attendance.class_studentNumber')
 							  ->join('statuses','statuses.statusNumber','=','attendance.hocbuStatus')
 							  ->whereBetween('day.day',[$firstOfThisWeek,$lastOfThisWeek])
 							  ->orderBy('studentNumber')->get()->toArray();
 		$dayList=array();
 		$studentList=array();
 		$classList=array();
 		foreach($hocbuList as $val){
 			$studentList[$val['attendanceNumber']]=students::find($val['studentNumber'])->toArray();
 			$classList[$val['attendanceNumber']]=classes::find($val['classNumber'])->toArray();
 		}
 		for($i=1;$i<=7;$i++){
 			$dayList[$i]=date('d-m',strtotime($firstOfThisWeek."+".$i."day"));
 		}
 		return view('admin.attendance.hocbu',compact('hocbuList','dayInWeek', 'studentList',
 					'classList','firstOfThisWeek','lastOfThisWeek','dayList'));
 		
 	}
}