<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpenseTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('expenses', function (Blueprint $table) {
			$table->increments('id');
			$table->dateTime('date');
			$table->integer('amount');
			$table->tinyInteger('type')->comment('0: Cố định, 1: Phát sinh, 2: Quảng cáo, 3: Lương');
			$table->string('note')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('expense');
	}
}
