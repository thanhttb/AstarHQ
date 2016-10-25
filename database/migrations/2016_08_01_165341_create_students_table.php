<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('students', function(Blueprint $table)
		{
			$table->increments('studentNumber');
			$table->string('lastName');
			$table->string('firstName');
			$table->date('birthday')->nullable();
			$table->string('school')->nullable();
			$table->tinyInteger('class');
			$table->string('phone')->nullable();
			$table->string('email')->nullable();
			$table->string('parentName');
			$table->string('gender');
			$table->string('parentPhone1');
			$table->string('parentPhone2')->nullable();
			$table->string('parentEmail');
			$table->string('parentWork');
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
		Schema::drop('students');
	}

}
