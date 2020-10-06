<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model {
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'expenses';

	/**
	 * The primary key associated with the table.
	 *
	 * @var string
	 */
	protected $primaryKey = 'id';

	/**
	 * Indicates if the IDs are auto-incrementing.
	 *
	 * @var bool
	 */
	public $incrementing = true;

	/**
	 * Indicates if the model should be timestamped.
	 *
	 * @var bool
	 */
	public $timestamps = true;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'date', 'amount', 'type', 'note',
	];

	const TYPE = [
		0 => 'Cố định',
		1 => 'Phát sinh',
		2 => 'Quảng cáo',
		3 => 'Lương',
	];
}
