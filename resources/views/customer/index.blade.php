@extends('adminlte::page')

@section('title', 'Customers')

@section('content_header')
    <h1>Customer management</h1>
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
                        <a type="button" class="btn btn-sm btn-success" href="{{ route('customer.create') }}"><i class="fas fa-plus"></i> Create</a>
                    </h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap table-head-fixed">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Sex</th>
                            <th>Birthday</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Note</th>
                            <th>Customer class</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($customers as $customer)
                            <tr>
                                <td>{{ $customer->id }}</td>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->sex == 0 ? 'Nam' : 'Nữ' }}</td>
                                <td>{{ date('d/m/Y', strtotime($customer->birthday)) }}</td>
                                <td>{{ $customer->address }}</td>
                                <td>{{ $customer->phone }}</td>
                                <td>{{ $customer->note }}</td>
                                <td>{{ $customer->customerClass->name }}</td>
                                <td>
                                    <form action="{{ route('customer.destroy',$customer->id) }}" method="POST">
                                        <a type="button" class="btn btn-sm btn-warning" href="{{ route('customer.show', $customer->id) }}"><i class="fas fa-eye"></i></a>
                                        <a type="button" class="btn btn-sm btn-primary" href="{{ route('customer.edit', $customer->id) }}"><i class="fas fa-edit"></i></a>
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
                {{ $customers->links() }}
            </div>
        </div>
    </div>
@stop
