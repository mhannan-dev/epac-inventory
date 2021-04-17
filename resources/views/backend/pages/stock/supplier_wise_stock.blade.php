@extends('backend.layouts.master')
<style>
    @media print {
      @page {
        margin-top: 0;
        margin-bottom: 0;
      }
      body  {
        padding-top: 5rem;
        padding-bottom: 5rem;
      }
    }
  </style>
@section('content')
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                  <div class="col-12">
                    <!-- Main content -->
                    <div class="invoice p-3 mb-3">
                      <!-- title row -->
                      <div class="row">
                        <div class="col-12">
                          <h4>
                           {{ $products['0']['supplier']['name'] }}
                            <small class="float-right">Date: <?php echo date('Y-m-d'); ?></small>
                          </h4>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- info row -->
                      <!-- Table row -->
                      <div class="row">
                        <div class="col-12 table-responsive">
                          <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>@lang('form.th_sl')</th>
                                    <th>Product Name</th>
                                    <th>Stock</th>
                                    <th>@lang('form.th_units')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($products))
                                    @foreach ($products as $key => $list)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ Str::limit($list->name, 20) }}</td>
                                            <td>
                                                @if ( $list->quantity == NULL )
                                                    0
                                                @else
                                                {{ $list->quantity }}
                                                @endif
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
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->
                      <!-- this row will not appear when printing -->
                      <div class="row no-print">
                        <div class="col-12">
                            <a href="{{ route('supplier.wise.stock.print') }}" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                        </div>
                      </div>
                    </div>
                    <!-- /.invoice -->
                  </div><!-- /.col -->
                </div><!-- /.row -->
              </div>
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
