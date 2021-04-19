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

                                <hr>
                                {{-- <div class="show_supplier" style="display: none"> --}}
                                <div class="show_supplier">
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

                                <div class="show_product" style="display: none">
                                    <form id="productForm" action="" method="GET">
                                        <div class="form-row">
                                            <div class="col-md-4">
                                                <label for="product_id">Product select</label>
                                                <select class="form-control select2 form-control-sm" id="product_id"
                                                    name="product_id">
                                                    <option>Select product</option>
                                                    @foreach ($products as $product)
                                                        <option value="{{ $product->id }}"> {{ $product->name }}
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
        $(document).on('change', '.search_value', function() {
            var search_value = $(this).val();
            //console.log(search_value);
            if (search_value == 'product_wise') {
                $('.show_product').show();
            } else {
                $('.show_product').hide();
            }
        });

    </script>
@endpush
