@extends('adminlte::page')

@section('title', 'Inventory')

@section('content_header')
    <h1>Products Inventory management</h1>
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
                        <a type="button" class="btn btn-sm btn-success" href="{{ route('inventory.create') }}"><i class="fas fa-plus"></i> Create</a>
                    </h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap table-head-fixed">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Product</th>
                            <th>DateTime</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Note</th>
                            <th>Category</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($inventories as $inventory)
                            <tr>
                                <td>{{ $inventory->id }}</td>
                                <td>{{ $inventory->products->name }}</td>
                                <td>{{ date('d/m/Y', strtotime($inventory->date)) }}</td>
                                <td>{{ $inventory->quantity }}</td>
                                <td>{{ number_format($inventory->price) }} VNĐ</td>
                                <td>{{ $inventory->note }}</td>
                                <td>{{ $inventory->products->category->name }}</td>
                                <td>
                                    <form action="{{ route('inventory.destroy',$inventory->id) }}" method="POST">
                                        <a type="button" class="btn btn-sm btn-primary" href="{{ route('inventory.edit', $inventory->id) }}"><i class="fas fa-edit"></i></a>
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" class="form-control" name="inputOldQuantity" value="{{ number_format($inventory->quantity) }}">
                                        <input type="hidden" class="form-control" name="inputProductId" value="{{ $inventory->product_id }}">
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
                {{ $inventories->links() }}
            </div>
        </div>
    </div>
@stop
