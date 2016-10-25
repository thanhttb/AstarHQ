<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendanceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('attendance', function(Blueprint $table)
		{
			$table->increments('attendanceNumber');
			$table->integer('class_studentNumber');
			$table->integer('dayNumber');
			$table->integer('statusNumber');
			$table->integer('discount')->default(0);
			$table->tinyInteger('score1');
			$table->tinyInteger('score2');
			$table->text('note');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('attendance');
	}

}
