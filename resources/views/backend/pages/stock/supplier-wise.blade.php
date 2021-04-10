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
                                <h3 class="card-title">{{ $title }} List</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">Supplier Wise Product</label> &nbsp;
                                    <input type="radio" name="supplier_product_wise" value="supplier_wise"
                                        class="form-check-input search_value">
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <label class="form-check-label">Product Wise Report</label>&nbsp;
                                    <input type="radio" name="supplier_product_wise" value="product_wise"
                                        class="form-check-input search_value">
                                </div>
                                <hr>
                                <div class="show_supplier" style="display: none">
                                    <form id="supplierForm" action="{{ route('report.supplier.wise') }}" method="GET">
                                        <div class="form-row">
                                            <div class="col-md-4">
                                                <label for="supplier_id">Supplier select</label>
                                                <select class="form-control select2 form-control-sm" id="supplier_id"
                                                    name="supplier_id">
                                                    <option>Select Supplier</option>
                                                    @foreach ($suppliers as $supplier)
                                                        <option value="{{ $supplier->id }}"> {{ $supplier->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <button type="submit" class="btn btn-primary btn-sm"
                                                    style="margin-top: 31px;">Search</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
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
        $(document).on('change', '.search_value', function() {
            var search_value = $(this).val();
            //console.log(search_value);
            if (search_value == 'supplier_wise') {
                $('.show_supplier').show();
            } else {
                $('.show_supplier').hide();
            }
        });

    </script>
@endpush
