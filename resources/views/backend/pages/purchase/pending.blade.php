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
                                    {{--<a href="{{ route('admin.purchase.create') }}"
                                        class="btn btn-outline-info"><i class="fas fa-plus"></i> &nbsp;Add
                                        {{ $title }}</a>--}}
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Date</th>
                                            <th>Supplier</th>

                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Unit</th>
                                            <th>Rate</th>
                                            <th>Selling Rate</th>
                                            <th>Quantity</th>
                                            <th>Buying Price</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($purchases))
                                            @foreach ($purchases as $purchase)
                                                <tr>
                                                    <td>1</td>
                                                    <td>{{ $purchase->date }}</td>
                                                    <td>{{ $purchase['products']['supplier']->name }}</td>

                                                    <td>{{ $purchase['products']->name }}</td>
                                                    <td>{{ $purchase->description }}</td>

                                                    <td><button class="btn btn-success btn-sm">{{ $purchase['unit']->name }}</button></td>

                                                    <td>{{ $purchase->unit_price }}</td>
                                                    <td><span class="badge badge-success">{{ $purchase->unt_sell_price }}</span></td>
                                                    <td>{{ $purchase->buying_qty }}</td>
                                                    <td>{{ $purchase->buying_price }}</td>
                                                    <td>
                                                         @if ($purchase->status == '0')
                                                            <span class="badge badge-warning">
                                                                Pending
                                                            </span>
                                                        @else
                                                            <span class="badge badge-warning">
                                                                Approved
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                    @if($purchase->status == 0)
                                                        <a title="Approve" href="#approveModal{{ $purchase->id }}" data-toggle="modal" class="badge badge-success text-right">
                                                            <i class="fa fa-check" aria-hidden="true"></i>
                                                        </a>
                                                        <!-- Delete Modal -->
                                                        <div class="modal fade" id="approveModal{{ $purchase->id }}"
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
                                                                        <form action="{!! route('purchase.approve', $purchase->id) !!}" method="post">
                                                                            @csrf

                                                                            <button type="submit" class="btn btn-success">
                                                                                Permanent Approve
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
                                                    @elseif($purchase->status == 1)
                                                        <span class="badge badge-success"><i class="fas fa-check" aria-hidden="true"></i></span>
                                                    @endif


                                                </td>
                                                </tr>
                                            @endforeach
                                        @else
                                        <tr>
                                            <td colspan="13"> Opps!!, {{$title}} Not found</td>
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
                "bDestroy": true,
            });
            
        });

    </script>

@endpush
