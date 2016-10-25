<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class days extends Model {
	protected $table='day';
	protected $fillable=['dayNumber','classNumber','day','tuition','teacherNumber','note'];
	protected $primaryKey='dayNumber';
	public $timestamp=false;
	//
	public function class_student(){
		return $this->belongsToMany('App/class_student','attendances','dayNumber','class_studentNumber');
	}
}
