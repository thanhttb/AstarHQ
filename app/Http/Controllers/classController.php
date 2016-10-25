<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DateTime;
use Illuminate\Http\Request;
use App\Http\Requests\ClassRequest;

use App\enrolls;
use App\students;
use App\status;
use App\classes;
use App\teacher;
use App\subject;
use App\class_student;

class classController extends Controller{
	public function getAdd(){
		$subject=subject::all();
		$teacher=teacher::all();
		return view('admin.class.add',compact('subject','teacher'));
	}

	public function postAdd(ClassRequest $request){
		
		$data=new classes;
		$data->className=$request->className;
		$data->description=$request->description;
		$data->class=$request->class;
		$data->day=$request->day;
		$data->subjectNumber=$request->subject;
		$data->teacherNumber=$request->teacher;
		$data->teacherNumber2=$request->teacher2;
		$data->startTime=$request->startTime;
		$data->endTime=$request->endTime;
		$data->tuition=$request->tuition;
		$data->save();
		return redirect()->route('admin.class.getAdd');

	}
	public function getList(){
		$data=classes::all();
		$teacher=array();
		foreach($data as $val){
			$count=class_student::where('classNumber',$val->classNumber)->where('statusNumber',8)->count();
			$siSo=classes::find($val->classNumber);
			$siSo->sum=$count;
			$siSo->save();

			$teacherThisClass=teachers::where('teacherNumber',$val->teacherNumber)->orWhere('teacherNumber',$val->teacherNumber2)
										->get()->toArray();
			$teacher[$val->classNumber]=$teacherThisClass;							
		}	


		return view('admin.class.list',compact('data','teacher'));
	}
	public function getDelete($id){
		$data=classes::find($id);
		$data->delete();
		return redirect()->route('admin.class.getList');
	}
	public function getEdit($id){
		$data=classes::where('classNumber',$id)->join('teachers','teachers.teacherNumber','=','classes.teacherNumber')
					->join('subjects','subjects.subjectNumber','=','classes.subjectNumber')->get()->toArray();
		$subject=subject::all();
		$teacher=teacher::all();

		return view('admin.class.edit',compact('data','id','subject','teacher'));
	}
	public function postEdit($id, ClassRequest $request)
	{
		$data=classes::find($id);
		$data->className=$request->className;
		$data->description=$request->description;
		$data->class=$request->class;
		$data->day=$request->day;
		$data->subjectNumber=$request->subject;
		$data->teacherNumber=$request->teacher;
				$data->teacherNumber2=$request->teacher2;

		$data->startTime=$request->startTime;
		$data->endTime=$request->endTime;
		$data->tuition=$request->tuition;
		$data->save();
		return redirect()->route('admin.class.getList');

	}
	public function getStudentList($id){
		$class=classes::where('classNumber',$id);
		$student=class_student::where('classNumber',$id)->join('students','students.studentNumber','=','class_student.studentNumber')
						  ->orderBy('statusNumber')->get();

		return view('admin.class.studentList',compact('student','class','id'));				  
	}
}