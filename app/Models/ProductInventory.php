<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductInventory extends Model {
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'product_inventories';

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
		'product_id', 'date', 'quantity', 'price', 'note',
	];

	/**
	 * Get name product model.
	 */
	public function products() {
		return $this->belongsTo('App\Product', 'product_id');
	}
}
