@extends('adminlte::page')

@section('title', 'Customer classes')

@section('content_header')
    <h1>Detail customer class</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title float-right">
                        <a type="button" class="btn btn-sm btn-success" href="{{ route('customer-class.index') }}"><i class="fas fa-backspace"></i> Back</a>
                        <a type="button" class="btn btn-sm btn-primary" href="{{ route('customer-class.edit', $customerClass->id) }}"><i class="fas fa-edit"></i> Edit</a>
                    </h3>
                </div>
                <form class="form-horizontal justify-content-center align-items-center">
                    <div class="card-body col-6">
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-4 col-form-label text-right">Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" placeholder="Name" readonly="true" value="{{ $customerClass->name }}">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
