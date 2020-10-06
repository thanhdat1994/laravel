<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Order;
use App\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::has('OrderDetail')->get();
        return view('order/index', ['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product       = DB::table('products')->distinct()->pluck('name', 'id');
        $price         = DB::table('products')->distinct()->pluck('price', 'id');
        $customerClass = DB::table('customer_classes')->distinct()->pluck('name', 'id');
        return view('order.create', [
            'product'       => $product,
            'price'         => $price,
            'customerClass' => $customerClass,
        ]);
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
                'inputPhoneCustomer'         => 'required',
                'inputNameCustomer'          => 'required',
                'inputSexCustomer'           => 'required',
                'inputCustomerClassCustomer' => 'required',
                'inputDate'                  => 'required',
                'inputTime'                  => 'required',
                'product_id'                 => 'required',
                'quantity'                   => 'required',
                'price'                      => 'required',
                'inputTotal'                 => 'required',
            ]);
            $name              = $request->get('inputNameCustomer');
            $phone             = $request->get('inputPhoneCustomer');
            $sex               = $request->get('inputSexCustomer');
            $birthday          = date('Y-m-d',
                strtotime(str_replace('/', '-', $request->get('inputBirthdayCustomer'))));
            $address           = $request->get('inputAddressCustomer');
            $note              = $request->get('inputNoteCustomer');
            $customer_class_id = $request->get('inputCustomerClassCustomer');
            $date              = date('Y-m-d', strtotime(str_replace('/', '-', $request->get('inputDate'))));
            $time              = date('h:i:s', strtotime($request->get('inputTime')));

            $dataOrder  = [
                'datetime'        => $date." ".$time,
                'amount'          => str_replace(',', '', $request->get('inputTotal')),
                'discount_amount' => str_replace(',', '', $request->get('inputDiscount')),
                'note'            => $request->get('inputNote'),
            ];
            $dataDetail = [
                'id'       => $request->get('product_id'),
                'quantity' => $request->get('quantity'),
                'price'    => str_replace(',', '', $request->get('price')),
            ];

            $customerModel = new Customer();
            $customer      = $customerModel->getCustomerByPhone($phone);
            DB::beginTransaction();
            try {
                if (!empty($customer[0])) {
                    $customer[0]->name              = $name;
                    $customer[0]->sex               = $sex;
                    $customer[0]->birthday          = $birthday;
                    $customer[0]->address           = $address;
                    $customer[0]->note              = $note;
                    $customer[0]->customer_class_id = $customer_class_id;
                    $customer[0]->update();
                    $customer_id = $customer[0]->id;
                    $this->createOrder($dataOrder, $dataDetail, $customer_id);
                } else {
                    $new_customer = new Customer([
                        'name'              => $name,
                        'sex'               => $sex,
                        'birthday'          => $birthday,
                        'address'           => $address,
                        'phone'             => $phone,
                        'note'              => $note,
                        'customer_class_id' => $customer_class_id,
                    ]);
                    $new_customer->save();
                    $new_customer_id = $new_customer->id;
                    $this->createOrder($dataOrder, $dataDetail, $new_customer_id);
                }
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
            }
            return redirect('/admin/order');
        }
    }

    private function createOrder($dataOrder, $dataDetail, $customer_id)
    {

        $productId = $dataDetail['id'];
        $quantity  = $dataDetail['quantity'];
        $price     = $dataDetail['price'];

        $order = new Order([
            'customer_id'     => $customer_id,
            'date'            => $dataOrder['datetime'],
            'amount'          => $dataOrder['amount'],
            'discount_amount' => $dataOrder['discount_amount'],
            'status'          => 0,
            'note'            => $dataOrder['note'],
        ]);
        $order->save();
        $order_id = $order->id;

        for ($i = 0; $i < count($productId); $i++) {
            $order_detail = new OrderDetail([
                'order_id'   => $order_id,
                'product_id' => $productId[$i],
                'quantity'   => $quantity[$i],
                'price'      => $price[$i],
            ]);
            $order_detail->save();
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
    public function edit(Order $order)
    {
        $product       = DB::table('products')->distinct()->pluck('name', 'id');
        $price         = DB::table('products')->distinct()->pluck('price', 'id');
        $customerClass = DB::table('customer_classes')->distinct()->pluck('name', 'id');
        return view('order.edit', compact('order'), [
            'product'       => $product,
            'price'         => $price,
            'customerClass' => $customerClass,
        ]);
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
                'inputPhoneCustomer'         => 'required',
                'inputNameCustomer'          => 'required',
                'inputSexCustomer'           => 'required',
                'inputCustomerClassCustomer' => 'required',
                'inputStatus'                => 'required',
                'inputDate'                  => 'required',
                'inputTime'                  => 'required',
                'product_id'                 => 'required',
                'quantity'                   => 'required',
                'price'                      => 'required',
                'inputTotal'                 => 'required',
            ]);

            $date = date('Y-m-d', strtotime(str_replace('/', '-', $request->get('inputDate'))));
            $time = date('h:i:s', strtotime($request->get('inputTime')));

            $dataCustomer = [
                'name'              => $request->get('inputNameCustomer'),
                'phone'             => $request->get('inputPhoneCustomer'),
                'sex'               => $request->get('inputSexCustomer'),
                'birthday'          => date('Y-m-d',
                    strtotime(str_replace('/', '-', $request->get('inputBirthdayCustomer')))),
                'address'           => $request->get('inputAddressCustomer'),
                'note'              => $request->get('inputNoteCustomer'),
                'customer_class_id' => $request->get('inputCustomerClassCustomer'),
            ];
            $customerId = $this->updateCustomer($dataCustomer);

            $dataOrder  = [
                'customer_id'     => $request->get('inputIdCustomer'),
                'datetime'        => $date." ".$time,
                'amount'          => str_replace(',', '', $request->get('inputTotal')),
                'discount_amount' => str_replace(',', '', $request->get('inputDiscount')),
                'status'          => $request->get('inputStatus'),
                'note'            => $request->get('inputNote'),
            ];
            $dataDetail = [
                'id'       => $request->get('product_id'),
                'quantity' => $request->get('quantity'),
                'price'    => str_replace(',', '', $request->get('price')),
            ];
            $this->updateOrder($id, $dataOrder, $dataDetail, $customerId);

            return redirect('/admin/order');
        }
    }

    private function updateCustomer($dataCustomer)
    {
        $customerModel = new Customer();
        $customer      = $customerModel->getCustomerByPhone($dataCustomer['phone']);
        DB::beginTransaction();
        try {
            if (!empty($customer[0])) {
                $customer[0]->name              = $dataCustomer['name'];
                $customer[0]->sex               = $dataCustomer['sex'];
                $customer[0]->birthday          = $dataCustomer['birthday'];
                $customer[0]->address           = $dataCustomer['address'];
                $customer[0]->phone             = $dataCustomer['phone'];
                $customer[0]->note              = $dataCustomer['note'];
                $customer[0]->customer_class_id = $dataCustomer['customer_class_id'];
                $customer[0]->update();
                DB::commit();
                return $customer[0]->id;
            } else {
                $new_customer = new Customer([
                    'name'              => $dataCustomer['name'],
                    'sex'               => $dataCustomer['sex'],
                    'birthday'          => $dataCustomer['birthday'],
                    'address'           => $dataCustomer['address'],
                    'phone'             => $dataCustomer['phone'],
                    'note'              => $dataCustomer['note'],
                    'customer_class_id' => $dataCustomer['customer_class_id'],
                ]);
                $new_customer->save();
                DB::commit();
                return $new_customer->id;
            }
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }

    private function updateOrder($id, $dataOrder, $dataDetail, $customerId)
    {
        DB::beginTransaction();
        try {
            $order                  = Order::find($id);
            $order->customer_id     = $customerId;
            $order->date            = $dataOrder['datetime'];
            $order->amount          = $dataOrder['amount'];
            $order->discount_amount = $dataOrder['discount_amount'];
            $order->status          = $dataOrder['status'];
            $order->note            = $dataOrder['note'];
            $order->update();
            DB::table('order_details')->where('order_id', $id)->delete();
            $productId = $dataDetail['id'];
            $quantity  = $dataDetail['quantity'];
            $price     = $dataDetail['price'];
            for ($i = 0; $i < count($productId); $i++) {
                $order_detail = new OrderDetail([
                    'order_id'   => $id,
                    'product_id' => $productId[$i],
                    'quantity'   => $quantity[$i],
                    'price'      => $price[$i],
                ]);
                $order_detail->save();
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function ajaxGetCustomerByPhone(Request $request)
    {
        $customer = new Customer();
        if ($request->isMethod('post')) {
            $phone = $request->all()['phone'];
            return response()->json($customer->getCustomerByPhone($phone));
        }
    }
}
