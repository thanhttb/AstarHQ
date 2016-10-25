<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DateTime;
use Illuminate\Http\Request;
use App\enrolls;
use App\students;
use App\status;

class dashboardController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{	
		$totalStudent=students::all()->count();
		echo $totalStudent;
	/*	$tomorrow=new datetime('tomorrow');
		$today= date('Y-m-d');

		$chuaXepLich=enrolls::where('enrolls.statusNumber','<=','1')->orWhere('enrolls.entranceTestDate','=','0000-00-00 00:00:00')
		->join('students','students.studentNumber','=','enrolls.studentNumber')
		->join('statuses','statuses.statusNumber','=','enrolls.statusNumber')
		->get();

		$daXepLich=enrolls::where('enrolls.entranceTestDate','=',$today)
		->where('enrolls.statusNumber','=','2')
		->join('students','students.studentNumber','=','enrolls.studentNumber')
		->join('statuses','statuses.statusNumber','=','enrolls.statusNumber')
		->get();
		$daCoKetQua=enrolls::where_not_null('enrolls.result');
	//print_r($chuaXepLich);
		return view('admin.dashboard.db',compact('chuaXepLich','daXepLich','daCoKetQua'));*/
	}

	public function update($id)
	{
		//
		$daKiemTra=enrolls::find($id);
		
		$daKiemTra->statusNumber=3;
		$daKiemTra->save();
		return redirect()->route('admin.enroll.kiemtrahomnay');

	}

	
}
