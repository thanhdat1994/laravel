@extends('adminlte::page')

@section('title', 'Expenses')

@section('content_header')
    <h1>Expense management</h1>
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
                        <a type="button" class="btn btn-sm btn-success" href="{{ route('expense.create') }}"><i class="fas fa-plus"></i> Create</a>
                    </h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap table-head-fixed">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Type</th>
                            <th>Note</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($expenses as $expense)
                            <tr>
                                <td>{{ $expense->id }}</td>
                                <td>{{ date('d/m/Y', strtotime($expense->date)) }}</td>
                                <td>{{ number_format($expense->amount) }} VNĐ</td>
                                <td>
                                    @if ($expense->type == 0)
                                        <span class="badge badge-success">Cố định</span>
                                    @elseif ($expense->type == 1)
                                        <span class="badge badge-primary">Phát sinh</span>
                                    @elseif ($expense->type == 2)
                                        <span class="badge badge-warning">Quảng cáo</span>
                                    @elseif ($expense->type == 3)
                                        <span class="badge badge-danger">Lương</span>
                                    @endif
                                </td>
                                <td>{{ $expense->note }}</td>
                                <td>
                                    <form action="{{ route('expense.destroy',$expense->id) }}" method="POST">
                                        <a type="button" class="btn btn-sm btn-warning" href="{{ route('expense.show', $expense->id) }}"><i class="fas fa-eye"></i></a>
                                        <a type="button" class="btn btn-sm btn-primary" href="{{ route('expense.edit', $expense->id) }}"><i class="fas fa-edit"></i></a>
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
                {{ $expenses->links() }}
            </div>
        </div>
    </div>
@stop
