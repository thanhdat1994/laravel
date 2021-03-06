@extends('adminlte::page')

@section('title', 'Categories')

@section('content_header')
    <h1>Categories management</h1>
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
                    <div class="card-title float-right">
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#myModal">
                            <i class="fas fa-file-import"></i> Import
                        </button>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <form action="{{ route('category.import') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Import Category</h4>
                                    </div>
                                    <div class="modal-body">
                                        <input type="file" name="file" class="form-control">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">
                                            Close
                                        </button>
                                        <button type="submit" class="btn btn-sm btn-primary float-right">Import</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <h3 class="card-title float-right mr-2">
                        <a type="button" class="btn btn-sm btn-success" href="{{ route('category.create') }}"><i
                                class="fas fa-plus"></i> Create</a>
                    </h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap table-head-fixed">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <form action="{{ route('category.destroy',$category->id) }}" method="POST">
                                        <a type="button" class="btn btn-sm btn-warning"
                                           href="{{ route('category.show', $category->id) }}"><i class="fas fa-eye"></i></a>
                                        <a type="button" class="btn btn-sm btn-primary"
                                           href="{{ route('category.edit', $category->id) }}"><i
                                                class="fas fa-edit"></i></a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure?')"><i
                                                class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="pagination float-right">
                {{--                {{ $categories->links() }}--}}
            </div>
        </div>
    </div>
@stop
