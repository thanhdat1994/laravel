@extends('adminlte::page')

@section('title', 'Products')

@section('content_header')
    <h1>Detail Product</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title float-right">
                        <a type="button" class="btn btn-sm btn-success" href="{{ route('product.index') }}"><i class="fas fa-backspace"></i> Back</a>
                        <a type="button" class="btn btn-sm btn-primary" href="{{ route('product.edit', $product->id) }}"><i class="fas fa-edit"></i> Edit</a>
                    </h3>
                </div>
                <form class="form-horizontal justify-content-center align-items-center">
                    <div class="card-body col-6">
                        <div class="form-group row">
                            <label for="inputNameProduct" class="col-sm-4 col-form-label text-right">Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="inputNameProduct" placeholder="Name" readonly="true" value="{{ $product->name }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputQuantity" class="col-sm-4 col-form-label text-right">Quantity</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="inputQuantity" placeholder="Quantity" readonly="true" value="{{ $product->quantity }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPrice" class="col-sm-4 col-form-label text-right">Price</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="inputPrice" placeholder="Price" readonly="true" value="{{ number_format($product->price) }} VNĐ">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputNoteProduct" class="col-sm-4 col-form-label text-right">Note</label>
                            <div class="col-sm-8">
                                <textarea type="text" class="form-control" name="inputNoteProduct" placeholder="Note" readonly="true">{{ $product->note }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputCategory" class="col-sm-4 col-form-label text-right">Category</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="inputCategory" placeholder="Category" readonly="true" value="{{ $product->category->name }}">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
