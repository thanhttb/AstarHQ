<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
// Ví dụ đơn giản về Route
Route::get('abc123',function(){
	echo "Bonjour Mousieur";
});
// Route gọi function trong Controller
Route::get('testcontroller','WelcomeController@showinfo');

// Truyền tham số bằng Route (Có điều kiện)
Route::get('test/{id?}',function($id=0){
	return "id cua ban la: $id";

})->where(['id'=>'[0-9]+']);

//
Route::get('call-view',function(){
	$hoten="Tran Thanh";
	return view('thongtin',compact('hoten'));

});

Route::get('hochiminh',['as'=>'hcm',function(){
	return "hochiminh city";
}]);
Route::get('testredirect',function(){
	return redirect()->route("hcm");
});

Route::group(['prefix'=>'thuc-don'],function(){
	Route::get('bun-bo',function(){
		echo "Day la trang ban bun bo";
	});
	Route::get('bun-mam',function(){
		echo "Day la trang ban bun mam";
	});
	Route::get('bun-moc',function(){
		echo "Day la trang ban bun moc";
	});
});


Route::get('goi-view',function(){
	return view('layout.sub.view');
});

Route::get('goi-layout',function(){
	return view('layout.sub.layout');
}); 
View::share('title1','Lap trinh laravel 5x');

View::composer(['layout.sub.layout','layout.sub.view'],function($view){
	return $view->with('thongtin','Day la trang ca nhan');
});

Route::get('check-view',function(){
	if(view()->exists('layout.sub.views')){
		echo "ton tai view";
	}
	else return "khong ton tai view";
});

Route::get('goi-sub',function(){
	return view('view.sub');
});
Route::get('goi-master',function(){
	return view('view.master');
});
Route::get('goi-layout',function(){
	return view('view.layout');
});


/*Schema*/
Route::get('schema/create/student',function()
	{
		Schema::create('student',function($table){
			$table->increments('id');
			$table->string('studentName');
			$table->integer('parentPhone');
		});
		
	});
Route::get('schema/create/enroll',function(){
	Schema::create('enroll',function($table){
		$table->increments('id');
		$table->integer('studentId')->unsigned();
		$table->foreign('studentId')->references('id')->on('student')->onDelete('cascade');
		$table->timestamps();
	});
});

////////////////////////////////////////////////////////////////////////////////////////

Route::get('query/select-all',function(){
	$data=DB::table('student')->get();	
	echo "<pre>";
	print_r($data);
	echo "</pre>";
});

Route::get('query/select-name',function(){
	$data=DB::table('student')->select('studentName')->where('id',4)->get();	
	echo "<pre>";
	print_r($data);
	echo "</pre>";
});

Route::get('query/orderby',function(){
	$data=DB::table('student')->orderBy('studentName','DESC')->get();
	echo "<pre>";
	print_r($data);
	echo "</pre>";
});

Route::get('query/limit',function(){
	$data=DB::table('student')->select('studentName')->skip(2)->take(1)->get();
	echo "<pre>";
	print_r($data);
	echo "</pre>";
});

Route::get('query/wherebetween',function(){
	$data=DB::table('student')->select('studentName')->wherebetween('id',[1,4])->get();
	echo "<pre>";
	print_r($data);
	echo "</pre>";
});


Route::get('query/count',function(){
	$data=DB::table('student')->wherebetween('id',[1,4])->count();
	echo $data; 
});
Route::get('query/insert',function(){
	DB::table('student')->insert([
		['id'=>'7','studentName'=>"Le Van A",'parentPhone'=>'234234'],
		['id'=>'6','studentName'=>"Nguyen Van A",'parentPhone'=>'123123123']

	]);
	return "Insert THanh cong";
});

Route::get('query/update',function(){
	DB::table('student')->where('id','4')->update(
		['studentName'=>'Tran Thanh','parentPhone'=>'21112333']);
});

Route::get('query/last',function(){
	$data=DB::table('students')->select('id')->orderBy('id','DESC')->first();
	echo "<pre>";
	print_r($data);
	echo "</pre>";
});
////////////////////////////////////////////////////////////////////////////////////////////////

Route::get('model/select-all',function(){
	$data = App\enroll::all()->tojSon();
	echo "<pre>";
	print_r($data);
	echo "</pre>";
});
Route::get('model/select-id',function(){
	$data = App\enroll::find(4)->toArray();
	echo "<pre>";
	print_r($data);
	echo "</pre>";
});

Route::get('model/select-where',function(){
	$data = App\enroll::where('id',5)->lists('id');
	echo "<pre>";
	print_r($data);
	echo "</pre>";
});

Route::get('model/select-whereRaw',function(App\enroll $enrolls){
	$data = $enrolls::whereRaw('id=? Or subject=?',[2,"Math"])->select('studentId','subject')->get()->toArray();
	echo "<pre>";
	print_r($data);
	echo "</pre>";
});


Route::get('model/insert',function(App\enroll $enrolls){
	$data = new $enrolls;
	$data->id=6;
	$data->studentId=2;
	$data->subject="Chem";
	$data->save();
});
Route::get('model/create',function(App\enroll $enrolls){
	$data=array(
			'id'=>7,
			'studentId'	=>3,
			'subject'	=>'Chem'
		);

	$enrolls::create($data);
});


Route::get('model/relation1M',function(App\students $students){
	$data=$students::find(2)->enroll()->get()->toArray();
	echo "<pre>";
	print_r($data);
	echo "</pre>";
});
Route::get('model/relation1M/enroll',function(App\enroll $enroll){
	$data=$enroll::find(2)->student()->get()->toArray();
	echo "<pre>";
	print_r($data);
	echo "</pre>";
});
/////////////////////////////////////////////////////////////////////////////////////////////////////
Route::get('form/layout',function(){
	return view('form.layout');
});

Route::post('form/data',['as'=>'sendEmail',function(){
	return "Submit success";
}]);

Route::get('form/enrollForm', function(){
	return view('form/enrollForm');
});
Route::post('form/enrollFinish',['as'=>'efinish','uses'=>'astarController@them']);

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
/*--------------------------------------Astar---------------------------------------------------*/
Route::get('testJs',function(){
	return view('admin.cate_list');
});
Route::group(['prefix'=>'admin'],function(){
	Route::group(['prefix'=>'enroll'],function(){
		
		
		Route::post('add',['as'=>'admin.enroll.postAdd','uses'=>'enrollController@postAdd']);
		Route::get('add',['as'=>'admin.enroll.getAdd','uses'=>'enrollController@getAdd']);

		Route::get('list',['as'=>'admin.enroll.getList','uses'=>'enrollController@getList']);
		Route::get('delete/{id}',['as'=>'admin.enroll.delete','uses'=>'enrollController@getDelete']);
		Route::get('edit/{id}',['as'=>'admin.enroll.getEdit','uses'=>'enrollController@getEdit']);
		Route::post('edit/{id}',['as'=>'admin.enroll.postEdit','uses'=>'enrollController@postEdit']);

		Route::get('chuaxeplich',['as'=>'admin.enroll.chuaxeplich','uses'=>'enrollController@getChuaxeplich']);
		Route::post('daxeplich/{id}',['as'=>'admin.enroll.daxeplich','uses'=>'enrollController@postDaxeplich']);

		Route::get('kiemtrahomnay',['as'=>'admin.enroll.kiemtrahomnay','uses'=>'enrollController@getKiemtrahomnay']);
		Route::get('update/{id}',['as'=>'admin.enroll.update','uses'=>'enrollController@update']);

		Route::get('dacoketqua',['as'=>'admin.enroll.dacoketqua','uses'=>'enrollController@getDacoketqua']);
		Route::post('xeplop/{id}',['as'=>'admin.enroll.postXeplop','uses'=>'enrollController@postXeplop']);
		
		Route::get('calendar/{month}/{year}',['uses'=>'enrollController@draw_calendar']);
	});
	Route::group(['prefix'=>'dashboard'],function(){
		Route::get('getDashboard',['as'=>'admin.dashboard','uses'=>'dashboardController@index']);

	});
	Route::group(['prefix'=>'student'], function(){
		Route::get('list',['as'=>'admin.student.getList','uses'=>'studentController@getList']);
		Route::get('class/{id}',['as'=>'admin.student.getClass','uses'=>'studentController@getClass']);
		Route::get('drop/{id}',['as'=>'admin.student.getDrop','uses'=>'studentController@getDrop']);
		Route::get('chuyenlop/{id}',['as'=>'admin.student.getChuyenlop','uses'=>'studentController@getChuyenlop']);
		Route::post('chuyenlop/{id}',['as'=>'admin.student.postChuyenlop','uses'=>'studentController@postChuyenlop']);
		Route::get('edit/{id}',['as'=>'admin.student.getEdit','uses'=>'studentController@getEdit']);
		Route::post('edit/{id}',['as'=>'admin.student.postEdit','uses'=>'studentController@postEdit']);
		Route::group(['prefix'=>'management'],function(){
			Route::get('option/{id}',['as'=>'admin.student.management.getOption','uses'=>'studentController@getOption']);
			Route::get('getTuition/{id}',['as'=>'admin.student.management.getTuition','uses'=>'studentController@getTuition']);
			Route::get('getResult/{id}',['as'=>'admin.student.management.getResult','uses'=>'studentController@getResult']);
			Route::post('postTuition/{id}',['as'=>'admin.student.management.postTuition','uses'=>'studentController@postTuition']);
			Route::post('postMonth/{id}',['as'=>'admin.student.management.postMonth','uses'=>'studentController@postMonth']);
		});
	});
	Route::group(['prefix'=>'class'],function(){
		Route::get('add',['as'=>'admin.class.getAdd','uses'=>'classController@getAdd']);
	 	Route::post('post',['as'=>'admin.class.postAdd','uses'=>'classController@postAdd']);
	 	Route::get('list',['as'=>'admin.class.getList','uses'=>'classController@getList']);
	 	Route::get('edit/{id}',['as'=>'admin.class.getEdit','uses'=>'classController@getEdit']);
	 	Route::get('delete/{id}',['as'=>'admin.class.delete','uses'=>'classController@getDelete']);
	 	Route::post('edit/{id}',['as'=>'admin.class.postEdit','uses'=>'classController@postEdit']);
	 	Route::get('studentList/{id}',['as'=>'admin.class.getStudentList','uses'=>'classController@getStudentList']);
	});
	Route::group(['prefix'=>'day'],function(){
		Route::get('classList',['as'=>'admin.day.getClasslist','uses'=>'dayController@getClasslist']);
		Route::get('addDay/{id}',['as'=>'admin.day.getAdd','uses'=>'dayController@getDay']);
		Route::post('postDay/{id}',['as'=>'admin.day.postAdd','uses'=>'dayController@postDay']);
		Route::get('list/{classId}',['as'=>'admin.day.getList','uses'=>'dayController@getList']);
		Route::get('edit/{id}',['as'=>'admin.day.getEdit','uses'=>'dayController@getEdit']);
		Route::post('edit/{id}',['as'=>'admin.day.postEdit','uses'=>'dayController@postEdit']);
		Route::get('delete/{id}',['as'=>'admin.day.getDelete','uses'=>'dayController@getDelete']);
	});
	Route::group(['prefix'=>'attendance'],function(){
		Route::get('classList',['as'=>'admin.attendance.getClasslist','uses'=>'attendanceController@getClasslist']);
		Route::get('attendance/{classId}',['as'=>'admin.attendance.getAttendance','uses'=>'attendanceController@getAttendance']);
		Route::post('attendance/{classId}',['as'=>'admin.attendance.postAttendance','uses'=>'attendanceController@postAttendance']);
		Route::post('month/{classId}',['as'=>'admin.attendance.postMonth','uses'=>'attendanceController@postMonth']);
		Route::get('hocbu',['as'=>'admin.attendance.getHocbu','uses'=>'attendanceController@getHocbu']);
		Route::post('hocbu/{id}',['as'=>'admin.attendance.postHocbu','uses'=>'attendanceController@postHocbu']);
		Route::post('week',['as'=>'admin.attendance.postWeek','uses'=>'attendanceController@postWeek']);
		});
	Route::get('testStudent',['uses'=>'studentController@testStudent']);
	Route::get('testDay',['uses'=>'studentController@testDay']);
});

