<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class subject extends Model {
	protected $table='subjects';
	protected $fillable=['subjectNumber','subjectName'];
	protected $primaryKey='subjectNumber';
	public $timestamp=false;
	//

}
