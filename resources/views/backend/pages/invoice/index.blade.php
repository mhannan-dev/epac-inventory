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
                                <div class="float-right">
                                    <a href="{{ route('invoice.create') }}" class="btn btn-outline-info"><i
                                            class="fas fa-plus"></i> &nbsp;Add {{ $title }}</a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>@lang('form.th_sl')</th>
                                        <th>Customer Name</th>
                                        <th>Invoice No</th>
                                        <th>Date</th>
                                        <th>Description</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>@lang('form.th_action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($invoices))
                                            @foreach ($invoices as $key => $invoice)

                                                <tr>
                                                    <td>{{ ++$key }}</td>
                                                    <td>{{ $invoice['payment']['customer']['name']}} || {{ $invoice['payment']['customer']['mobile_no']}}</td>
                                                    <td>{!! $invoice->invoice_no !!}</td>
                                                    <td>{!! $invoice->date !!}</td>
                                                    <td>{!! $invoice->description !!}</td>
                                                    <td>{{ $invoice['payment']['total_amount']}}</td>
                                                    <td>
                                                        @if ($invoice->status == 1)
                                                            Approved
                                                        @else
                                                            Not Approved
                                                        @endif
                                                    </td>
                                                   
                                                    <td>
                                                        @if($invoice->status == 0)
                                                        
                                                        <a target="_blank" title="Approve" href="{{ route('invoice.approve', $invoice->id)}}" class="badge badge-success text-right">
                                                            <i class="fa fa-check-circle" aria-hidden="true"></i>
                                                        </a>

                                                        <a title="Delete" href="#deleteModal{{ $invoice->id }}" data-toggle="modal" class="badge badge-danger text-right">
                                                            <i class="fa fa-trash-alt" aria-hidden="true"></i>
                                                        </a>

                                                        @elseif ($invoice->status == 1)
                                                        <a  target="_blank" title="Approve" href="{{ route('invoice.web',$invoice->id) }}" class="badge badge-success text-right">
                                                            <i class="fa fa-print text-white" aria-hidden="true"></i>
                                                        </a>
                                                        @endif

                                                        

                                                       

                                                        <!-- Delete Modal -->
                                                        <div class="modal fade" id="deleteModal{{ $invoice->id }}"
                                                             tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                             aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Are
                                                                            sure to approve?</h5>
                                                                        <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="{!! route('invoice.delete', $invoice->id) !!}" method="post">
                                                                            @csrf

                                                                            <button type="submit" class="btn btn-danger">
                                                                                Permanent Delete
                                                                            </button>
                                                                        </form>

                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-success"
                                                                                data-dismiss="modal">Cancel
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Delete Modal -->
                                                   
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="6"> Opps!!, {{ $title }} Not found</td>
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
    <script src="{{ URL::asset('backend') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script>
        $(function() {
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
