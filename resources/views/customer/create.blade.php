@extends('adminlte::page')

@section('title', 'Customers')

@section('content_header')
    <h1>Create Customer</h1>
@stop

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"/>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title float-right">
                        <a type="button" class="btn btn-sm btn-success" href="{{ route('customer.index') }}"><i class="fas fa-backspace"></i> Back</a>
                    </h3>
                </div>
                <form action="{{ route('customer.store') }}" method="POST" class="form-horizontal justify-content-center align-items-center">
                    @csrf
                    <div class="card-body col-6">
                        <div class="form-group row">
                            <label for="inputNameCustomer" class="col-sm-4 col-form-label text-right">Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="inputNameCustomer" placeholder="Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputSexCustomer" class="col-sm-4 col-form-label text-right">Sex</label>
                            <div class="col-sm-8 row mt-2">
                                <div class="form-check mr-5 ml-2">
                                    <input class="form-check-input" type="radio" name="inputSexCustomer" value="0">
                                    <label class="form-check-label">Male</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="inputSexCustomer" value="1">
                                    <label class="form-check-label">Female</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputBirthdayCustomer" class="col-sm-4 col-form-label text-right">Birthday</label>
                            <div class="col-sm-8">
                                <div class="input-group date">
                                    <input type="text" id="datepicker" name="inputBirthdayCustomer" placeholder="dd/mm/yyyy" class="form-control datetimepicker-input"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputAddressCustomer" class="col-sm-4 col-form-label text-right">Address</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="inputAddressCustomer" placeholder="Address">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPhoneCustomer" class="col-sm-4 col-form-label text-right">Phone</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="inputPhoneCustomer" placeholder="Phone">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputNoteCustomer" class="col-sm-4 col-form-label text-right">Note</label>
                            <div class="col-sm-8">
                                <textarea type="text" class="form-control" name="inputNoteCustomer" placeholder="Note"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputCustomerClassCustomer" class="col-sm-4 col-form-label text-right">Customer Class</label>
                            <div class="col-sm-8">
                                <select name="inputCustomerClassCustomer" class="form-control" placeholder="Customer Class">
                                    @foreach ($customerClass as $key => $value)
                                        <option value={{ $key }}>{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-success"><i class="fas fa-plus-square"></i> Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript">
        $(function () {
            $('#datepicker').datepicker({
                format: 'dd/mm/yyyy',
                autoclose: true,
                todayHighlight: true,
            });
        })
    </script>
@stop
