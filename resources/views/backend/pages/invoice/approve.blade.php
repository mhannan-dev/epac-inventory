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

                                <a class="btn btn-warning text-white text-bold">Invoice no {{ $invoice->invoice_no }}</a>
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
                                <table id="example1" class="table table-bordered table-striped">

                                    <tbody>

                                        <tr>
                                            <td><strong>Customer Info</strong></td>
                                            <td><strong>Name:</strong> {{ $payment['customer']['name']}}</td>
                                            <td><strong>Mobile No: </strong>{{ $payment['customer']['email']}}</td>
                                            <td><strong>Address: </strong>{{ $payment['customer']['address']}}</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                        </tr>



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
