<?php

namespace App\Http\Controllers;

use App\ProductInventory;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductInventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inventories = ProductInventory::paginate(10);
        return view('inventory/index', ['inventories' => $inventories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = DB::table('products')->distinct()->pluck('name', 'id');
        return view('inventory.create', ['product' => $product]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'inputProduct'  => 'required',
                'inputDate'     => 'required',
                'inputQuantity' => 'required',
                'inputPrice'    => 'required',
            ]);
            $date       = date('Y-m-d', strtotime(str_replace('/', '-', $request->get('inputDate'))));
            $product_id = $request->get('inputProduct');
            $quantity   = $request->get('inputQuantity');
            $inventory  = new ProductInventory([
                'product_id' => $product_id,
                'quantity'   => $quantity,
                'date'       => $date,
                'price'      => str_replace(',', '', $request->get('inputPrice')),
                'note'       => $request->get('inputNote'),
            ]);
            if ($inventory->save()) {
                $product = new Product();
                $product->createQuantityProduct($product_id, $quantity);
            }
            return redirect('/admin/inventory');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductInventory $inventory)
    {
        $product = DB::table('products')->distinct()->pluck('name', 'id');
        return view('inventory.edit', compact('inventory'), ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->isMethod('patch')) {
            $request->validate([
                'inputProduct'  => 'required',
                'inputDate'     => 'required',
                'inputQuantity' => 'required',
                'inputPrice'    => 'required',
            ]);
            $date                  = date('Y-m-d', strtotime(str_replace('/', '-', $request->get('inputDate'))));
            $product_id            = $request->get('inputProduct');
            $quantity              = $request->get('inputQuantity');
            $old_quantity          = $request->get('inputOldQuantity');
            $inventory             = ProductInventory::find($id);
            $inventory->product_id = $product_id;
            $inventory->date       = $date;
            $inventory->quantity   = $quantity;
            $inventory->price      = str_replace(',', '', $request->get('inputPrice'));
            $inventory->note       = $request->get('inputNote');
            if ($inventory->update()) {
                $product = new Product();
                $product->updateQuantityProduct($product_id, $quantity, $old_quantity);
            }
            return redirect('/admin/inventory');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, ProductInventory $inventory)
    {
        $old_quantity = $request->get('inputOldQuantity');
        $product_id   = $request->get('inputProductId');
        if ($inventory->delete()) {
            $product = new Product();
            $product->deleteQuantityProduct($product_id, $old_quantity);
        }
        return redirect('/admin/inventory');
    }
}
