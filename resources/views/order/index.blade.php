@extends('adminlte::page')

@section('title', 'Orders')

@section('content_header')
    <h1>Orders management</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-tools float-left">
                        <div class="input-group input-group-sm mt-0">
                            <input type="text" name="table_search" class="form-control float-right"
                                   placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <h3 class="card-title float-right">
                        <a type="button" class="btn btn-sm btn-success" href="{{ route('order.create') }}"><i class="fas fa-plus"></i> Create</a>
                    </h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap table-head-fixed">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Customer</th>
                            <th>Datetime</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Note</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Detail</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td><a href="{{ route('customer.show', $order->customer_id) }}">{{ $order->customerName->name }}</a></td>
                                <td>{{ date('d/m/Y', strtotime($order->date)) }}</td>
                                <td>{{ $order->customerName->phone }}</td>
                                <td>{{ $order->customerName->address }}</td>
                                <td>{{ $order->note }}</td>
                                <td>{{ number_format($order->amount) }} VNĐ</td>
                                <td>
                                    @if ($order->status == 0)
                                        <span class="badge badge-success">New</span>
                                    @elseif ($order->status == 1)
                                        <span class="badge badge-primary">Processing</span>
                                    @elseif ($order->status == 2)
                                        <span class="badge badge-warning">Shipping</span>
                                    @elseif ($order->status == 3)
                                        <span class="badge badge-danger">Finish</span>
                                    @else
                                        <span class="badge badge-secondary">Cancel</span>
                                    @endif
                                </td>
                                <td>
                                    <table class="table table-bordered table-sm">
                                        <thead>
                                        <tr>
                                            <th class="text-dark">Product</th>
                                            <th class="text-dark">Quantity</th>
                                            <th class="text-dark">Price</th>
                                            <th class="text-dark">Amount</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($order->OrderDetail as $orderDetail)
                                        <tr>
                                            <td>{{ $orderDetail->products->name }}</td>
                                            <td class="text-center">{{ $orderDetail->quantity }}</td>
                                            <td class="text-right">{{ number_format($orderDetail->price) }} VNĐ</td>
                                            <td class="text-right">{{ number_format($orderDetail->price * $orderDetail->quantity)  }} VNĐ</td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td colspan="3">Discount</td>
                                            <td colspan="1" class="text-right">{{ number_format($order->discount_amount) }} VNĐ</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">Total</td>
                                            <td colspan="1" class="text-right text-danger">{{ number_format($order->amount) }} VNĐ</td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </td>
                                <td>
                                    <form action="{{ route('order.destroy',$order->id) }}" method="POST">
                                        <a type="button" class="btn btn-sm btn-primary" href="{{ route('order.edit', $order->id) }}"><i class="fas fa-edit"></i></a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
{{--            <div class="pagination float-right">--}}
{{--                {{ $orders->links() }}--}}
{{--            </div>--}}
        </div>
    </div>
@stop

<?php
    function getDayOfWeek($date)
    {
        $dayOfWeek = date('w', strtotime($date));
        $days = array('Sunday', 'Monday', 'Tuesday', 'Wednesday','Thursday','Friday', 'Saturday');
        $result = $days[$dayOfWeek];
        return $result;
    }

    function formatDate($date)
    {
        return $dayOfWeek = getDayOfWeek($date) . " : " . date('d/m/Y', strtotime($date));
    }
?>
