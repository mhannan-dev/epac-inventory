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
                            </div>
                            <div class="card-body">
                                <form action="{{ route('invoice.daily.report') }}" method="GET" target="_blank" id="myForm">
                                    <div class="form-row">
                                        <div class="form-group col-md-2">
                                            <label>Start Date</label>
                                            <input class="form-control form-control-sm" name="start_date" id="start_date" placeholder="YY-MM-DD"/>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>End Date</label>
                                            <input class="form-control form-control-sm" name="end_date" id="end_date" placeholder="YY-MM-DD"/>
                                        </div>
                                        <div class="form-group col-md-1" style="padding-top: 30px;">
                                            <button class="btn btn-success float-right btn-sm">Search</button>
                                        </div>



                                    </div>
                                </form>
                                <a href="{{ route('invoice.create') }}" class="btn btn-outline-info"><i
                                    class="fas fa-plus"></i> &nbsp; Create Bill</a>
                            </div>
                        </div>
                        <!-- /.card -->
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
        $(document).ready(function () {
            $('#start_date').datepicker({
                uiLibrary: 'bootstrap4'
            });
            $('#end_date').datepicker({
                uiLibrary: 'bootstrap4'
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
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
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
@endpush
