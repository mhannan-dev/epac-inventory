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

                                <a class="btn btn-info text-white text-bold">Invoice no {{ $invoice->invoice_no }}
                                    ({{ date('d-m-y', strtotime($invoice->date)) }})</a>
                                <div class="float-right">
                                    <a href="{{ route('invoice.pending.list') }}" class="btn btn-outline-info"><i
                                            class="fas fa-arrow-left"></i> &nbsp;Back to Pending Invoice</a>
                                </div>

                            </div>

                            <!-- /.card-header -->
                            <div class="card-body">
                                @php
                                    $payment = App\Models\Payment::where('invoice_id', $invoice->id)->first();
                                @endphp
                                <table id="example1" class="table table-bordered table-striped" width="100%">

                                    <tbody>

                                    <tr>
                                        <td>Customer Info</td>
                                        <td width="25%">Name:{{ $payment['customer']['name']}}</td>
                                        <td width="20%">Mobile No: {{ $payment['customer']['mobile_no']}}</td>
                                        <td width="40%">Address:{{ $payment['customer']['address']}}</td>
                                    </tr>
                                    <tr>
                                        <td width="15%"></td>
                                        <td width="85%" colspan="3">Description: {{ $invoice->description }}</td>
                                    </tr>


                                    </tbody>

                                </table>
                                <table border="1" width="100%" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Category</th>
                                        <th>Product name</th>
                                        <th class="text-success bg-info">Current Stock</th>
                                        <th>Quantity</th>
                                        <th class="text-right">Unit Price</th>
                                        <th class="text-right">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($invoice['invoice_details'] as $key => $details)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $details['category']['name'] }}</td>
                                            <td>{{ $details['products']['name'] }}</td>
                                            <td class="text-center">{{ $details['products']['quantity'] }}</td>
                                            <td>{{ $details->selling_qty }}</td>
                                            <td class="text-right">{{ $details->unit_price }}</td>
                                            <td class="text-right">{{ $details->selling_price }}</td>
                                        </tr>
                                    @endforeach
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
    <link rel="stylesheet" href="{{ URL::asset('backend')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
          href="{{ URL::asset('backend')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
@endpush

@push('scripts')
    <script src="{{ URL::asset('backend')}}/plugins/datatables/jquery.dataTables.min.js"></script>
    <!-- DataTables -->
    <script src="{{ URL::asset('backend')}}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ URL::asset('backend')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ URL::asset('backend')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ URL::asset('backend')}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>

@endpush
