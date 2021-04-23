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
                                <form id="supplierForm" action="{{ route('report.supplier.wise') }}" method="GET" target="_blank">
                                    <div class="form-row">
                                        <div class="col-md-4">
                                            <label for="supplier_id">Supplier select</label>
                                            
                                            <select class="form-control select2 form-control-sm" id="supplier_id"
                                                name="supplier_id">
                                            <option value="0" disabled>Select Supplier</option>
                                                @foreach ($suppliers as $supplier)
                                                    <option value="{{ $supplier->id }}">
                                                        {{ $supplier->name }}
                                            </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="submit" class="btn btn-primary btn-sm"
                                                style="margin-top: 31px;">Generate</button>
                                                
                                        </div>
                                        
                                    </div>
                                </form>
                            </div>
                            <div class="card-header">
                                
                                <h3 class="card-title">{{ $title }} List</h3>
                                <div class="float-right">
                                    
                                    <a target="_blank" href="{{ route('stock.report.pdf') }}" class="btn btn-success"><i
                                            class="fas fa-save"></i> &nbsp;Print</a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>@lang('form.th_sl')</th>
                                            <th width="15%">@lang('form.th_supplier')</th>
                                            <th width="10%">Product Name</th>
                                            <th>In Qty</th>
                                            <th>In Stock</th>
                                            <th>Sell Qty</th>
                                            <th>@lang('form.th_units')</th>
                                            <th>Buying Price</th>
                                            <th>Avg. Unit Price</th>
                                            <th>Avg. Unit Sell Price</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($products))

                                            @foreach ($products as $key => $list)

                                                @php
                                                    $buying_total = App\Models\Purchase::where('supplier_id', $list->supplier_id)
                                                        ->where('product_id', $list->id)
                                                        ->where('status', '1')
                                                        ->sum('buying_qty');
                                                    
                                                    $buying_price = App\Models\Purchase::where('supplier_id', $list->supplier_id)
                                                        ->where('product_id', $list->id)
                                                        ->where('status', '1')
                                                        ->sum('buying_price');
                                                    $unit_price = App\Models\Purchase::where('supplier_id', $list->supplier_id)
                                                        ->where('product_id', $list->id)
                                                        ->where('status', '1')
                                                        ->avg('unit_price');
                                                    $avg_unt_sell_price = App\Models\Purchase::where('supplier_id', $list->supplier_id)
                                                        ->where('product_id', $list->id)
                                                        ->where('status', '1')
                                                        ->avg('unt_sell_price');
                                                    
                                                @endphp

                                                <tr>
                                                    <td>{{ ++$key }}</td>
                                                    <td class="text-success">{{ $list['supplier']['name'] }}</td>
                                                    <td>{{ Str::limit($list->name, 20) }}</td>
                                                    <td>
                                                        @if ($buying_total > 0)
                                                            {{ $buying_total }}
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    
                                                    <td>

                                                        @if ($list->quantity > 0)
                                                            {{ $list->quantity }}
                                                        @else
                                                            -
                                                        @endif


                                                    </td>
                                                    <td>
                                                        {{ $buying_total - $list->quantity }}
                                                    </td>
                                                    <td>
                                                       
                                                        {{ $list->units->name }}
                                                    
                                                    </td>
                                                    <td>
                                                        @if ($buying_price > 0)
                                                            {{ $buying_price }}
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($unit_price > 0)
                                                            {{ $unit_price }}
                                                        @else
                                                            -
                                                        @endif

                                                    </td>
                                                    <td>
                                                        @if ($avg_unt_sell_price > 0)
                                                            {{ $avg_unt_sell_price }}
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="5"> Opps!!, {{ $title }} Not found</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
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
@push('styles')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ URL::asset('backend') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
        href="{{ URL::asset('backend') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
@endpush
@push('scripts')
    <script src="{{ URL::asset('backend') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <!-- DataTables -->
    <script src="{{ URL::asset('backend') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ URL::asset('backend') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ URL::asset('backend') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });

    </script>
@endpush
