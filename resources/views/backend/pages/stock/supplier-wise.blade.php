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

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <div class="form-check form-check-inline">
                                <label class="form-check-label">Supplier Wise Product</label> &nbsp;
                                <input class="form-check-input" type="radio" id="supplier_wise">
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <label class="form-check-label">Product Wise Report</label>&nbsp;
                                <input class="form-check-input" type="radio" id="product_wise">
                            </div>
                            <hr>

                            <form>
                                <div class="form-row">
                                  <div class="col-md-4">
                                    <label for="supplier_id">Supplier select</label>
                                    <select class="form-control" id="supplier_id" name="supplier_id">
                                        <option>Select Supplier</option>
                                        @foreach ($suppliers as $supplier)

                                <option value="{{ $supplier->id }}"> {{ $supplier->name }}</option>
                                        @endforeach
                                    </select>
                                  </div>

                                  <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary" style="margin-top: 31px;">Submit</button>
                                  </div>
                                </div>
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
