@extends('backend.layouts.master')
@push('styles')
<link rel="stylesheet" href="">
@endpush

@section('content')
    <div class="content-wrapper" style="min-height: 1244.06px;">
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-md-center">

                    <div class="col-lg-12">
                        <div class="card card-info mt-2">
                            <div class="card-header">
                                <h3 class="card-title">{{ $title }}</h3>
                            </div>

                            <div class="card-body">

                                <div class="form-row">

                                    <div class="form-group col-md-2">
                                        <label>Date</label>

                                        <div class="input-group">
                                            <input class="form-control form-control-sm" name="date" id="date"
                                                  placeholder="YY-MM-DD"/>
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Invoice No</label>

                                        <div class="input-group">
                                            <input class="form-control form-control-sm" name="invoice_no" id="invoice_no"
                                                   value= {{ $invoice_no }} readonly style="background-color: #d4edda"/>

                                        </div>
                                        <!-- /.input group -->
                                    </div>


                                    <div class="form-group col-md-2">

                                        <label for="category_id">Select Category</label>

                                        <select class="form-control form-control-sm select2" id="category_id" name="category_id">
                                            <option>Select category</option>
                                            @foreach($categories as $data_row)
                                                <option value="{{ $data_row->id}}">{{ $data_row->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>


                                    <div class="form-group col-md-3">
                                        <label for="cuntry">Product name</label>
                                        <select class="form-control select2 form-control-sm" id="product_id" name="product_id">
                                            <option>Product name</option>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="cuntry">Unit</label>
                                        <select class=" select2 form-control form-control-sm" id="unit_id" name="unit_id">
                                            <option>Select Unit</option>
                                            @foreach($units as $unit)
                                                <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                            @endforeach

                                        </select>

                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="cuntry">Stock</label>
                                        <input class="form-control form-control-sm" id="curent_stock_qty" name="curent_stock_qty" style="background-color: #d4edda" readonly>

                                    </div>

                                    <div class="form-group">
                                        <a class="btn btn-info text-white addEventMore btn-sm" style="margin-top: 30px !important;">
                                            <i class="fas fa-plus-circle">&nbsp;</i> Add More</a>

                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <hr style="background-color: #123455;">
                                <h3 class="card-title mb-2 text-bold">Invoice List</h3>
                                <form action="{{ route('invoice.store') }}" method="post">
                                    @csrf
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>@lang('form.th_product_category')</th>

                                            <th>Product name</th>
                                            <th width="10%">KG/PCS</th>
                                            <th width="10%">Rate</th>
                                            <th>Unit</th>
                                            <th width="15%">Total</th>
                                            <th width="3%" class="text-right">Action</th>

                                        </tr>
                                        </thead>

                                        <tbody id="addRow" class="addRow">

                                        </tbody>

                                        <tbody>

                                        <tr>
                                            <td colspan="5" class="text-right text-bold text-dark">Discount Amount</td>

                                            <td  class="text-white text-bold">
                                                <input name="discount_amount" id="discount_amount" type="text" class="text-right form-control form-control-sm" style="background-color: #d4edda" value="{{ old('discount_amount') }}">
                                            </td>
                                            <td></td>

                                        </tr>


                                        <tr>
                                            <td colspan="5" class="text-right text-bold text-dark">Line Total</td>
                                            <td  class="text-white text-bold ">
                                                <input name="estimated_amount" id="estimated_amount" type="text" class="text-right form-control form-control-sm estimated_amount" style="background-color: #d4edda" readonly value="{{old('estimated_amount')}}">
                                            </td>
                                            <td></td>

                                        </tr>
                                        </tbody>
                                    </table>

                                        <div class="form-group">
                                            <textarea class="form-control" name="description" id="" cols="155" rows="3"></textarea>
                                        </div>


                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="paid_status">Payment status</label>
                                            <select name="paid_status" id="paid_status" class="form-control form-control-sm">
                                                <option value="full_paid">Full paid</option>
                                                <option value="full_due">Full due</option>
                                                <option value="partial_paid">Partial payment</option>
                                            </select>
                                            <input type="text" class="form-control form-control-sm paid_amount mt-2" id="paid_amount" name="paid_amount" placeholder="Enter paid amount" style="display: none" value="{{old('paid_amount')}}">
                                        </div>
                                        <div class="form-group col-md-8">
                                            <label for="customer_id">Customer name</label>
                                            <select name="customer_id" id="customer_id" class="form-control form-control-sm select2">
                                                <option value="">Selecr customer name </option>
                                                @foreach($customers as $customer_row)
                                                    <option value="{{ $customer_row->id }}">
                                                        {{ $customer_row->name }} || {{ $customer_row->mobile_no }} || {{ $customer_row->address }}</option>
                                                @endforeach
                                                <option value="0">New customer </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row new_customer" style="display:none">
                                        <div class="form-group col-md-4">
                                                <label>Customer name</label>
                                                <input type="text" id="name" name="name" class="form-control form-control-sm" placeholder="Enter customer name">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Mobile</label>
                                            <input type="text" id="mobile_no" name="mobile_no" class="form-control form-control-sm" placeholder="Enter customer mobile">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Address</label>
                                            <input type="text" id="address" name="address" class="form-control form-control-sm" placeholder="Enter customer address">
                                        </div>
                                    </div>

                                    <br>
                                    <div class="form-group">
                                        <button type="submit" id="storeButton"  class="btn btn-info btn-sm text-white">Invoice Store</button>
                                        <a href="{{ route('invoice_design')}} " class="btn btn-success btn-sm text-white">Invoice Design Sample</a>


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

    <!-- Category Modal-->
    <div class="modal fade" id="addCatgModal" tabindex="-1" role="dialog" aria-labelledby="addCatgModal"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Product Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open([ 'route' => ['admin.category.store'], 'id' => 'prdForm','method' => 'post']) !!}
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">@lang('form.name')<span class="text-danger">*</span></label>
                            {!! Form::text('name', null, [ 'class' => 'form-control', 'data-validation-required-message' => 'This field is required', 'placeholder' => 'Enter category name']) !!}
                            {!! $errors->first('name', '<label class="help-block text-danger">:message</label>') !!}
                        </div>

                        <div class="form-group">
                            <label for="code">@lang('form.code')<span class="text-danger">*</span></label>
                            {!! Form::text('code', null, [ 'class' => 'form-control', 'data-validation-required-message' => 'This field is required', 'placeholder' => 'Enter category code']) !!}
                            {!! $errors->first('code', '<label class="help-block text-danger">:message</label>') !!}
                        </div>
                        <div class="form-group">
                            <label for="status">@lang('form.status')</label>
                            <select class="form-control" id="status" name="status">
                                <option value="active">Select status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>

                            </select>
                        </div>

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Submit</button>
                        <a href="{{ route('admin.category.view') }}" class="btn btn-danger"><i class="fas fa-undo"></i></a>
                    </div>
                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </div>

    <!-- Supplier Modal-->
    <div class="modal fade" id="addSupplierModal" tabindex="-1" role="dialog" aria-labelledby="addSupplierModal"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Product Supplier</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open([ 'route' => ['admin.supplier.store'], 'id' => 'prdForm','method' => 'post']) !!}
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">@lang('form.name')<span class="text-danger">*</span></label>
                            <input class="form-control" name="name" placeholder="Enter supplier name"/>
                            {!! $errors->first('name', '<label class="help-block text-danger">:message</label>') !!}
                        </div>

                        <div class="form-group">
                            <label for="email">@lang('form.email')<span class="text-danger">*</span></label>
                            <input class="form-control" name="email" placeholder="Enter supplier email"/>
                            {!! $errors->first('email', '<label class="help-block text-danger">:message</label>') !!}
                        </div>
                        <div class="form-group">
                            <label for="mobile_no">@lang('form.mobile_no')<span
                                    class="text-danger">*</span></label>

                            <input class="form-control" name="mobile_no"
                                   placeholder="Enter supplier mobile no"/>
                            {!! $errors->first('mobile_no', '<label class="help-block text-danger">:message</label>') !!}
                        </div>
                        <div class="form-group">
                            <label for="address">@lang('form.address')<span class="text-danger">*</span></label>
                            <input class="form-control" name="address" placeholder="Enter supplier address"/>
                            {!! $errors->first('address', '<label class="help-block text-danger">:message</label>') !!}
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option>Select status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>

                            </select>
                        </div>

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">@lang('form.btn_save')</button>
                        <a href="{{ route('admin.suppliers.view') }}" class="btn btn-danger"><i class="fas fa-undo"></i></a>
                    </div>
                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="addUnitModal" tabindex="-1" role="dialog" aria-labelledby="addUnitModal"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Product Unit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open([ 'route' => ['admin.units.store'], 'id' => 'customerForm','method' => 'post']) !!}
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">@lang('form.name')<span class="text-danger">*</span></label>
                            {!! Form::text('name', null, [ 'class' => 'form-control', 'data-validation-required-message' => 'This field is required', 'placeholder' => 'Enter category name']) !!}
                            {!! $errors->first('name', '<label class="help-block text-danger">:message</label>') !!}
                        </div>



                        <div class="form-group">
                            <label for="status">@lang('form.status')</label>
                            <select class="form-control" id="status" name="status">
                                <option value="active">Select status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>

                            </select>
                        </div>

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Submit</button>
                        <a href="{{ route('admin.units.view') }}" class="btn btn-danger"><i class="fas fa-undo"></i></a>
                    </div>
                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </div>


@endsection
@push('scripts')
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>

      <script id="document-template" type="text/x-handlebars-template">

        <tr class="delete_add_more_item" id="delete_add_more_item">

            <input type="hidden" name="date" value="@{{ date }}">

            <input type="hidden" name="invoice_no" value="@{{ invoice_no }}">


            <td>
                <input type="hidden" name="category_id[]" value="@{{ category_id }}">@{{ category_name }}
            </td>


            <td>
                <input type="hidden" name="product_id[]" value="@{{ product_id }}">@{{ product_name }}
            </td>
            <td>
                <input type="number" min="1" class="form-control form-control-sm selling_qty" name="selling_qty[]" value="1">
            </td>
            <td>
                <input type="number" class="form-control form-control-sm unit_price" name="unit_price[]" value="">
            </td>
            <td>
                <input type="hidden" class="form-control form-control-sm unit_id" name="unit_id[]" value="@{{ unit_id }}">@{{ unit_name }}
            </td>

            <td>
                <input type="text" class="form-control form-control-sm text-right selling_price" value="1" name="selling_price[]" readonly value="{{ old('selling_price') }}">
            </td>
            <td>
                <i class="btn btn-danger btn-sm fa fa-window-close removeEventMore"></i>

            </td>



        </tr>


    </script>
    <script type="text/javascript">
        $(document).on('click', ".addEventMore", function () {

            var date = $('#date').val();
            var invoice_no = $('#invoice_no').val();
            var category_id           = $('#category_id').val();
            var category_name         = $('#category_id').find('option:selected').text();
            var product_id            = $('#product_id').val();
            var product_name          = $('#product_id').find('option:selected').text();
            var unit_id               = $('#unit_id').val();
            var unit_name             = $('#unit_id').find('option:selected').text();
            var selling_qty            = $('#selling_qty').val();
            var unit_price            = $('#unit_price').val();
            var selling_price          = $('#selling_price').val();

            if (date == '') {
                $.notify("Date is rquired", {globalPosition: 'top-right', className: 'error'});
                return false;
            }



            if (category_id == '') {
                $.notify("Category is rquired", {globalPosition: 'top-right', className: 'error'});
                return false;
            }

            if (product_id == '') {
                $.notify("Product is rquired", {globalPosition: 'top-right', className: 'error'});
                return false;
            }
            if (unit_id == '') {
                $.notify("Unit is rquired", {globalPosition: 'top-right', className: 'error'});
                return false;
            }

            if (selling_qty == '') {
                $.notify("Buying Quantity is rquired", {globalPosition: 'top-right', className: 'error'});
                return false;
            }
            if (unit_price == '') {
                $.notify("Unit price is rquired", {globalPosition: 'top-right', className: 'error'});
                return false;
            }

            if (selling_price == '') {
                $.notify("Puying price is rquired", {globalPosition: 'top-right', className: 'error'});
                return false;
            }

            var source = $("#document-template").html();
            var template = Handlebars.compile(source);
            var data = {
                date: date,
                invoice_no: invoice_no,
                category_id: category_id,
                category_name: category_name,
                product_id: product_id,
                product_name: product_name,
                selling_qty: selling_qty,
                unit_price: unit_price,
                unit_id: unit_id,
                unit_name: unit_name,
                selling_price: selling_price

            };
            var html = template(data);
            $("#addRow").append(html);
        });
        $(document).on('click',".removeEventMore", function (event) {
            $(this).closest(".delete_add_more_item").remove();
            totalAmountPrice();
        });

        $(document).on('keyup click', '.unit_price,.selling_qty', function (event) {
            var unit_price  = $(this).closest("tr").find("input.unit_price").val();
            var qty         = $(this).closest("tr").find("input.selling_qty").val();
            var total = unit_price * qty;
            $(this).closest("tr").find("input.selling_price").val(total);
            //totalAmountPrice();
            $('#discount_amount').trigger('keyup');

        });

        //discount_amount
        $(document).on('keyup','#discount_amount', function (){
            totalAmountPrice();
        })
        //totalAmountPrice calculation
        function totalAmountPrice(){
            var sum=0;
            $(".selling_price").each(function (){
                var value = $(this).val();
                if(!isNaN(value) && value.length != 0){
                    sum += parseFloat(value);
                }
            })

            //discount_amount calculation that will be minus form total amount (if any)
            var discount_amount = parseFloat($('#discount_amount').val());
                if(!isNaN(discount_amount) && discount_amount.length != 0){
                    sum -= parseFloat(discount_amount);

            }
            //estimated_amount after applying discount
            $('#estimated_amount').val(sum);
        }

    </script>


    <script type="text/javascript">

        $(document).ready(function () {
            $('#date').datepicker({
                uiLibrary: 'bootstrap4'
            });
        });

        $(function () {

            //Loading product under subcategory selection
            $(document).on('change', '#category_id', function () {
                var my_category_id = $(this).val();
                $.ajax({
                    url: "{{ route('get-products') }}",
                    type: "GET",
                    data: {category_id: my_category_id},
                    success: function (data) {
                        var html = '<option value="">Select product</option>';

                        $.each(data, function (key, v) {
                            html += '<option value="' + v.id + '">' + v.name + '</option>'
                        });
                        $('#product_id').html(html);
                    }
                });
            });
            //Loading product stock under product_id selection
            $(document).on('change', '#product_id', function () {
                var my_product_id = $(this).val();
                $.ajax({
                    url: "{{ route('check-product-stock') }}",
                    type: "GET",
                    data: { product_id: my_product_id },
                    success: function (data) {
                        $('#curent_stock_qty').val(data);

                    }
                });
            });

        });

    </script>

    <script type="text/javascript">
        $(document).on('change','#paid_status', function(){
            // Paid status
            var paid_status = $(this).val();
            if( paid_status == 'partial_paid'){
                $('.paid_amount').show()
            } else{
                $('.paid_amount').hide()
            }
        })
        $(document).on('change','#customer_id', function(){
            // New customer
            var customer_id = $(this).val();
            if( customer_id == '0'){
                $('.new_customer').show()
            } else{
                $('.new_customer').hide()
            }
        })


    </script>
@endpush
