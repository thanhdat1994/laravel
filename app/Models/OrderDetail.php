<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model {
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'order_details';

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
	public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'order_id', 'product_id', 'quantity', 'price',
	];

	/**
	 * Get the owning order model.
	 */
	public function order() {
		return $this->belongsTo('App\Order', 'order_id');
	}

	/**
	 * Get the product name.
	 */
	public function products() {
		return $this->hasOne('App\Product', 'id', 'product_id');
	}
}
