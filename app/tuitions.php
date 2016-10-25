<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class tuitions extends Model {
	protected $table='tuitions';
	protected $fillable=['tuitionNumber','class_studentNumber','month','totalTuition','received','remained','note','dayReceive',
	'other','previousRemained'];
	protected $primaryKey='tuitionNumber';
	public $timstamp=true;
	
	//

}
