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
                                <form action="" method="GET" target="_blank" id="myForm">
                                    <div class="form-row">
                                        <div class="form-group col-md-2">
                                            <label>Start Date</label>
                                            <input class="form-control form-control-sm" name="start_date" id="start_date" placeholder="YY-MM-DD"/>
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label>End Date</label>
                                            <input class="form-control form-control-sm" name="end_date" id="end_date" placeholder="YY-MM-DD"/>
                                        </div>
                                        <div class="form-group col-md-1" style="padding-top: 30px;">
                                            <button class="btn btn-outline-success float-right btn-sm">Search</button>
                                        </div>


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
            $('#start_date').datepicker({
                uiLibrary: 'bootstrap4'
            });

            $('#end_date').datepicker({
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
                        //console.log(data)
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

    <script type="text/javascript">
        $(document).ready(function () {

            $('#myForm').validate({
                rules: {
                    start_date: {
                        required: true,
                        start_date: true,
                    },
                    end_date: {
                        required: true,
                        end_date: true,
                    }
                },
                messages: {
                    start_date: {
                        required: "Please select start date",
                        start_date: "Please select start date"
                    },
                    end_date: {
                        required: "Please select end date",
                        start_date: "Please select end date"
                    }


                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
@endpush
