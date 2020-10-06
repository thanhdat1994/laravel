@extends('adminlte::page')

@section('title', 'Customers')

@section('content_header')
    <h1>Detail Customer</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title float-right">
                        <a type="button" class="btn btn-sm btn-success" href="{{ route('customer.index') }}"><i class="fas fa-backspace"></i> Back</a>
                        <a type="button" class="btn btn-sm btn-primary" href="{{ route('customer.edit', $customer->id) }}"><i class="fas fa-edit"></i> Edit</a>
                    </h3>
                </div>
                <form class="form-horizontal justify-content-center align-items-center">
                    <div class="card-body col-6">
                        <div class="form-group row">
                            <label for="inputNameCustomer" class="col-sm-4 col-form-label text-right">Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="inputNameCustomer" placeholder="Name" readonly="true" value="{{ $customer->name }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputSexCustomer" class="col-sm-4 col-form-label text-right">Sex</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="inputSexCustomer" placeholder="Sex" readonly="true" value="{{ $customer->sex == 0 ? 'Nam' : 'Nữ' }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputBirthdayCustomer" class="col-sm-4 col-form-label text-right">Birthday</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="inputBirthdayCustomer" placeholder="Birthday" readonly="true" value="{{ date('d/m/Y', strtotime($customer->birthday)) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputAddressCustomer" class="col-sm-4 col-form-label text-right">Address</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="inputAddressCustomer" placeholder="Address" readonly="true" value="{{ $customer->address }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPhoneCustomer" class="col-sm-4 col-form-label text-right">Phone</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="inputPhoneCustomer" placeholder="Phone" readonly="true" value="{{ $customer->phone }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputNoteCustomer" class="col-sm-4 col-form-label text-right">Note</label>
                            <div class="col-sm-8">
                                <textarea type="text" class="form-control" name="inputNoteCustomer" placeholder="Note" readonly="true">{{ $customer->note }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputCustomerClassCustomer" class="col-sm-4 col-form-label text-right">Customer Class</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="inputCustomerClassCustomer" placeholder="Customer Class" readonly="true" value="{{ $customer->customerClass->name }}">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
