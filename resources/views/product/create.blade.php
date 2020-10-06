@extends('adminlte::page')

@section('title', 'Products')

@section('content_header')
    <h1>Create Product</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title float-right">
                        <a type="button" class="btn btn-sm btn-success" href="{{ route('product.index') }}"><i class="fas fa-backspace"></i> Back</a>
                    </h3>
                </div>
                <form action="{{ route('product.store') }}" method="POST" class="form-horizontal justify-content-center align-items-center">
                    @csrf
                    <div class="card-body col-6">
                        <div class="form-group row">
                            <label for="inputCategory" class="col-sm-4 col-form-label text-right">Category</label>
                            <div class="col-sm-8">
                                <select name="inputCategory" class="form-control" placeholder="Category">
                                    @foreach ($category as $key => $value)
                                        <option value={{ $key }}>{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputNameProduct" class="col-sm-4 col-form-label text-right">Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="inputNameProduct" placeholder="Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPrice" class="col-sm-4 col-form-label text-right">Price</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="currency" name="inputPrice" placeholder="Price">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputNoteProduct" class="col-sm-4 col-form-label text-right">Note</label>
                            <div class="col-sm-8">
                                <textarea type="text" class="form-control" name="inputNoteProduct" placeholder="Note"></textarea>
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
    <script type="text/javascript">
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
