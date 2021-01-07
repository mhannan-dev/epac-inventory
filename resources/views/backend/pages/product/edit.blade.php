@extends('backend.layouts.master')

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
                            {!! Form::open([ 'route' => ['admin.products.update',$product->id],'name'=>'supplierForm' ,'id' => 'supplierForm', 'method' => 'post']) !!}
                            @csrf
                            <div class="card-body">
                                <div class="form-row">


                                    <div class="form-group col-md-4">
                                    @if($suppliers->count() < 1)
                                        <!-- Button trigger modal -->
                                            <a type="button" class="btn btn-outline-info mt-md-4"
                                               style="margin-top: 30px !important;" data-toggle="modal"
                                               data-target="#addSupplierModal">
                                                Add Supplier <i class="fa fa-plus" aria-hidden="true"></i>
                                            </a>
                                        @else
                                            <label for="supplier_id">Select Supplier</label>
                                            <select class="form-control form-control-sm select2" id="supplier_id" name="supplier_id">
                                                <option>Select supplier</option>
                                                @foreach($suppliers as $data_row)

                                                    <option value="{{ $data_row->id}}"
                                                            @if($data_row->id == $product->supplier_id): selected @else
                                                        ' ' @endif>
                                                    {{ $data_row->name }}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>


                                    <div class="form-group col-md-4">

                                        <label for="cuntry">Select category</label>
                                        <select class="form-control form-control-sm select2" id="category_id" name="category_id">
                                            <option>Select category</option>
                                            @foreach($categories as $data_row)
                                                <option value="{{ $data_row->id}}"
                                                        @if($data_row->id == $product->category_id): selected @else '
                                                ' @endif>
                                                {{ $data_row->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="status">Name</label>
                                        <input type="text" class="form-control form-control-sm" name="name" id="name"
                                               value="{{ $data_row->name }}">
                                    </div>

{{--                                    <div class="form-group col-md-6">--}}
{{--                                    @if($units->count() < 1)--}}
{{--                                        <!-- Button trigger modal -->--}}
{{--                                            <a type="button" class="btn btn-outline-info btn-sm mt-md-4"--}}
{{--                                               style="margin-top: 30px !important;" data-toggle="modal"--}}
{{--                                               data-target="#addUnitModal">--}}
{{--                                                Add Unit <i class="fa fa-plus" aria-hidden="true"></i>--}}
{{--                                            </a>--}}

{{--                                        @else--}}
{{--                                            <label for="unit_id">Select Unit</label>--}}
{{--                                            <select class="form-control form-control-sm select2" id="unit_id" name="unit_id">--}}
{{--                                                <option>Select unit</option>--}}
{{--                                                @foreach($units as $data_row)--}}
{{--                                                    <option value="{{ $data_row->id}}"--}}
{{--                                                            @if($data_row->id == $product->unit_id): selected @else '--}}
{{--                                                    ' @endif>--}}
{{--                                                    {{ $data_row->name }}</option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                        @endif--}}
{{--                                    </div>--}}


                                </div>


                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info btn-sm">@lang('form.btn_save')</button>
                                <a href="{{ route('admin.products.view') }}" class="btn btn-danger  btn-sm"><i
                                        class="fas fa-undo"></i></a>
                            </div>
                            {!! Form::close() !!}


                        </div>
                        <!-- /.card -->
                    </div>



                </div>

            </div><!-- /.container-fluid -->
        </section>

    </div>




@endsection
@push('scripts')


    <script type="text/javascript">


        $(document).ready(function () {

            $("#prdForm").submit(function (event) {
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
