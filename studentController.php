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
use App\tuitions;
use App\classes;
use App\class_student;
use App\attendances;
use App\days;
class studentController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getList(){
		$data=students::all();
		$arrCount=array();
		foreach($data as $val){
			$count=students::find($val->studentNumber)->classes()->where('statusNumber','8')->get()->toArray();
			$count=count($count);
			$arrCount[$val->studentNumber]=$count;			
		}	
		return view('admin.student.list',compact('data','arrCount'));
	}
	public function getClass($id){
		$data=students::find($id);
		$classes=$data->classes()->get();
		$data=$data->toArray();
		$status=array();

		foreach($classes as $val){
			$status[$val['classNumber']]=class_student::where('studentNumber',$data['studentNumber'])
							 ->where('classNumber',$val['classNumber'])
							 ->join('statuses','statuses.statusNumber','=','class_student.statusNumber')
							 ->get()->toArray();
		}
		
		//echo "<pre>";
		//print_r($status);
		return view('admin.student.getClass',compact('data','classes','status'));
	}
	public function getDrop($id)
	{
		$data=class_student::find($id);
		$ngaythoihoc=date('Y-m-d');
		
		$data->statusNumber='9';
		$data->end=$ngaythoihoc;
		$data->save();
		return redirect()->route('admin.class.getStudentList',$data->classNumber);
	}
	public function getChuyenlop($id)
	{
		$data=students::find($id)->toArray();
		$class=classes::all()->toArray();
		return view('admin.student.getChuyenlop',compact('id','data','class'));

	}
	public function postChuyenlop($id,ChoxeplopRequest $request)
	{
		$data=new class_student;
		$data->studentNumber=$id;
		$data->classNumber=$request->class;
		$data->statusNumber='8';
		$data->start=date('Y-m-d');
		$data->end=null;
		$data->save();
		return redirect()->route('admin.student.getClass',$id);

	}

	public function getEdit($id){
		$data=students::find($id)->toArray();
		return view('admin.student.edit',compact('data','id'));
	}
	public function postEdit($id, StudentRequest $request){
		$edit=students::find($id);
		$edit->lastName=$request->lastName;
		if($request->birthday!=0){
		 	$edit->birthday=$request->birthday;
		}
		else{
			$edit->birthday=null;
		}
		
		$edit->school=$request->school;
		$edit->class=$request->class;
		$edit->phone=$request->phone;
		$edit->email=$request->email;
		$edit->parentName=$request->parentName;
		$edit->parentPhone1=$request->parentPhone;
		$edit->parentPhone2=$request->parentPhone2;
		$edit->parentEmail=$request->parentEmail;
		$edit->parentWork=$request->parentWork;
		$edit->save();
		return redirect()->route('admin.student.getList');
	}
	public function getOption($id){
		$student=students::find($id)->toArray();
		return view('admin.student.management.option',compact('id','student'));
	}
	public function tuitionUpdate($id,$month,$year){
		$student=students::find($id);
		$class_student=class_student::where('class_student.studentNumber',$id)
									->join('classes','classes.classNumber','=','class_student.classNumber')
									->get()->toArray();
		$tuitionAllClass=array();
		$totalDay=array();
		foreach($class_student as $val){				
			$day=days::where('classNumber',$val['classNumber'])->whereMonth('day','=',$month)
					 ->whereYear('day','=',$year)
					 ->where('day','>=',$val['start'])
					 ->get()->toArray();
			if($val['statusNumber']==9){
				$day=days::where('classNumber',$val['classNumber'])->whereMonth('day','=',$month)
					 ->whereYear('day','=',$year)->where('day','<',$val['end'])
					 ->get()->toArray();
			}

			$daycount=count($day);
			$tuitionCheck=tuitions::where('class_studentNumber',$val['id'])
						->whereMonth('month','=',$month)->get()->toArray();
			//print_r($tuitionCheck);
			if(empty($tuitionCheck)){
				//echo date('Y-'.$thisMonth.'-1');
				$tuition=new tuitions;
				foreach($day as $d){
					$atd=attendances::where('class_studentNumber',$val['id'])->where('dayNumber',$d['dayNumber'])
									->get()->toArray();
					if(!empty($atd)){
						$tuition->totalTuition+=$d['tuition']-$d['tuition']/100*$atd[0]['discount'];
						$tuition->remained=$tuition->totalTuition;	
					}									
				}
				$tuition->month=date('Y-'.$month.'-1');
				$tuition->class_studentNumber=$val['id'];
				$tuition->save();
				$tuitionNumber=$tuition->tuitionNumber;
			}
			else{
				$tuition=tuitions::find($tuitionCheck[0]['tuitionNumber']);
				$tuition->totalTuition=0;
				foreach($day as $d){
					$atd=attendances::where('class_studentNumber',$val['id'])->where('dayNumber',$d['dayNumber'])
									->get()->toArray();
					if(!empty($atd)){
						$tuition->totalTuition+=$d['tuition']-$d['tuition']/100*$atd[0]['discount'];
					}
					
				}
				$tuition->remained=$tuition->totalTuition-$tuition->received;
				$tuition->month=date('Y-'.$month.'-1');
				$tuition->class_studentNumber=$val['id'];
				$tuition->save();
				$tuitionNumber=$tuition->tuitionNumber;

			}
					 
			$tuitionEachClass=tuitions::find($tuitionNumber)->toArray();
			$tuitionAllClass[$val['id']]=$tuitionEachClass;
			$totalDay[$val['id']]=$daycount;
			$tuitionAllClass[$val['id']]=array_merge($tuitionAllClass[$val['id']],$totalDay);
				
		}
		return $tuitionAllClass;
		//return view('admin.student.management.tuitionManagement',
		//compact('id','student','class_student','tuitionAllClass','thisMonth','thisYear','totalDay'));
	}


	public function getTuition($id){
		$student=students::find($id);
		$thisMonth=date('m',strtotime($timeThisMonth));
		$thisYear=date('Y',strtotime($timeThisMonth));

		$class_student=class_student::where('class_student.studentNumber',$id)
									->join('classes','classes.classNumber','=','class_student.classNumber')
									->get()->toArray();
		$tuition[$thisMonth]=$this->tuitionUpdate($id, $thisMonth,$thisYear);
		$tuition[$thisMonth+1]=$this->tuitionUpdate($id, ($thisMonth+1),$thisYear);
		foreach ($tuition as $month => $value) {
			foreach ($value as $class => $data) {
				# code...
				$tuitionAllClass[$class][$month]=$data;
			}
			# code...
		}
		//echo "<pre>";
		//print_r($tuitionAllClass);
		return view('admin.student.management.tuitionManagement',
		compact('id','student','class_student','tuitionAllClass','thisMonth','thisYear'	));
	
		}
	public function postTuition($id, ChoxeplopRequest $request){
		$tuition=tuitions::find($id);
		$tuition->received=$request->received;
		$tuition->note=$request->note;
		$tuition->remained=$tuition->totalTuition-$tuition->received;
		$tuition->save();

		$cs=class_student::find($tuition->class_studentNumber);
		
		return redirect()->route('admin.student.management.getTuition',$cs->studentNumber);
	}
	public function getResult($id){

	}	
	public function postMonth($id, ChoxeplopRequest $request){
		$student=students::find($id);

		$thisMonth=date('m',strtotime($request->month));
		$thisYear=date('Y',strtotime($request->month));

		$class_student=class_student::where('class_student.studentNumber',$id)
									->join('classes','classes.classNumber','=','class_student.classNumber')
									->get()->toArray();
		$tuition[$thisMonth]=$this->tuitionUpdate($id, $thisMonth,$thisYear);
		$tuition[$thisMonth+1]=$this->tuitionUpdate($id, $thisMonth+1,$thisYear);
		foreach ($tuition as $month => $value) {
			foreach ($value as $class => $data) {
				# code...
				$tuitionAllClass[$class][$month]=$data;
			}
			# code...
		}
		//echo "<pre>";
		//print_r($tuitionAllClass);
		return view('admin.student.management.tuitionManagement',
		compact('id','student','class_student','tuitionAllClass','thisMonth','thisYear'	));

		}	
	
}
