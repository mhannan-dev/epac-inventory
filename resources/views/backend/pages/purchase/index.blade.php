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
                                <h3 class="card-title"><strong>Inventory List</strong> (Stored Products)</h3>
                                <div class="float-right">
                                    <a href="{{ route('admin.purchase.create') }}" class="btn btn-outline-info">
                                        <i class="fas fa-plus"></i> &nbsp; New Inventory</a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th width="4%">@lang('form.th_sl')</th>
                                        {{-- <th width="12%">PO No.</th> --}}
                                        <th>Date</th>
                                        <th>Product</th>
                                        <th>@lang('form.th_supplier')</th>
                                        <th>Total</th>
                                        <th>Buy Prc.</th>
                                        <th>Sell Prc.</th>
                                        <th>Qty.</th>
                                        <th>Unit</th>
                                        <th>@lang('form.th_status')</th>
                                        <th>@lang('form.th_action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($products))
                                        @foreach ($products as $key => $purchase)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                
                                                <td>{{ $purchase->date }}</td>
                                                <td>{{ $purchase['products']['name'] }}</td>
                                                <td>{{ $purchase['products']['supplier']->name }}</td>
                                                <td>{{ $purchase->buying_price }}</td>
                                                <td>{{ $purchase->unit_price }}</td>
                                                <td>{{ $purchase->unt_sell_price }}</td>
                                                <td>{{ $purchase->buying_qty }}</td>

                                                <td>{{ $purchase['unit']->name }}</td>
                                                <td>
                                                    @if($purchase->status == 0)
                                                        <span class="badge badge-warning">Pending</span>
                                                    @elseif($purchase->status == 1)
                                                        <span class="badge badge-success">Apprvd.</span>
                                                    @endif
                                                </td>
                                                <td>
                                                     @if($purchase->status == 0)
                                                        <a href="#deleteModal{{ $purchase->id }}" data-toggle="modal" class="badge badge-danger text-right">
                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                        </a>
                                                        <!-- Delete Modal -->
                                                        <div class="modal fade" id="deleteModal{{ $purchase->id }}"
                                                             tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                             aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Are
                                                                            sure to delete?</h5>
                                                                        <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form
                                                                            action="{!! route('admin.purchase.delete', $purchase->id) !!}"
                                                                            method="post">
                                                                            {{ csrf_field() }}
                                                                            <button type="submit" class="btn btn-danger">
                                                                                Permanent Delete
                                                                            </button>
                                                                        </form>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                                data-dismiss="modal">Cancel
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Delete Modal -->
                                                    @elseif($purchase->status == 1)
                                                        <span class="badge badge-success"><i class="fas fa-check" aria-hidden="true"></i></span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="12"> Opps!!, {{$title}} Not found</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body ----->
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
    <script src="{{ URL::asset('backend')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ URL::asset('backend')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ URL::asset('backend')}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
                "bDestroy": true,
            });
        });
    </script>
@endpush
