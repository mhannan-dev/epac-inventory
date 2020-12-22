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
                                    <a href="{{ route('invoice.create') }}" class="btn btn-outline-info"><i class="fas fa-plus"></i> &nbsp;Add {{$title}}</a>
                                </div>

                            </div>

                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th width="4%">@lang('form.th_sl')</th>
                                        <th width="12%">PO No.</th>
                                        <th width="12%">Date</th>
                                        <th width="22%">@lang('form.th_title')</th>
                                        <th width="18%">@lang('form.th_supplier')</th>
                                        <th width="20%">@lang('form.th_product_brand')</th>
                                        <th>@lang('form.th_product_category')</th>
                                        <th>@lang('form.th_price')</th>
                                        <th>@lang('form.th_quantity')</th>
                                        <th>@lang('form.th_status')</th>
                                        <th>@lang('form.th_action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>


                                            <tr>
                                                <td>1</td>
                                                <td>01</td>
                                                <td>10-12-2020</td>
                                                <td>Walton Home Freeze</td>
                                                <td>Sons and Sons</td>
                                                <td>Walton</td>
                                                <td>Freeze</td>
                                                <td>1000</td>
                                                <td>100</td>
                                                <td>
                                                    Active
                                                </td>
                                                <td>
                                                    <i class="fas fa-trash"></i>
                                                    <a href=""><i class="fas fa-eye"></i></a>
                                                </td>
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
