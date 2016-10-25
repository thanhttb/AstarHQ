<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class students extends Model {
	protected  $table='students';
	protected $fillable=['studentNumber','lastName','firstName','birthday','school','class',
						'phone','email','parentName','parentGender','parentPhone1',
						'parentPhone2','parentEmail','parentWork'];
	//public $timestamps=false;
	protected $primaryKey='studentNumber';
	
	public function enroll(){
		return $this->hasMany('App\enrolls','studentNumber');
	}
	public function classes(){
		return $this->belongsToMany('App\classes','class_student','studentNumber','classNumber');
	}


}
