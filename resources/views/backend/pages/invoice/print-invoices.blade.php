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
                                <div class="float-right">
                                    <a href="{{ route('invoice.create') }}" class="btn btn-outline-info"><i
                                            class="fas fa-plus"></i> &nbsp;Add Invoice</a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>@lang('form.th_sl')</th>
                                        <th>Customer name</th>
                                        <th>Invoice No</th>
                                        <th>Date</th>
                                        <th>Description</th>
                                        <th class="text-right">Amount</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($invoices as $key => $invoice)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>
                                                {{ $invoice['payment']['customer']['name']}} || {{ $invoice['payment']['customer']['mobile_no']}}
                                            </td>
                                            <td class="text-fuchsia text-bold">Invoice no {{ $invoice->invoice_no }}</td>
                                            <td>{{ $invoice->date }}</td>
                                            <td>{{ $invoice->description }}</td>
                                            <td class="text-right">{{ $invoice['payment']['total_amount']}}</td>
                                            <td class="text-right">
                                                <a target="_blank" href="{{ route('invoice.web',$invoice->id) }}"  title="View" class="btn btn-warning btn-sm">
                                                    <i class="fa fa-print text-white"></i>
                                                </a>
                                                {{-- <a href="{{ route('invoice.print',$invoice->id) }}"  title="Print" class="btn btn-dark btn-sm">
                                                    <i class="fa fa-print text-white"></i>
                                                </a> --}}
                                            </td>
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
