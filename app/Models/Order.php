<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'orders';

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
		'customer_id', 'date', 'amount', 'discount_amount', 'status', 'note',
	];

	const STATUS = [
		0 => 'New',
		1 => 'Processing',
		2 => 'Shipping',
		3 => 'Finish',
		4 => 'Cancel',
	];

	/**
	 * Get the owning customer model.
	 */
	public function customerName() {
		return $this->belongsTo('App\Customer', 'customer_id');
	}

	/**
	 * Get all of the order detail.
	 */
	public function orderDetail() {
		return $this->hasMany(OrderDetail::class, 'order_id', 'id');
	}
}
