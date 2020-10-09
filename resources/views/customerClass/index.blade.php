@extends('adminlte::page')

@section('title', 'Customer classes')

@section('content_header')
    <h1>Customer class management</h1>
@stop

@section('css')
    <link rel="stylesheet" type="text/css" href="../../css/custom.css">
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
                        <a type="button" class="btn btn-sm btn-success" href="{{ route('customer-class.create') }}"><i class="fas fa-plus"></i> Create</a>
                    </h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap table-head-fixed">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($customerClasses as $customerClass)
                            <tr>
                                <td>{{ $customerClass->id }}</td>
                                <td>{{ $customerClass->name }}</td>
                                <td><img src="{{ $customerClass->path ? Storage::url($customerClass->path) : 'https://via.placeholder.com/135x90?text=Image' }}" class="img-thumbnail img-lg image-custom"></td>
                                <td>
                                    <form action="{{ route('customer-class.destroy',$customerClass->id) }}" method="POST">
                                        <a type="button" class="btn btn-sm btn-warning" href="{{ route('customer-class.show', $customerClass->id) }}"><i class="fas fa-eye"></i></a>
                                        <a type="button" class="btn btn-sm btn-primary" href="{{ route('customer-class.edit', $customerClass->id) }}"><i class="fas fa-edit"></i></a>
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
            <div class="pagination float-right">
{{--                {{ $customerClasses->links() }}--}}
            </div>
        </div>
    </div>
@stop
