@extends('adminlte::page')

@section('title', 'Orders')

@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h1>Create Order</h1>
        </div>
        {{--        <div class="col-sm-6">--}}
        {{--            <a type="button" class="btn btn-sm btn-success float-right" href="{{ route('order.index') }}"><i class="fas fa-backspace"></i> Back</a>--}}
        {{--        </div>--}}
    </div>
@stop

@section('css')
{{--    <link rel="stylesheet" type="text/css" href="../../css/bootstrap-datetimepicker.min.css">--}}
{{--    <link rel="stylesheet" type="text/css" href="../../css/bootstrap-datetimepicker.css">--}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="../../css/custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.css"/>
@stop

@section('content')
    <form action="{{ route('order.store') }}" method="POST"
          class="form-horizontal justify-content-center align-items-center">
        @csrf
        <div class="row">
            <div class="col-5">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Customer Information</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="inputPhoneCustomer" class="col-sm-2 col-form-label text-right">Phone</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="inputPhoneCustomer" placeholder="Phone">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputNameCustomer" class="col-sm-2 col-form-label text-right">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="inputNameCustomer" placeholder="Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputSexCustomer" class="col-sm-2 col-form-label text-right">Sex</label>
                            <div class="col-sm-10 row mt-2">
                                <div class="form-check mr-5 ml-2">
                                    <input class="form-check-input" type="radio" name="inputSexCustomer" value="0">
                                    <label class="form-check-label">Male</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="inputSexCustomer" value="1">
                                    <label class="form-check-label">Female</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputBirthdayCustomer"
                                   class="col-sm-2 col-form-label text-right">Birthday</label>
                            <div class="col-sm-10">
                                <div class="input-group date">
                                    <input type="text" id="datepicker" name="inputBirthdayCustomer"
                                           placeholder="dd/mm/yyyy" class="form-control datetimepicker-input"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputAddressCustomer" class="col-sm-2 col-form-label text-right">Address</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="inputAddressCustomer"
                                       placeholder="Address">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputCustomerClassCustomer" class="col-sm-2 col-form-label text-right">Customer Class</label>
                            <div class="col-sm-10">
                                <select name="inputCustomerClassCustomer" class="form-control" placeholder="Customer Class">
                                    @foreach ($customerClass as $key => $value)
                                        <option value={{ $key }}>{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputNoteCustomer" class="col-sm-2 col-form-label text-right">Note</label>
                            <div class="col-sm-10">
                                <textarea type="text" class="form-control" name="inputNoteCustomer"
                                          placeholder="Note"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-7">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Order Information</h3>

                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="inputDate" class="col-sm-2 col-form-label text-right">Date Order</label>
                            <div class="col-sm-10">
                                <div class="input-group date">
                                    <input type="text" id="dateOrder" name="inputDate" placeholder="dd/mm/yyyy"
                                           class="form-control datepicker-input"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputTime" class="col-sm-2 col-form-label text-right">Time Order</label>
                            <div class="col-sm-10">
                                <div class="input-group time">
                                    <input type="text" id="timeOrder" name="inputTime"
                                           class="form-control"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputProduct" class="col-sm-2 col-form-label text-right">Product</label>
                            <div class="col-sm-9">
                                <div class="input-group date">
                                    <select class="form-control product-select2">
                                        @foreach ($product as $key => $value)
                                            <option value={{ $key }}>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <button type="button" id="btn-add-product" onclick="addProduct()" class="btn btn-primary"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                        <div class="col-10 offset-md-2 form-group row pr-0 pl-0">
                            <table id="productDetail" class="table table-bordered table-hove">
                                <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Amount</th>
                                    <th>#</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4">Subtotal</td>
                                        <td colspan="2"><span class="sub-total" id="subtotal"></span></td>

                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="form-group row">
                            <label for="inputDiscount" class="col-sm-2 col-form-label text-right">Discount</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="discount" onchange="totalProduct()" name="inputDiscount" value="0"
                                       placeholder="Discount">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputTotal" class="col-sm-2 col-form-label text-right">Total</label>
                            <div class="col-sm-10">
                                <input type="text" readonly="true" class="form-control text-danger font-weight-bold" name="inputTotal"
                                       placeholder="Total" value="0">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputNote" class="col-sm-2 col-form-label text-right">Note</label>
                            <div class="col-sm-10">
                                <textarea type="text" class="form-control" name="inputNote"
                                          placeholder="Note"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <button type="button" class="btn btn-secondary" href="{{ route('customer.index') }}"><i
                        class="fas fa-backspace"></i> Back
                </button>
                <button type="submit" class="btn btn-success float-right"><i class="fas fa-plus-square"></i> Create
                </button>
            </div>
        </div>
    </form>
@stop
@section('js')
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.js"></script>
{{--    <script src="../../js/moment.js"></script>--}}
{{--    <script src="../../js/bootstrap-datetimepicker.js"></script>--}}
    <script src="../../js/custom.js"></script>
    <script type="text/javascript">

        $(document).ready(function() {
            $('.product-select2').select2();
        });

        $("input[name='inputPhoneCustomer']").focusout(function() {
            ajaxPhoneCustomer($("input[name='inputPhoneCustomer']").val());
        });

        function addProduct() {
            var price = {!! json_encode($price->toArray()) !!};
            var productName = {!! json_encode($product->toArray()) !!};
            var proId = $(".product-select2").val();
            var line =
                '<tr id="' + proId + '">' +
                '<td>' + '1' + '</td>' +
                '<td>' + productName[proId] + '</td>' +
                '<input type="hidden" name="product_id[]" value="' + proId + '">' +
                '<td align="right">' +
                '<input type="number" class="form-control" name="quantity[]" onchange="sumProduct()" id="quantity_' + proId + '" value="1" min="1"/>' +
                '</td>' +
                '<td align="right">' +
                '<input type="text" readonly="true" class="form-control" name="price[]" onchange="sumProduct()" id="price_' + proId + '" value="' + number_format(price[proId]) + '"/>' +
                '</td>' +
                '<td align="right" style="vertical-align: middle;">' +
                '<label name="amount[]" id="amount_' + proId + '" >' + number_format(price[proId]) +'</label>' +
                '</td>' +
                '<td><button type="button" class="btn btn-sm btn-danger" id="remove-product"><i class="fas fa-times"></i></button></td>' +
                '</tr>';

            if ($("#productDetail tr[id=" + proId + "]").length == 0) {
                $("#productDetail").append(line);
                subtotalProduct();
                totalProduct();
            }

            $("button#remove-product").click(function () {
                var $trParent = $(this).parent().closest('tr');
                $trParent.remove();
                subtotalProduct();
                totalProduct();
            });

            $("input[name='price[]']").keyup(function (e) {
                $(this).val(format($(this).val()));
            });
        }

        function ajaxPhoneCustomer(phone) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                dataType: "json",
                type: "POST",
                evalScripts: true,
                url: "{{ route('ajaxRequest.post') }}",
                data: { phone: phone },
                error: function(err) {
                    console.log(err);
                },
                success: function(data) {
                    var myData = data[0];
                    $("input[name='inputNameCustomer']").val(myData.name);
                    if (myData.sex == 0) {
                        $("input[name='inputSexCustomer']").filter('[value="0"]').prop("checked", true);
                    } else {
                        $("input[name='inputSexCustomer']").filter('[value="1"]').prop("checked", true);
                    }
                    $("input[name='inputBirthdayCustomer']").datepicker('setDate', format_date(myData.birthday));
                    $("input[name='inputAddressCustomer']").val(myData.address);
                    $("select[name='inputCustomerClassCustomer']").val(myData.customer_class_id).prop('selected',true);
                    $("textarea[name='inputNoteCustomer']").val(myData.note);
                }
            });
        }
    </script>
@stop
