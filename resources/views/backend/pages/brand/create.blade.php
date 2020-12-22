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


                            {!! Form::open([ 'route' => ['admin.brand.store'], 'name'=>'brandForm' , 'id' => 'brandForm', 'method' => 'post']) !!}

                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">@lang('form.name')<span class="text-danger">*</span></label>

                                    <input type="text" class="form-control {{ $errors->has('name') ? 'error' : '' }}" name="name" id="name" placeholder="Enter brand name"/>

                                    @if ($errors->has('name'))
                                        <div class="error">
                                            {{ $errors->first('name') }}
                                        </div>
                                    @endif
                                </div>

{{--                                <div class="form-group">--}}
{{--                                    <label for="code">@lang('form.code')<span class="text-danger">*</span></label>--}}

{{--                                    <input class="form-control" name="code" placeholder="Enter brand code"/>--}}

{{--                                    {!! $errors->first('code', '<label class="help-block text-danger">:message</label>') !!}--}}
{{--                                </div>--}}
                                <div class="form-group">
                                    <label>@lang('form.description')</label>
                                    <textarea name="description" class="form-control" rows="3" placeholder="Enter short desc...."></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="is_active">Status</label>
                                    <select class="form-control" name="status">
                                        <option>Select Option</option>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>





                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info">@lang('form.btn_save')</button>
                                <a href="{{ route('admin.brand.view') }}" class="btn btn-danger"><i class="fas fa-undo"></i></a>
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

            $('#brandForm').validate({
                rules: {
                    name: {
                        required: true,
                        name: true,
                    },
                    code: {
                        required: true,
                        code: true,
                    }
                },
                messages: {
                    name: {
                        required: "Please enter a brand name",
                        name: "Please enter a brand name"
                    },
                    code: {
                        required: "Please enter a brand code",
                        email: "Please enter a brand code"
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
