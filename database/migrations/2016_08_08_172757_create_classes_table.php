<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('classes', function(Blueprint $table)
		{
			$table->increments('classeNumber');
			$table->string('className');
			$table->string('description');
			$table->tinyInteger('day');
			$table->time('starTime');
			$table->time('endTime');
			$table->string('location');
			$table->tinyInteger('sum');
			$table->integer('tuition');
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
		//
		Schema::drop('classes');
	}

}
