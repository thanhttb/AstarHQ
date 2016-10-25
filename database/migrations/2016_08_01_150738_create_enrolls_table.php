<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnrollsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('enrolls', function(Blueprint $table)
		{
			$table->increments('enrollNumber');
			$table->integer('studentNumber');
			$table->string('subject');
			$table->dateTime('entranceTestDate');
			$table->text('note');
			$table->string('result');
			$table->tinyInteger('status');
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
		Schema::drop('enrolls');
	}

}
