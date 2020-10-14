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
                            <input type="text" name="searchText" id="searchText" class="form-control float-right"
                                   placeholder="Search...">
                            @csrf
                            <div class="input-group-append">
                                <button type="button" class="btn btn-default" id="searchButton"><i
                                        class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="card-title float-right">
                        <a type="button" class="btn btn-sm btn-warning" href="{{ route('export') }}"><i
                                class="fas fa-file-export"></i> Export</a>
                    </div>
                    <h3 class="card-title float-right mr-2">
                        <a type="button" class="btn btn-sm btn-success" href="{{ route('customer.create') }}"><i
                                class="fas fa-plus"></i> Create</a>
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
                                        <a type="button" class="btn btn-sm btn-warning"
                                           href="{{ route('customer.show', $customer->id) }}"><i class="fas fa-eye"></i></a>
                                        <a type="button" class="btn btn-sm btn-primary"
                                           href="{{ route('customer.edit', $customer->id) }}"><i
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
                {{ $customers->links() }}
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        function load_data(search_query = '') {
            var _token = $("input[name=_token]").val();
            $.ajax({
                url: "{{ route('customer.search') }}",
                method: "POST",
                data: {search_query: search_query, _token: _token},
                dataType: "json",
                success: function (data) {
                    var output = '';
                    if (data.length > 0) {
                        for (var i = 0; i < data.length; i++) {
                            var customer_class = data[i].customer_class_id;
                            output += '<tr>';
                            output += '<td>' + data[i].id + '</td>';
                            output += '<td>' + data[i].name + '</td>';
                            output += '<td>' + (data[i].sex == 0 ? "Nam" : "Nữ") + '</td>';
                            output += '<td>' + format_date(data[i].birthday) + '</td>';
                            output += '<td>' + data[i].address + '</td>';
                            output += '<td>' + data[i].phone + '</td>';
                            output += '<td>' + data[i].note + '</td>';
                            output += '<td>' + data[i].customer_class_id + '</td>';
                            output += '<td>' + '<form action=""' + ' method="POST">'
                                + '<a type="button" class="btn btn-sm btn-warning mr-1" href="#"><i class="fas fa-eye"></i></a>'
                                + '<a type="button" class="btn btn-sm btn-primary mr-1" href="#"><i class="fas fa-edit"></i></a>'
                                + '<button type="submit" class="btn btn-sm btn-danger mr-1" href="#"><i class="fas fa-trash-alt"></i></button>'
                                + '</td>';
                            output += '</tr>';
                        }
                    } else {
                        output += '<tr>';
                        output += '<td colspan="6">No Data Found</td>';
                        output += '</tr>';
                    }
                    $('tbody').html(output);
                }
            });
        }

        $('#searchButton').click(function () {
            var search_query = $('#searchText').val();
            load_data(search_query);
        });

        function format_date(date) {
            var d = new Date(date),
                month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear();

            if (month.length < 2) month = '0' + month;
            if (day.length < 2) day = '0' + day;

            return [day, month, year].join('/');
        }
    </script>
@stop
