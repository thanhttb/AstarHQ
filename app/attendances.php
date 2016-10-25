<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class attendances extends Model {
	protected $table='attendance';
	protected $fillable=['attendanceNumber','class_studentNumber','dayNumber','statusNumber','discount','score1','score2','note','create_at','updated_at','hocbuNote','hocbuHandler','hocbuDay','hocbuStatus'];
	protected $primaryKey='attendanceNumber';

	//

}
