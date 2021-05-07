@php
$payment = App\Models\Payment::where('invoice_id', $invoice->id)->first();
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Epac.com.bd| Invoice #{{ $invoice->invoice_no }} Print</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('backend/dist/css/adminlte.css') }}">
    <style>
        .page-break {
            page-break-after: always;
        }
        .logo {
            height: 50px;
            width: 150px
        }
        @media print {
            @page {
                margin-top: 0;
                margin-bottom: 0;
            }
            body {
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
            <!-- title row -->
            <div class="row">
                <div class="col-12">
                    <h2 class="page-header">
                        <img src="{{ asset('backend/epac_logo.jpg') }}" alt="epac_logo" class="logo">
                    </h2>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    Sold From,
                    <address>
                        <strong>Epac.com.bd</strong><br>
                        45,Topkhana Road,<br>
                        Purana Paltan, Dhaka-1000<br>
                        Mobile : 0184 1180 710<br>
                        Mail: support@epac.com.bd<br>
                        Web: epac.com.bd
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    Sold To,
                    <address>
                        <strong>{{ $payment['customer']['name']}}</strong><br>
                        Address: {{ $payment['customer']['address']}}<br>
                        Mobile: {{ $payment['customer']['mobile_no']}}<br>
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <b>Invoice #{{ $invoice->invoice_no }}</b><br>
                    <b>Invoice Date:</b> {{ $invoice->date }}<br>
                    <b>Due Date:</b> {{ $date = \Carbon\Carbon::now()->toDateString() }}<br>
                    {{-- <b>Account:</b> 968-34567 --}}
                </div>
                <!-- /.col -->
            </div>
            <!-- Table row -->
            <div class="row">
                <div class="col-12 table-responsive">
                    <table width="100%" class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Product name</th>
                                <th>Quantity</th>
                                <th class="text-right">Selling Price</th>
                                <th class="text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total_sum = '0';
                            @endphp
                            @foreach($invoice['invoice_details'] as $key => $details)
                            <tr class="table-primary">
                                <td>{{ $key+1 }}</td>
                                <td>{{ $details['products']['name'] }}</td>
                                <td>{{ $details->selling_qty }}</td>
                                <td class="text-right">{{ $details->unt_sell_price }}</td>
                                <td class="text-right">{{ number_format($details->selling_price,  2, '.', '') }}</td>
                            </tr>
                            @php
                                 $total_sum += $details->selling_price;
                            @endphp
                            @endforeach
                            <tr class="text-right">
                                <td colspan="4">Sub Total</td>
                                <td>{{ number_format($total_sum, 2) }}</td>
                            </tr>
                            <tr class="text-right table-success">
                                <td colspan="4" class="text-muted">Discount</td>
                                <td>{{ number_format($payment->discount_amount, 2)}}</td>
                            </tr>
                            <tr class="text-right" style="text-decoration: underline;">
                                <td colspan="4" class="te">Paid amount</td>
                                <td>{{ number_format($payment->paid_amount, 2)}}</td>
                            </tr>
                            <tr class="text-right table-warning">
                                <td colspan="4">Due</td>
                                <td>{{ number_format($payment->due_amount, 2)}}</td>
                            </tr>
                            <tr class="text-right " style="text-decoration: underline double;">
                                <td colspan="4"> <strong> Grand Total</strong> </td>
                                <td>{{ number_format($payment->total_amount, 2)}}</td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-md-offset-6 col-md-6">
                    <strong >In words: </strong>
                    <span class="text-capitalize">
                        @php
                        $digit = new NumberFormatter("en", NumberFormatter::SPELLOUT);
                    @endphp 
                    {{  $digit->format($payment->total_amount) }} taka only.
                    </span>
                </div>
            </div>
            <div class="row text-center mt-3">
                <div class="col-12">
                    Thanks for choosing <strong>epac.com.bd</strong>
                    <br>(System generated Invoice singature not required).
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- ./wrapper -->
    <div class="page-break"></div>
    <br><br><br>
    <div class="wrapper">
        <!-- Main content -->
        <section class="invoice">
            <!-- title row -->
            <div class="row">
                <div class="col-12">
                    <h2 class="page-header">
                        <img src="{{ asset('backend/epac_logo.jpg') }}" alt="epac_logo" class="logo">
                    </h2>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    Sold From,
                    <address>
                        <strong>Epac.com.bd</strong><br>
                        45,Topkhana Road,<br>
                        Purana Paltan, Dhaka-1000<br>
                        Mobile : 0184 1180 710<br>
                        Mail: support@epac.com.bd<br>
                        Web: epac.com.bd
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    Sold To,
                    <address>
                        <strong>{{ $payment['customer']['name']}}</strong><br>
                        Address: {{ $payment['customer']['address']}}<br>
                        Mobile: {{ $payment['customer']['mobile_no']}}<br>
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <b>Challan No : {{ $invoice->invoice_no }}</b><br>
                    <b>Challan Date : </b> {{ $invoice->date }}<br>
                    {{-- <b>Account:</b> 968-34567 --}}
                </div>
                <!-- /.col -->
            </div>
            <!-- Table row -->
            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>{{ $details['products']['name'] }}</td>
                                <td>{{ $invoice->description }}</td>
                                <td>{{ $details->selling_qty }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <div class="row text-center mt-5">
                <div class="col-12">
                    Thanks for choosing <strong>epac.com.bd</strong>
                    <br>(System generated Invoice singature not required).
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- Page specific script -->
    <script>
        window.addEventListener("load", window.print());
    </script>
</body>
</html>
