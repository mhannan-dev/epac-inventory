@extends('backend.layouts.master')
@push('styles')
    <link href="#" rel="stylesheet" type="text/css"/>
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
                                            <input class="form-control form-control-sm" name="date" id="date"
                                                   placeholder="MM-DD-YY"/>
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Purchase Memo No</label>

                                        <div class="input-group">
                                            <input type="text" class="form-control form-control-sm" name="purchase_no"
                                                   id="purchase_no"
                                                   placeholder="E.g.PURC_20201227"/>

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

                                        <label for="category_id">Select Category</label>
                                        <select class="form-control select2 form-control-sm" id="category_id"
                                                name="category_id">
                                            <option value="">Select Category</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="product_id">Product name</label>
                                        <select class="form-control select2 form-control-sm" id="product_id" name="product_id">
                                            <option value="">Product name</option>
                                        </select>
                                    </div>

{{--                                    <div class="form-group col-md-4">--}}
{{--                                        <label for="size_weight">Size/Wait/Others</label>--}}
{{--                                        <input name="size_weight" type="text" class="form-control-sm form-control" placeholder="Product size or weight">--}}
{{--                                    </div>--}}


                                    <div class="form-group col-md-4">
                                        <label for="product_id">Unit Name</label>
{{--                                        <select class="form-control select2 form-control-sm" id="unit_id" name="unit_id">--}}
{{--                                            <option value="">Unit name</option>--}}
{{--                                        </select>--}}
                                        <select class="form-control select2 form-control-sm" id="unit_id" name="unit_id">
                                        <option>Unit name</option>
                                        @foreach ($units as $key => $unit)
                                            <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                        @endforeach
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
                                <h3 class="card-title mb-2 text-bold">Purchase List</h3>
                                <form action="{{ route('admin.purchase.store') }}" method="post">
                                    @csrf
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>@lang('form.th_product_category')</th>
                                            <th>@lang('form.th_title')</th>
                                            <th>Description</th>
                                            {{-- <th>Weight/Size</th> --}}
                                            <th>Unit</th>
                                            <th width="10%">Buying Rate</th>
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
                                                <input id="estimated_amount" type="text" class="form-control form-control-sm text-right estimated_amount" readonly>

                                            </td>
                                            <td></td>


                                        </tr>
                                        </tbody>
                                    </table>
                                    <br>
                                    <div class="form-group">
                                        <button type="submit" id="storeButton" class="btn btn-info btn-sm text-white">
                                            Purchase Store
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

            <input type="hidden" name="purchase_no[]" value="@{{ purchase_no }}">

            <input type="hidden" name="supplier_id[]" value="@{{ supplier_id }}">
            <td>
                <input type="hidden" name="category_id[]" value="@{{ category_id }}">@{{ category_name }}
            </td>
            <td>
                <input type="hidden" name="product_id[]" value="@{{ product_id }}">@{{ product_name }}
            </td>
            <td>
                <textarea type="text" class="form-control form-control-sm description" name="description[]">@{{ description }}</textarea>
            </td>
            {{-- <td>
                <input type="text"  name="size_weight[]" value="@{{ size_weight }}" class="form-control form-control-sm size_weight">@{{ size_weight }}
            </td> --}}
            <td>
                <input type="hidden" name="unit_id[]" value="@{{ unit_id }}">@{{ unit_name }}
            </td>
            <td>
                <input type="number" class="form-control form-control-sm unit_price" name="unit_price[]" value="">
            </td>
            <td>
                <input type="number" min="1" class="form-control form-control-sm buying_qty" name="buying_qty[]">
            </td>
            <td>
                <input type="number" class="form-control form-control-sm text-right buying_price" value="1"
                       name="buying_price[]" readonly>
            </td>
            <td>
                <i class="btn btn-danger btn-sm fa fa-window-close removeEventMore"></i>
            </td>
        </tr>
    </script>
    <script type="text/javascript">
        $(document).on('click', ".addEventMore", function () {

            var date = $('#date').val();
            //var purchase_no = $('#purchase_no').val();
            //var brand_id = $('#brand_id').val();
            //var brand_name = $('#brand_id').find('option:selected').text();
            var supplier_id = $('#supplier_id').val();
            var supplier_name = $('#supplier_id').find('option:selected').text();
            var category_id = $('#category_id').val();
            var category_name = $('#category_id').find('option:selected').text();
            var sub_category_id = $('#sub_category_id').val();
            var sub_category_name = $('#sub_category_id').find('option:selected').text();
            var product_id = $('#product_id').val();
            var product_name = $('#product_id').find('option:selected').text();
            var unit_id = $('#unit_id').val();
            var unit_name = $('#unit_id').find('option:selected').text();
            var buying_qty = $('#buying_qty').val();
            var size_weight = $('#size_weight').val();
            var unit_price = $('#unit_price').val();
            var description = $('#description').val();
            var buying_price = $('#buying_price').val();

            if (date == '') {
                $.notify("Date is rquired", {globalPosition: 'top-right', className: 'error'});
                return false;
            }
            // if (purchase_no == '') {
            //     $.notify("Purchase is rquired", {globalPosition: 'top-right', className: 'error'});
            //     return false;
            // }
            // if (brand_id == '') {
            //     $.notify("Brand is rquired", {globalPosition: 'top-right', className: 'error'});
            //     return false;
            // }
            if (supplier_id == '') {
                $.notify("Supplier is required", {globalPosition: 'top-right', className: 'error'});
                return false;
            }
            if (category_id == '') {
                $.notify("Category is required", {globalPosition: 'top-right', className: 'error'});
                return false;
            }
            // if (sub_category_id == '') {
            //     $.notify("Sub category is required", {globalPosition: 'top-right', className: 'error'});
            //     return false;
            // }
            if (product_id == '') {
                $.notify("Product is required", {globalPosition: 'top-right', className: 'error'});
                return false;
            }
            if (unit_id == '') {
                $.notify("Unit is required", {globalPosition: 'top-right', className: 'error'});
                return false;
            }

            if (buying_qty == '') {
                $.notify("Buying Quantity is required", {globalPosition: 'top-right', className: 'error'});
                return false;
            }
            if (size_weight == '') {
                $.notify("Size/Wait is required", {globalPosition: 'top-right', className: 'error'});
                return false;
            }

            if (unit_price == '') {
                $.notify("Unit price is required", {globalPosition: 'top-right', className: 'error'});
                return false;
            }

            if (buying_price == '') {
                $.notify("Buying price is required", {globalPosition: 'top-right', className: 'error'});
                return false;
            }

            var source = $("#document-template").html();
            var template = Handlebars.compile(source);
            var data = {
                date: date,
                //purchase_no: purchase_no,
                //brand_id: brand_id,
                supplier_id: supplier_id,
                supplier_name: supplier_name,
                category_id: category_id,
                category_name: category_name,
                sub_category_id: sub_category_id,
                sub_category_name: sub_category_name,
                product_id: product_id,
                product_name: product_name,
                buying_qty: buying_qty,
                unit_price: unit_price,
                unit_id: unit_id,
                size_weight: size_weight,
                unit_name: unit_name,
                buying_price: buying_price,
                description: description
            };
            var html = template(data);
            $("#addRow").append(html);
        });
        $(document).on('click', ".removeEventMore", function (event) {
            $(this).closest(".delete_add_more_item").remove();
            totalAmountPrice();
        });

        $(document).on('keyup click', '.unit_price,.buying_qty', function (event) {
            var unit_price = $(this).closest("tr").find("input.unit_price").val();
            var qty = $(this).closest("tr").find("input.buying_qty").val();
            var total = unit_price * qty;
            $(this).closest("tr").find("input.buying_price").val(total);
            totalAmountPrice();

        });

        //totalAmountPrice
        function totalAmountPrice() {
            var sum = 0;
            $(".buying_price").each(function () {
                var value = $(this).val();
                if (!isNaN(value) && value.length != 0) {
                    sum += parseFloat(value);
                }
            })
            $('#estimated_amount').val(sum);
        }

    </script>

    <script type="text/javascript">
        $(function () {
            //Loading category_id under supplier_id selection
            $(document).on('change', '#supplier_id', function () {
                $('#sub_category_id').empty()
                $('#sub_category_id').append(`<option value="">Select subcategory</option>`)
                $('#category_id').empty()
                $('#category_id').append(`<option value="">Select category</option>`)

                var my_supplier_id = $(this).val();
                $.ajax({
                    url: "{{ route('get-category') }}",
                    type: "GET",
                    data: {supplier_id: my_supplier_id},
                    success: function (data) {
                        var html = '<option value="">Select category</option>';
                        $.each(data, function (key, v) {
                            html += '<option value="' + v.category_id + '">' + v.category.name + '</option>'
                        });
                        $('#category_id').html(html);
                    }
                });
            });

            //Loading product_name under category_id selection
            $(document).on('change', '#category_id', function () {
                var my_category_id = $(this).val();
                $.ajax({
                    url: "{{ route('get-products') }}",
                    type: "GET",
                    data: {category_id: my_category_id},
                    success: function (data) {
                        var html = '<option value="">Product name</option>';
                        $.each(data, function (key, v) {
                            html += '<option value="' + v.id + '">' + v.name + '</option>'
                        });
                        $('#product_id').html(html);
                    }
                });
            });

            //Loading product_name under category_id selection
            {{--$(document).on('change', '#product_id', function () {--}}
            {{--    var my_product_id = $(this).val();--}}
            {{--    $.ajax({--}}
            {{--        url: "{{ route('get-unit') }}",--}}
            {{--        type: "GET",--}}
            {{--        data: {product_id: my_product_id},--}}
            {{--        success: function (data) {--}}
            {{--            var html = '<option value="">Unit name</option>';--}}
            {{--            $.each(data, function (key, v) {--}}
            {{--                //console.log(v.name)--}}
            {{--                html += '<option value="' + v.id + '">' + v.name + '</option>'--}}
            {{--            });--}}
            {{--            $('#unit_id').html(html);--}}
            {{--        }--}}
            {{--    });--}}
            {{--});--}}

        });

    </script>


    <script type="text/javascript">

        $(document).ready(function () {
            $('#date').datepicker({
                uiLibrary: 'bootstrap4'
            });

        });
    </script>


@endpush
