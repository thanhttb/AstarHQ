<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class enrolls extends Model {
	protected  $table='enrolls';
	protected $fillable=['enrollNumber','studentNumber','subject','entranceTestDate','note',
						'result','statusNumber'];

	protected $primaryKey='enrollNumber';
	public function student()
	{
		return $this->belongsTo('App\students','studentNumber');
	}
	public function status()
	{
		return $this->belongsTo('App\statuses','statusNumber');
	}
}
