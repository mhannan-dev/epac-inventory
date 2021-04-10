@extends('backend.layouts.master')
@section('content')
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-12">
                    <div class="card mt-2">
                        <div class="card-header">
                            <h3 class="card-title">{{$title}} List</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">Supplier Wise Product</label> &nbsp;
                                <input class="form-check-input" type="radio" id="supplier_wise">
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <label class="form-check-label">Product Wise Report</label>&nbsp;
                                <input class="form-check-input" type="radio" id="product_wise">
                            </div>
                            <hr>
                            <form id="supplierForm" action="" method="GET">
                                <div class="form-row">
                                  <div class="col-md-4">
                                    <label for="supplier_id">Supplier select</label>
                                    <select class="form-control select2" id="supplier_id" name="supplier_id">
                                        <option>Select Supplier</option>
                                        @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}"> {{ $supplier->name }}</option>
                                        @endforeach
                                    </select>
                                  </div>
                                  <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary" style="margin-top: 31px;">Search</button>
                                  </div>
                                </div>
                              </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $("#supplierForm").submit(function (event) {
                loadAjax();
                event.preventDefault()
            });
            $('#supplierForm').validate({
                rules: {
                    supplier_id: {
                        required: true,
                        supplier_id: true,
                    },

                },
                messages: {
                    name: {
                        required: "Please enter a name",
                        supplier_id: "Please select supplier"
                    },

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
