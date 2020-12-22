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


                            {!! Form::open([ 'route' => ['admin.supplier.store'],'name'=>'supplierForm' ,'id' => 'supplierForm', 'method' => 'post']) !!}

                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">@lang('form.name')<span class="text-danger">*</span></label>
                                    <input class="form-control" name="name" placeholder="Enter supplier name"/>
                                    {!! $errors->first('name', '<label class="help-block text-danger">:message</label>') !!}
                                </div>

                                <div class="form-group">
                                    <label for="email">@lang('form.email')<span class="text-danger">*</span></label>
                                    <input class="form-control" name="email" placeholder="Enter supplier email"/>
                                    {!! $errors->first('email', '<label class="help-block text-danger">:message</label>') !!}
                                </div>
                                <div class="form-group">
                                    <label for="mobile_no">@lang('form.mobile_no')<span
                                            class="text-danger">*</span></label>

                                    <input class="form-control" name="mobile_no"
                                           placeholder="Enter supplier mobile no"/>
                                    {!! $errors->first('mobile_no', '<label class="help-block text-danger">:message</label>') !!}
                                </div>
                                <div class="form-group">
                                    <label for="address">@lang('form.address')<span class="text-danger">*</span></label>
                                    <input class="form-control" name="address" placeholder="Enter supplier address"/>
                                    {!! $errors->first('address', '<label class="help-block text-danger">:message</label>') !!}
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status" name="status">
                                        <option>Select status</option>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>

                                    </select>
                                </div>

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info">@lang('form.btn_save')</button>
                                <a href="{{ route('admin.suppliers.view') }}" class="btn btn-danger"><i class="fas fa-undo"></i></a>
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

            $("#supplierForm").submit(function (event) {
                loadAjax();
                event.preventDefault()
            });

            $('#supplierForm').validate({
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
