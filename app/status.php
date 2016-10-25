<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class status extends Model {
	protected $table='statuses';
	protected $fillable=['statusNumber','group','status'];
		protected $primaryKey='statusNumber';
	public $timestamps=false;
	public function enroll(){
		return $this->hasMany('App/enrolls','statusNumber');
	}
	//

}
