<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class class_student extends Model {
	protected $table='class_student';
	protected $fillable=['id','studentNumber','classNumber','start','end','note'];
	public $timstamps=false;
	protected $primaryKey='id';
	public function day(){
		return $this->belongsToMany('days','attendances','id','class_studentNumber');
	}

	//

}
