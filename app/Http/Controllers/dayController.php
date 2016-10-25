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
use App\tuitions;
class dayController extends Controller{
	public function getClasslist(){
		$data=classes::join('teachers','teachers.teacherNumber','=','classes.teacherNumber')->get();
		return view('admin.day.classList',compact('data'));
	}
	public function getDay($id){
		$class=classes::where('classNumber',$id)
				->join('teachers','teachers.teacherNumber','=','classes.teacherNumber')->get()->toArray();
		$class=$class[0];
		$teacher=teacher::where('subjectNumber',$class['subjectNumber'])->get()->toArray();

		return view('admin.day.add',compact('class','teacher','id'));
	}
	public function postDay($id,ChoxeplopRequest $request){
		$dayThisBatch=array();
		for($stt=1;$stt<=30;$stt++){
			if($request['date'.$stt]==0) echo"";
			else{
				$day=new days;
				$day->classNumber=$id;
				$day->day=$request['date'.$stt];
				$day->teacherNumber=$request['teacher'.$stt];
				$day->tuition=$request['tuition'.$stt];
				$day->note=$request['note'.$stt];
				
				$day->save();
				$day=days::max('dayNumber');
				$day=days::where('dayNumber',$day)->get()->toArray();
				$dayThisBatch=array_merge($day,$dayThisBatch);
			}			
		}
		//Tao bang diem danh
		foreach ($dayThisBatch as $val) {
			# code...
			$class_student=class_student::where('classNumber',$val['classNumber'])
										->where('statusNumber',8)
										->get()->toArray();
			foreach ($class_student as $cs) {
				# code...
				$atd=new attendances;
				$atd->class_studentNumber=$cs['id'];
				$atd->dayNumber=$val['dayNumber'];
				$atd->save();
			}
		}
		//Tao hoc phi theo thang
		/*foreach($dayThisBatch as $val){
			$class_student=class_student::where('classNumber',$val['classNumber'])
										->where('statusNumber',8)
										->get()->toArray();
			$month=date('Y-m-1',strtotime($val['day']));
			foreach ($class_student as $cs) {
				# code...
				$check=tuitions::where('month',$month)->where('class_studentNumber',$cs['id'])
								->get()->toArray();
				if(empty($check)){
				
					# code...
					$tuition=new tuitions;
					$tuition->month=$month;
					$tuition->class_studentNumber=$cs['id'];
					$tuition->totalTuition+=$val['tuition'];
					$tuition->remained=$tuition->totalTuition-$tuition->received;
					$tuition->save();				
				}
				else{
				
					$tuition=tuitions::find($check[0]['tuitionNumber']);
					$tuition->totalTuition+=$val['tuition'];
					$tuition->remained=$tuition->totalTuition-$tuition->received;
					$tuition->save();				
				}
			}
			$check=tuitions::where('month',$month)->get()->toArray();			
		}*/
		return redirect()->route('admin.day.getClasslist');
	}
	public function getList($classId){
		$day=days::where('day.classNumber',$classId)
				->join('teachers','teachers.teacherNumber','=','day.teacherNumber')->get();
		$class=classes::where('classNumber',$classId)->select('className')->get()->toArray();
		$class=$class[0];
		return view('admin.day.list',compact('day','class'));
	}
	public function getEdit($id){
		$day=days::join('teachers','teachers.teacherNumber','=',
			'day.teacherNumber')->find($id)->toArray();
		$class=classes::find($day['classNumber'])->toArray();
		$teacher=teacher::where('subjectNumber',$class['subjectNumber'])->get()->toArray();

		return view('admin.day.edit',compact('day','id','teacher'));
	}
	public function postEdit($id, ChoxeplopRequest $request){
		$day=days::find($id);
		$day->day=$request->day;
		$day->teacherNumber=$request->teacher;

		//Cap nhat Tien hoc phi
		/*$student_class=class_student::where('classNumber',$day->classNumber)->where('statusNumber',8)->get()->toArray();
		foreach ($student_class as $sc) {
			# code...
			$tuition=tuitions::where('class_studentNumber',$sc['id'])
							 ->where('month',date('Y-m-1',strtotime($day->day)))->get()->toArray();
			$tuition=tuitions::find($tuition[0]['tuitionNumber']);
			$tuition->totalTuition=$tuition->totalTuition-$day->tuition+$request->tuition;
			$tuition->remained=$tuition->totalTuition-$tuition->received;
			$tuition->save();
		}*/
		$day->tuition=$request->tuition;
		$day->save();
		$classNumber= $day->classNumber;
		$day=days::where('day.classNumber',$classNumber)
				->join('teachers','teachers.teacherNumber','=','day.teacherNumber')->get();
		$class=classes::where('classes.classNumber',$classNumber)->select('className')->get()->toArray();
		$class=$class[0];

		return view('admin.day.list',compact('day','class'));
	}
	public function getDelete($id){
		$day=days::find($id);
		$student_class=class_student::where('classNumber',$day->classNumber)->where('statusNumber',8)->get()->toArray();
		/*foreach ($student_class as $sc) {
			# code...
			$tuition=tuitions::where('class_studentNumber',$sc['id'])
							 ->where('month',date('Y-m-1',strtotime($day->day)))->get()->toArray();
			$tuition=tuitions::find($tuition[0]['tuitionNumber']);
			$tuition->totalTuition=$tuition->totalTuition-$day->tuition;
			$tuition->remained=$tuition->totalTuition-$tuition->received;
			$tuition->save();
		}*/
		$day->delete();
 		$classNumber= $day->classNumber;
		$day=days::where('day.classNumber',$classNumber)
				->join('teachers','teachers.teacherNumber','=','day.teacherNumber')->get();
		$class=classes::where('classes.classNumber',$classNumber)->select('className')->get()->toArray();
		$class=$class[0];
		return view('admin.day.list',compact('day','class'));
	}
} 