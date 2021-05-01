@extends('backend.layouts.master')
@push('styles')
@endpush
@section('content')
    <div class="content-wrapper" style="min-height: 1244.06px;">
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-md-center">
                    <div class="col-lg-12">
                        <div class="card card-info mt-4">
                            <div class="card-header">
                                <h3 class="card-title">{{ $title }}</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label>Date</label>
                                        <div class="input-group">
                                            <input class="form-control form-control-sm" name="date" id="date" value="<?php echo date('Y-m-d'); ?>"/>
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="cuntry">Select Supplier</label>
                                        <select class="form-control select2 form-control-sm" id="supplier_id"
                                            name="supplier_id">
                                            <option>Select supplier</option>
                                            @foreach ($suppliers as $key => $supplier)
                                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="product_id">Product name</label>
                                        <select class="form-control select2 form-control-sm" id="product_id"
                                            name="product_id">
                                            <option value="">Product name</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="unit_id">Unit Name</label>
                                        <select class="form-control select2 form-control-sm" id="unit_id" name="unit_id">
                                            <option value="">Unit name</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <a class="btn btn-info text-white addEventMore btn-sm"
                                            style="margin-top: 30px !important;">
                                            <i class="fas fa-plus-circle">&nbsp;</i> Add More</a>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <hr style="background-color: #123455;">
                                <h3 class="card-title mb-2 text-bold">Stored Product List</h3>
                                <form action="{{ route('admin.purchase.store') }}" method="post">
                                    @csrf
                                    <table id="example1" class="table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>@lang('form.th_title')</th>
                                                <th>Description</th>
                                                <th>Unit</th>
                                                <th width="10%">Buying Rate</th>
                                                <th width="10%">Selling Rate</th>
                                                <th width="10%">Quantity</th>
                                                <th width="15%">Total Price</th>
                                                <th width="3%" class="text-right">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="addRow" class="addRow">
                                        </tbody>
                                        <tbody>
                                            <tr>
                                                <td colspan="6" class="text-bold text-dark">Line Total</td>
                                                <td class="text-white text-bold text-center">
                                                    <input id="estimated_amount" type="text"
                                                        class="form-control form-control-sm text-right estimated_amount"
                                                        readonly>
                                                </td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <br>
                                    <div class="form-group">
                                        <button type="submit" id="storeButton" class="btn btn-info btn-sm text-white">
                                            Proceed
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
        </section>
    </div>
@endsection
@push('scripts')
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <script id="document-template" type="text/x-handlebars-template">
        <tr class="delete_add_more_item" id="delete_add_more_item">
                    <input type="hidden" name="date[]" value="@{{ date }}">
                    <input type="hidden" name="supplier_id[]" value="@{{ supplier_id }}">
                    <td>
                        <input type="hidden" name="product_id[]" value="@{{ product_id }}">@{{ product_name }}
                    </td>
                    <td>
                        <textarea type="text" class="form-control form-control-sm description" name="description[]">@{{ description }}</textarea>
                    </td>
                    <td>
                        <input type="hidden" name="unit_id[]" value="@{{ unit_id }}">@{{ unit_name }}
                    </td>
                    <td>
                        <input type="text" class="form-control form-control-sm unit_price" name="unit_price[]" value="1">
                    </td>
                    <td>
                        <input type="text" class="form-control form-control-sm unt_sell_price" name="unt_sell_price[]" value="1">
                    </td>
                    <td>
                        <input type="text" min="1" class="form-control form-control-sm buying_qty" name="buying_qty[]" value="1">
                    </td>
                    <td>
                        <input type="text" class="form-control form-control-sm text-right buying_price" value="1"
                               name="buying_price[]" readonly>
                    </td>
                    <td>
                        <i class="btn btn-danger btn-sm fa fa-window-close removeEventMore"></i>
                    </td>
                </tr>
            </script>
    <script type="text/javascript">
        $(document).on('click', ".addEventMore", function() {
            var date = $('#date').val();
            var supplier_id = $('#supplier_id').val();
            var supplier_name = $('#supplier_id').find('option:selected').text();
            var product_id = $('#product_id').val();
            var product_name = $('#product_id').find('option:selected').text();
            var unit_id = $('#unit_id').val();
            var unit_name = $('#unit_id').find('option:selected').text();
            var buying_qty = $('#buying_qty').val();
            var unit_price = $('#unit_price').val();
            var unt_sell_price = $('#unt_sell_price').val();
            var description = $('#description').val();
            var buying_price = $('#buying_price').val();
            if (date == '') {
                $.notify("Date is rquired", {
                    globalPosition: 'top-right',
                    className: 'error'
                });
                return false;
            }
            if (supplier_id == '') {
                $.notify("Supplier is required", {
                    globalPosition: 'top-right',
                    className: 'error'
                });
                return false;
            }
            if (product_id == '') {
                $.notify("Product is required", {
                    globalPosition: 'top-right',
                    className: 'error'
                });
                return false;
            }
            if (unit_id == '') {
                $.notify("Unit is required", {
                    globalPosition: 'top-right',
                    className: 'error'
                });
                return false;
            }
            if (buying_qty == '') {
                $.notify("Buying Quantity is required", {
                    globalPosition: 'top-right',
                    className: 'error'
                });
                return false;
            }
            if (unit_price == '') {
                $.notify("Unit price is required", {
                    globalPosition: 'top-right',
                    className: 'error'
                });
                return false;
            }
            if (unt_sell_price == '') {
                $.notify("Selling is required", {
                    globalPosition: 'top-right',
                    className: 'error'
                });
                return false;
            }
            if (buying_price == '') {
                $.notify("Buying price is required", {
                    globalPosition: 'top-right',
                    className: 'error'
                });
                return false;
            }
            var source = $("#document-template").html();
            var template = Handlebars.compile(source);
            var data = {
                date: date,
                supplier_id: supplier_id,
                supplier_name: supplier_name,
                product_id: product_id,
                product_name: product_name,
                buying_qty: buying_qty,
                unit_price: unit_price,
                unt_sell_price: unt_sell_price,
                unit_id: unit_id,
                unit_name: unit_name,
                buying_price: buying_price,
                description: description
            };
            var html = template(data);
            $("#addRow").append(html);
        });
        $(document).on('click', ".removeEventMore", function(event) {
            $(this).closest(".delete_add_more_item").remove();
            totalAmountPrice();
        });
        $(document).on('keyup click', '.unit_price,.buying_qty', function(event) {
            var unit_price = $(this).closest("tr").find("input.unit_price").val();
            var qty = $(this).closest("tr").find("input.buying_qty").val();
            var total = unit_price * qty;
            $(this).closest("tr").find("input.buying_price").val(total);
            totalAmountPrice();
        });
        //totalAmountPrice
        function totalAmountPrice() {
            var sum = 0;
            $(".buying_price").each(function() {
                var value = $(this).val();
                if (!isNaN(value) && value.length != 0) {
                    sum += parseFloat(value);
                }
            })
            $('#estimated_amount').val(sum);
        }
    </script>
    <script type="text/javascript">
        $(function() {
            //Loading product_id under supplier_id selection
            $(document).on('change', '#supplier_id', function() {
                $('#product_id').empty()
                $('#product_id').append(`<option value="">Select product</option>`)
                var supplier_id = $(this).val();
                $.ajax({
                    url: "{{ route('get-product') }}",
                    type: "GET",
                    data: {
                        supplier_id: supplier_id
                    },
                    success: function(data) {
                        var html = '<option value="">Select product</option>';
                        $.each(data, function(key, v) {
                            html += '<option value="' + v.id + '">' + v.name +
                                '</option>'
                        });
                        $('#product_id').html(html);
                    }
                });
            });
        });
        $(function() {
            //Loading product_id under supplier_id selection
            $(document).on('change', '#product_id', function() {
                var product_id = $(this).val();
                $.ajax({
                    url: "{{ route('get-unit') }}",
                    type: "GET",
                    data: {
                        product_id: product_id
                    },
                    success: function(data) {
                        var html = '<option value="">Select unit</option>';
                        $.each(data, function(key, v) {
                            html += '<option selected value="' + v.id + '">' + v.name + '</option>'
                        });
                        $('#unit_id').html(html);
                    }
                });
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#date').datepicker({
                uiLibrary: 'bootstrap4'
            });
        });
    </script>
@endpush
