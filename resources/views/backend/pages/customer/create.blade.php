@extends('backend.layouts.master')

@section('content')
    <div class="content-wrapper" style="min-height: 1244.06px;">
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-md-center">

                    <div class="col-md-8">

                        <div class="card card-info mt-2">
                            <div class="card-header">
                                <h3 class="card-title">{{ $title }}</h3>
                            </div>


                                {!! Form::open([ 'route' => ['admin.customers.store'], 'id' => 'customerForm', 'method' => 'post']) !!}
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">@lang('form.name')<span class="text-danger">*</span></label>
                                        {!! Form::text('name', null, [ 'class' => 'form-control', 'data-validation-required-message' => 'This field is required', 'placeholder' => 'Enter name']) !!}
                                        {!! $errors->first('name', '<label class="help-block text-danger">:message</label>') !!}
                                    </div>

                                    <div class="form-group">
                                        <label for="email">@lang('form.email')</label>
                                        {!! Form::text('email', null, [ 'class' => 'form-control', 'data-validation-required-message' => 'This field is required', 'placeholder' => 'Enter name']) !!}
                                        {!! $errors->first('email', '<label class="help-block text-danger">:message</label>') !!}
                                    </div>
                                    <div class="form-group">
                                        <label for="mobile_no">@lang('form.mobile_no')<span class="text-danger">*</span></label>
                                        {!! Form::text('mobile_no', null, [ 'class' => 'form-control', 'data-validation-required-message' => 'This field is required', 'placeholder' => 'Enter name']) !!}
                                        {!! $errors->first('mobile_no', '<label class="help-block text-danger">:message</label>') !!}
                                    </div>
                                    <div class="form-group">
                                        <label for="address">
                                            @lang('form.address')</label>
                                        {!! Form::text('address', null, [ 'class' => 'form-control', 'data-validation-required-message' => 'This field is required', 'placeholder' => 'Enter name']) !!}
                                        {!! $errors->first('address', '<label class="help-block text-danger">:message</label>') !!}
                                    </div>

                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-info">Submit</button>
                                    <a href="{{ route('admin.customers.view') }}" class="btn btn-danger"><i class="fas fa-undo"></i></a>
                                </div>
                            {!! Form::close() !!}
                        </div>
                        <!-- /.card -->
                    </div>

                    <div class="col-md-6">

                    </div>

                </div>

            </div><!-- /.container-fluid -->
        </section>

    </div>
@endsection
@push('scripts')

<script type="text/javascript">
    $(document).ready(function () {

        $('#customerForm').validate({
            rules: {
                name: {
                    required: true,
                    name: true,
                },
                email: {
                    required: true,
                    email: true,
                },
                mobile_no: {
                    required: true,
                    mobile_no: true,
                },
                address: {
                    required: true,
                    address: true
                },

            },
            messages: {
                name: {
                    required: "Please enter a name",
                    name: "Please enter name"
                },
                email: {
                    required: "Please enter a email address",
                    email: "Please enter a email"
                },
                mobile_no: {
                    required: "Please enter a mobile no",
                    mobile_no: "Please enter a mobile"
                },
                address: {
                    required: "Please provide a address",
                    address: "Please write address"
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
