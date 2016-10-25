<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class classes extends Model {
	protected $table='classes';
	protected $fillable=['classNumber','className','description','day','startTime','endTime','location','sum','tuition'];
	public $timstamps=false;
	protected $primaryKey='classNumber';
	public function student()
	{
		return $this->belongsToMany('App/students','class_student','classNumber','studentNumber');
	}

	//

}
