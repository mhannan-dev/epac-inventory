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
                                    <a target="_blank" href="{{ route('stock.report.pdf') }}" class="btn btn-success"><i class="fas fa-save"></i> &nbsp;Download PDF</a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>@lang('form.th_sl')</th>
                                        <th>@lang('form.th_supplier')</th>
                                        <th>@lang('form.th_product_category')</th>
                                        <th>Product Name</th>
                                        <th>@lang('form.th_created_by')</th>
                                        <th>Stock</th>
                                        <th>@lang('form.th_units')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($products))
                                        @foreach ($products as $key => $list)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td class="text-success">{{ $list['supplier']['name'] }}</td>
                                                <td>{{ $list['category']['name'] }}</td>
                                                <td>{{ Str::limit($list->name, 20) }}</td>
                                                <td>{{ \Carbon\Carbon::parse($list->created_at)->diffForHumans() }}</td>
                                                <td>
                                                    {{ $list->quantity }}
                                                </td>
                                                <td>{{ $list->units->name }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5"> Opps!!, {{$title}} Not found</td>
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
    <link rel="stylesheet" href="{{ URL::asset('backend')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ URL::asset('backend')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
@endpush
@push('scripts')
    <script src="{{ URL::asset('backend')}}/plugins/datatables/jquery.dataTables.min.js"></script>
    <!-- DataTables -->
    <script src="{{ URL::asset('backend')}}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ URL::asset('backend')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ URL::asset('backend')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script>
        $(function () {
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
