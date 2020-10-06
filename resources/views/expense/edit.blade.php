@extends('adminlte::page')

@section('title', 'Expense')

@section('content_header')
    <h1>Update Expense</h1>
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
                        <a type="button" class="btn btn-sm btn-success" href="{{ route('expense.index') }}"><i class="fas fa-backspace"></i> Back</a>
                    </h3>
                </div>
                <form action="{{ route('expense.update', $expense->id) }}" method="POST" class="form-horizontal justify-content-center align-items-center">
                    @method('PATCH')
                    @csrf
                    <div class="card-body col-6">
                        <div class="form-group row">
                            <label for="inputDate" class="col-sm-4 col-form-label text-right">Date</label>
                            <div class="col-sm-8">
                                <div class="input-group date">
                                    <input type="text" id="datepicker" name="inputDate" placeholder="dd/mm/yyyy" class="form-control datetimepicker-input" value="{{ date('d/m/Y', strtotime($expense->date)) }}"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputAmount" class="col-sm-4 col-form-label text-right">Amount</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="currency" name="inputAmount"
                                       placeholder="Amount" value="{{ number_format($expense->amount) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputType" class="col-sm-4 col-form-label text-right">Type</label>
                            <div class="col-sm-8">
                                <select name="inputType" class="form-control" placeholder="Status">
                                    @foreach (Expense::TYPE as $key => $value)
                                        <option value={{ $key }} {{ $key == $expense->type ? 'selected="selected"' : '' }}>{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputNote" class="col-sm-4 col-form-label text-right">Note</label>
                            <div class="col-sm-8">
                                <textarea type="text" class="form-control" name="inputNote" placeholder="Note">{{ $expense->note }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-success"><i class="fas fa-plus-square"></i> Update</button>
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
        var format = function(num){
            var str = num.toString().replace("$", ""), parts = false, output = [], i = 1, formatted = null;
            if(str.indexOf(".") > 0) {
                parts = str.split(".");
                str = parts[0];
            }
            str = str.split("").reverse();
            for(var j = 0, len = str.length; j < len; j++) {
                if(str[j] != ",") {
                    output.push(str[j]);
                    if(i%3 == 0 && j < (len - 1)) {
                        output.push(",");
                    }
                    i++;
                }
            }
            formatted = output.reverse().join("");
            return(formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
        };
        $(function(){
            $("#currency").keyup(function(e){
                $(this).val(format($(this).val()));
            });
        });
    </script>
@stop
