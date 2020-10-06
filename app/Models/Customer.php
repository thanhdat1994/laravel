<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model {
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'customers';

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
		'name', 'sex', 'birthday', 'address', 'phone', 'note', 'customer_class_id',
	];

	/**
	 * Get the owning customer class model.
	 */
	public function customerClass() {
		return $this->belongsTo('App\CustomerClass', 'customer_class_id');
	}

	public function getCustomerByPhone($phone) {
		$customer = Customer::where(['phone' => $phone])->get();
		return $customer ?? [];
	}

	/**
	 * Get all of the customers.
	 */
	public function orders() {
		return $this->hasMany('App\Order', 'customer_id');
	}
}
