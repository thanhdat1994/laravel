<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'products';

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
		'name',
		'quantity',
		'price',
		'note',
		'category_id',
	];

	/**
	 * Get the owning category model.
	 */
	public function category() {
		return $this->belongsTo('App\Category', 'category_id');
	}

	/**
	 * Get the owning product inventory model.
	 */
	public function inventory() {
		return $this->hasMany('App\ProductInventory', 'product_id');
	}

	/***
		     * Create quantity product
		     *
		     * @param $product_id
		     * @param $quantity
	*/
	public function createQuantityProduct($product_id, $quantity) {
		$product = Product::find($product_id);
		$product->quantity += $quantity;
		$product->update();
	}

	/***
		     * Update quantity product
		     *
		     * @param $product_id
		     * @param $quantity
		     * @param $old_quantity
	*/
	public function updateQuantityProduct($product_id, $quantity, $old_quantity) {
		$product = Product::find($product_id);
		$product->quantity = $product->quantity - $old_quantity + $quantity;
		$product->update();
	}

	/***
		     * Delete quantity product
		     *
		     * @param $product_id
		     * @param $old_quantity
	*/
	public function deleteQuantityProduct($product_id, $old_quantity) {
		$product = Product::find($product_id);
		$product->quantity = $product->quantity - $old_quantity;
		$product->update();
	}

	/**
	 * Get the owning order detail model.
	 */
	public function orderDetail() {
		return $this->hasOne('App\OrderDetail', 'product_id', 'id');
	}
}
