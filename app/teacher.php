<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class teacher extends Model {
	protected $table='teachers';
	protected $fillable=['teachNumber','teacherName','work','subjectNumber','phone','email','ad'];
	protected $primaryKey='teachNumber';
	public $timestamp=false;
	//

}
