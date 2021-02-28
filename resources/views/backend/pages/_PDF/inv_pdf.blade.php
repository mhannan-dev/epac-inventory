<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ URL::asset('backend') }}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Hello, world!</title>
    <style>

        table {
            border-collapse: collapse;
            width: 100%;
            margin: 0;
            padding: 0;
        }


        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }

        .alignleft {
            float: left;
        }

        .alignright {
            float: right;
        }
    </style>
</head>

<body>


      <table style="margin-bottom: 10px;">
        <tr>
            <th>From</th>
            <th>To</th>
            <th>Info</th>
        </tr>
        <tr>
            <td>

                <span>epac Ltd.</span><br>
                45, Topkhana Road, <br>
                Purana platinum,<br>
                Dhaka-1000.


            </td>
            <td>

                <span>Al Mahmud</span><br>
                45, Rayerbazar, <br>
                Dhaka-1000.


            </td>
            <td>

                <strong>Invoice no# </strong>12545<br>
                <strong>Payment Due:</strong> 01/03/2021 </span> <br>
                <strong>Account:</strong> 968-34567 </span>


            </td>
        </tr>
        </table

    <table>
        <tr>
            <th>Company</th>
            <th>Contact</th>
            <th>Country</th>
        </tr>
        <tr>
            <td>Alfreds Futterkiste</td>
            <td>Maria Anders</td>
            <td>Germany</td>
        </tr>
        <tr>
            <td>Centro comercial Moctezuma</td>
            <td>Francisco Chang</td>
            <td>Mexico</td>
        </tr>
        <tr>
            <td>Ernst Handel</td>
            <td>Roland Mendel</td>
            <td>Austria</td>
        </tr>
        <tr>
            <td>Island Trading</td>
            <td>Helen Bennett</td>
            <td>UK</td>
        </tr>
        <tr>
            <td>Laughing Bacchus Winecellars</td>
            <td>Yoshi Tannamuri</td>
            <td>Canada</td>
        </tr>
        <tr>
            <td>Magazzini Alimentari Riuniti</td>
            <td>Giovanni Rovelli</td>
            <td>Italy</td>
        </tr>
    </table>



    {{-- <div class="row">
            <div class="col-md-12">
                @php
                    $payment = App\Models\Payment::where('invoice_id', $invoice->id)->first();
                @endphp
                <table width="100%">
                    <tbody>
                        <tr>
                            <td width="30%">
                                <strong>Name :</strong> {!! $payment['customer']['name'] !!}
                            </td>

                            <td width="30%">
                                <strong>Mobile :</strong> {!! $payment['customer']['mobile_no'] !!}
                            </td>

                            <td width="40%">
                                <strong>Address :</strong> {!! $payment['customer']['address'] !!}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div> --}}


</body>

</html>
