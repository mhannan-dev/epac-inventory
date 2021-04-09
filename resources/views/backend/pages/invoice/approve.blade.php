@extends('backend.layouts.master')
@section('content')
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
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
                                <table id="example1" class="table table-bordered table-striped  table-sm"  width="100%">
                                    <tbody>
                                    <tr class="table-primary">
                                        <td>Customer Info</td>
                                        <td width="25%">Name: {{ $payment['customer']['name']}}</td>
                                        <td width="20%">Mobile No: {{ $payment['customer']['mobile_no']}}</td>
                                        <td width="40%">Address: {{ $payment['customer']['address']}}</td>
                                    </tr>
                                    <tr>

                                        <td colspan="4" width="85%" colspan="3">Description: {{ $invoice->description }}</td>
                                    </tr>
                                    </tbody>
                                </table>

                                <form action="{{ route('approval.store', $invoice->id) }}" method="POST">

                                   {{ csrf_field() }}
                                    <table width="100%" class="table table-bordered table-striped  table-sm border">
                                        <thead>
                                        <tr>
                                            <th>Sl</th>

                                            <th>Product name</th>
                                            <th>Current Stock</th>
                                            <th>Quantity</th>
                                            <th>Unit Price</th>
                                            <th>Total</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $total_sum = '0';
                                        @endphp
                                        @foreach($invoice['invoice_details'] as $key => $details)

                                            <tr class="table-primary">

                        <input type="hidden" name="product_id[]" value="{{ $details->product_id }}">
                        <input type="hidden" name="selling_qty[{{ $details->id }}]" value="{{ $details->selling_qty }}">

                                                <td>{{ $key+1 }}</td>

                                                <td>{{ $details['products']['name'] }}</td>
                                                <td>{{ $details['products']['quantity'] }}</td>
                                                <td>{{ $details->selling_qty }}</td>
                                                <td>{{ $details->unit_price }}</td>
                                                <td>{{ $details->selling_price }}</td>
                                            </tr>
                                            @php
                                                $total_sum += $details->selling_price;
                                            @endphp
                                        @endforeach
                                        <tr class="text-right">
                                            <td colspan="5">Sub Total</td>
                                            <td>{{ $total_sum }}</td>
                                        </tr>
                                        <tr class="text-right table-success">
                                            <td colspan="5" class="text-muted">Discount</td>
                                            <td>{{ $payment->discount_amount }}</td>
                                        </tr>

                                        <tr class="text-right" style="text-decoration: underline double;">
                                            <td colspan="5" class="te">Paid amount</td>
                                            <td>{{ $payment->paid_amount }}</td>
                                        </tr>

                                        <tr class="text-right table-warning">
                                            <td colspan="5">Due</td>
                                            <td>{{ $payment->due_amount }}</td>
                                        </tr>
                                        <tr class="text-right " style="text-decoration: underline double;">
                                            <td colspan="5"> <strong> Grand Total</strong> </td>
                                            <td>{{ $payment->total_amount }}</td>
                                        </tr>
                                        </tbody>

                                    </table>
                                    <button type="submit" class="text-white btn btn-info mt-2">Approve Invoice</button>

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
