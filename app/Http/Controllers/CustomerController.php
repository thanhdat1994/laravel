<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Exports\CustomerExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class CustomerController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$customers = Customer::paginate(10);
		return view('customer.index', ['customers' => $customers]);
	}

	public function search(Request $request)
    {
        if ($request->ajax()) {
            $data = Customer::search($request->get('search_query'))->get();
            return response()->json($data);
        }
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$customerClass = DB::table('customer_classes')->distinct()->pluck('name', 'id');
		return view('customer.create', ['customerClass' => $customerClass]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		if ($request->isMethod('post')) {
			$request->validate([
				'inputNameCustomer' => 'required',
				'inputSexCustomer' => 'required',
				'inputBirthdayCustomer' => 'required',
				'inputAddressCustomer' => 'required',
				'inputPhoneCustomer' => 'required',
				'inputCustomerClassCustomer' => 'required',
			]);
			$birthday = date('Y-m-d', strtotime(str_replace('/', '-', $request->get('inputBirthdayCustomer'))));
			$customer = new Customer([
				'name' => $request->get('inputNameCustomer'),
				'sex' => $request->get('inputSexCustomer'),
				'birthday' => $birthday,
				'address' => $request->get('inputAddressCustomer'),
				'phone' => $request->get('inputPhoneCustomer'),
				'note' => $request->get('inputNoteCustomer'),
				'customer_class_id' => $request->get('inputCustomerClassCustomer'),
			]);
			$customer->save();
			return redirect('/admin/customer');
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show(Customer $customer) {
		return view('customer.show', compact('customer'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Customer $customer) {
		$customerClass = DB::table('customer_classes')->distinct()->pluck('name', 'id');
		return view('customer.edit', compact('customer'), ['customerClass' => $customerClass]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		if ($request->isMethod('patch')) {
			$request->validate([
				'inputNameCustomer' => 'required',
				'inputSexCustomer' => 'required',
				'inputBirthdayCustomer' => 'required',
				'inputAddressCustomer' => 'required',
				'inputPhoneCustomer' => 'required',
				'inputCustomerClassCustomer' => 'required',
			]);
			$birthday = date('Y-m-d', strtotime(str_replace('/', '-', $request->get('inputBirthdayCustomer'))));
			$customer = Customer::find($id);
			$customer->name = $request->get('inputNameCustomer');
			$customer->sex = $request->get('inputSexCustomer');
			$customer->birthday = $birthday;
			$customer->address = $request->get('inputAddressCustomer');
			$customer->phone = $request->get('inputPhoneCustomer');
			$customer->note = $request->get('inputNoteCustomer');
			$customer->customer_class_id = $request->get('inputCustomerClassCustomer');
			$customer->update();
			return redirect('/admin/customer');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Customer $customer) {
		$customer->delete();
		return redirect('/admin/customer');
	}

    /**
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
	public function export()
    {
        $header = ['ID', 'Name', 'Sex', 'Birthday', 'Address', 'Phone', 'Note', 'Customer Class'];
        return Excel::download(new CustomerExport(), 'customer.xlsx', null, $header);
    }
}
