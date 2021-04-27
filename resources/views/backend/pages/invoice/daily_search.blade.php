@extends('backend.layouts.master')
@push('styles')
    <link rel="stylesheet" href="">
@endpush
@section('content')
    <div class="content-wrapper" style="min-height: 1244.06px;">
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-md-center">
                    <div class="col-lg-12">
                        <div class="card card-info mt-2">
                            <div class="card-header">
                                <h3 class="card-title">{{ $title }}</h3>
                                <h3 class="card-title ml-2">
                                    <a href="{{ route('invoice.create') }}"><i class="fas fa-plus text-warning"></i>
                                        Create Bill</a>
                                </h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('invoice.daily.report') }}" method="GET" target="_blank"
                                    id="myForm">
                                    <div class="form-row">
                                        <div class="form-group col-md-2">
                                            <label>Start Date</label>
                                            <input class="form-control" name="start_date" id="start_date"
                                                placeholder="YY-MM-DD" />
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>End Date</label>
                                            <input class="form-control" name="end_date" id="end_date"
                                                placeholder="YY-MM-DD" />
                                        </div>
                                        <div class="form-group col-md-3" style="padding-top: 30px;">
                                            <button class="btn btn-success float-left">Search</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.card -->
                        <div class="card card-info mt-2">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>@lang('form.th_sl')</th>
                                        <th>Customer Name</th>
                                        <th>Invoice No</th>
                                        <th>Date</th>
                                        <th>Description</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>@lang('form.th_action')</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @if (count($invoices))
                                        @foreach ($invoices as $key => $invoice)

                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $invoice['payment']['customer']['name']}} || {{ $invoice['payment']['customer']['mobile_no']}}</td>
                                            <td>{!! $invoice->invoice_no !!}</td>
                                            <td>{!! $invoice->date !!}</td>
                                            <td>{!! $invoice->description !!}</td>
                                            <td>{{ $invoice['payment']['total_amount']}}</td>
                                            <td>
                                                @if ($invoice->status == 1)
                                                    Approved
                                                @else
                                                    Not Approved
                                                @endif
                                            </td>

                                            <td>
                                                @if($invoice->status == 0)

                                                <a target="_blank" title="Approve" href="{{ route('invoice.approve', $invoice->id)}}" class="badge badge-success text-right">
                                                    <i class="fa fa-check-circle" aria-hidden="true"></i>
                                                </a>

                                                <a title="Delete" href="#deleteModal{{ $invoice->id }}" data-toggle="modal" class="badge badge-danger text-right">
                                                    <i class="fa fa-trash-alt" aria-hidden="true"></i>
                                                </a>

                                                @elseif ($invoice->status == 1)
                                                <a  target="_blank" title="Approve" href="{{ route('invoice.web',$invoice->id) }}" class="badge badge-success text-right">
                                                    <i class="fa fa-print text-white" aria-hidden="true"></i>
                                                </a>
                                                @endif





                                                <!-- Delete Modal -->
                                                <div class="modal fade" id="deleteModal{{ $invoice->id }}"
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
                                                                <form action="{!! route('invoice.delete', $invoice->id) !!}" method="post">
                                                                    @csrf

                                                                    <button type="submit" class="btn btn-danger">
                                                                        Permanent Delete
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

                                        </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="8"> Opps!!, invoice not found</td>
                                        </tr>
                                    @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
        </section>
    </div>
@endsection
@push('scripts')
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#start_date').datepicker({
                uiLibrary: 'bootstrap4'
            });
            $('#end_date').datepicker({
                uiLibrary: 'bootstrap4'
            });
        });

    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    start_date: {
                        required: true,
                        start_date: true,
                    },
                    end_date: {
                        required: true,
                        end_date: true,
                    }
                },
                messages: {
                    start_date: {
                        required: "Please select start date",
                        start_date: "Please select start date"
                    },
                    end_date: {
                        required: "Please select end date",
                        start_date: "Please select end date"
                    }
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });

    </script>
@endpush
