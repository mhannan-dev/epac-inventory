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
      <div class="col invoice-col mb-3">
          <h3>Epac.com.bd</h3>
          45, Topkhana Road,
          Purana paltan,<br>
          Dhaka - 1000 <br>
          Mobile: +880 1823 88 38 91<br>
          Email: support@epac.com.bd <br>
          <strong>Supplier Name: {{ $products[0]['supplier']['name'] }} </strong> <br>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    <!-- Table row -->
    <div class="row">
      <div class="col-12 table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>@lang('form.th_sl')</th>
                    <th>Product Name</th>
                    <th>Stock</th>
                    <th>Buying Price</th>
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
                            <td>
                                @php
                                $buying_price = App\Models\Purchase::where('supplier_id', $list->supplier_id)
                                ->where('product_id', $list->id)
                                ->where('status', '1')
                                ->sum('buying_price');

                                @endphp
                                {{ $buying_price }}
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
