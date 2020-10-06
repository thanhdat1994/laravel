<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(10);
        return view('product/index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = DB::table('categories')->distinct()->pluck('name', 'id');
        return view('product.create', ['category' => $category]);
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
                'inputNameProduct' => 'required',
                'inputPrice'       => 'required',
                'inputCategory'    => 'required',
            ]);
            $product = new Product([
                'name'        => $request->get('inputNameProduct'),
                'quantity'    => 0,
                'price'       => str_replace(',', '', $request->get('inputPrice')),
                'note'        => $request->get('inputNoteProduct'),
                'category_id' => $request->get('inputCategory'),
            ]);
            $product->save();
            return redirect('/admin/product');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $category = DB::table('categories')->distinct()->pluck('name', 'id');
        return view('product.edit', compact('product'), ['category' => $category]);
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
                'inputNameProduct' => 'required',
                'inputPrice'       => 'required',
                'inputCategory'    => 'required',
            ]);
            $product              = Product::find($id);

            $product->name        = $request->get('inputNameProduct');
            $product->price       = str_replace(',', '', $request->get('inputPrice'));
            $product->note        = $request->get('inputNoteProduct');
            $product->category_id = $request->get('inputCategory');
            $product->update();
            return redirect('/admin/product');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect('/admin/product');
    }
}
