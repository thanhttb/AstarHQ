<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTuitionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tuitions', function(Blueprint $table)
		{
			$table->increments('tuitionNumber');
			$table->integer('class_studentNumber');
			$table->tinyInteger('month');
			$table->bigInteger('totalTuition');
			$table->bigInteger('received');
			$table->bigInteger('remained');
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
		Schema::drop('tuitions');
	}

}
