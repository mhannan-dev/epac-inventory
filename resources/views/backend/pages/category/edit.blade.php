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


                            {!! Form::open([ 'route' => ['admin.category.update',$data_list->id ], 'id' => 'customerForm','method' => 'post']) !!}
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">@lang('form.name')<span class="text-danger">*</span></label>

                                    <input type="text" name="name" class="form-control" data-validation-required-message="This field is required" value="{{ $data_list->name }}">
                                    {!! $errors->first('name', '<label class="help-block text-danger">:message</label>') !!}
                                </div>

                                <div class="form-group">
                                    <label for="code">@lang('form.code')<span class="text-danger">*</span></label>
                                    <input type="text" name="code" class="form-control" data-validation-required-message="This field is required" value="{{ $data_list->code }}">
                                    {!! $errors->first('code', '<label class="help-block text-danger">:message</label>') !!}
                                </div>
                                <div class="form-group">
                                    <label for="is_active">Status</label>
                                    <select class="form-control" name="status">

                                        <option value="active" {{( $data_list->status == "active" )? "selected": " "}}>Active</option>
                                        <option value="inactive" {{( $data_list->status == "inactive" )? "selected": " "}}>Inactive</option>
                                    </select>
                                </div>

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info">Submit</button>
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
                    code: {
                        required: true,
                        code: true,
                    },

                    status: {
                        required: true,
                        status: true
                    }
                },
                messages: {
                    name: {
                        required: "Please enter a name",
                        name: "Please enter name"
                    },
                    code: {
                        required: "Please enter a code",
                        code: "Please enter a code"
                    },
                    status: {
                        required: "Please select status",
                        status: "Please select status"
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
