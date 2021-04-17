@php
   // $payment = App\Models\Payment::where('invoice_id', $invoice->id)->first();
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Epac.com.bd| Stock</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('backend/dist/css/adminlte.css') }}">
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
</head>
<body>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- info row -->
    <div class="row invoice-info text-center">
      <div class="col invoice-col">
        <h1 class="text-danger">Working on this</h1>
          <h3>Epac.com.bd</h3>
          45, Topkhana Road,
          Purana paltan,<br>
          Dhaka - 1000 <br>
          Mobile: +880 1823 88 38 91<br>
          Email: support@epac.com.bd
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    <!-- Table row -->
    <div class="row">
      <div class="col-12 table-responsive">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>@lang('form.th_sl')</th>
                <th>@lang('form.th_supplier')</th>
                
                <th>Product Name</th>
                <th>Created At</th>
                <th>Stock</th>
                <th>@lang('form.th_units')</th>
            </tr>
            </thead>
            <tbody>
            @if(count($supplier_wise_stock))
                @foreach ($supplier_wise_stock as $key => $list)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td class="text-success">{{ $list['supplier']['name'] }}</td>

                        <td>{{ Str::limit($list->name, 20) }}</td>
                        <td>{{ \Carbon\Carbon::parse($list->created_at)->diffForHumans() }}</td>
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
                    <td colspan="5"> Opps!!,  Not found</td>
                </tr>
            @endif
            </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
<!-- Page specific script -->
<script>
  window.addEventListener("load", window.print());
</script>
</body>
</html>
