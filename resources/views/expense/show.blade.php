@extends('adminlte::page')

@section('title', 'Expense')

@section('content_header')
    <h1>Detail Expense</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title float-right">
                        <a type="button" class="btn btn-sm btn-success" href="{{ route('expense.index') }}"><i class="fas fa-backspace"></i> Back</a>
                    </h3>
                </div>
                <form class="form-horizontal justify-content-center align-items-center">
                    <div class="card-body col-6">
                        <div class="form-group row">
                            <label for="inputDate" class="col-sm-4 col-form-label text-right">Date</label>
                            <div class="col-sm-8">
                                <div class="input-group date">
                                    <input type="text" readonly="true" name="inputDate" placeholder="dd/mm/yyyy" class="form-control datetimepicker-input" value="{{ date('d/m/Y', strtotime($expense->date)) }}"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputAmount" class="col-sm-4 col-form-label text-right">Amount</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="currency" name="inputAmount" readonly="true"
                                       placeholder="Amount" value="{{ number_format($expense->amount) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputType" class="col-sm-4 col-form-label text-right">Type</label>
                            <div class="col-sm-8">
                                <select name="inputType" class="form-control" placeholder="Status" readonly="true">
                                    @foreach (Expense::TYPE as $key => $value)
                                        <option disabled value={{ $key }} {{ $key == $expense->type ? 'selected="selected"' : '' }}>{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputNote" class="col-sm-4 col-form-label text-right">Note</label>
                            <div class="col-sm-8">
                                <textarea type="text" readonly="true" class="form-control" name="inputNote" placeholder="Note">{{ $expense->note }}</textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
