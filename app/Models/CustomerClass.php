<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerClass extends Model {
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'customer_classes';

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
		'name', 'path',
	];

	/**
	 * Get all of the customers.
	 */
	public function customers() {
		return $this->hasMany('App\Customer', 'customer_class_id');
	}
}
