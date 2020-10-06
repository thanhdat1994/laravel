<?php

namespace App\Http\Controllers;

use App\CustomerClass;
use Illuminate\Http\Request;

class CustomerClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customerClasses = CustomerClass::paginate(5);
        return view('customerClass.index', ['customerClasses' => $customerClasses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customerClass.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'inputNameCustomerClass' => 'required'
        ]);
        $customerClasses = new CustomerClass([
            'name' => $request->get('inputNameCustomerClass')
        ]);
        $customerClasses->save();
        return redirect('/admin/customer-class');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerClass $customerClass)
    {
        return view('customerClass.show',compact('customerClass'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomerClass $customerClass)
    {
        return view('customerClass.edit',compact('customerClass'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'inputNameCustomerClass' => 'required'
        ]);
        $customerClasses = CustomerClass::find($id);
        $customerClasses->name = $request->get('inputNameCustomerClass');
        $customerClasses->update();
        return redirect('/admin/customer-class');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerClass $customerClass)
    {
        $customerClass->delete();
        return redirect('/admin/customer-class');
    }
}
