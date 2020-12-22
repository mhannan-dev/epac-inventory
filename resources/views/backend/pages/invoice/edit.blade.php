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

                                            <label for="cuntry">Select category</label>
                                            <select class="form-control" id="category_id" name="category_id">
                                                <option>Select category</option>
                                                @foreach($categories as $data_row)
                                                    <option value="{{ $data_row->id}}" @if($data_row->id == $product->category_id): selected @else ' ' @endif>
                                                        {{ $data_row->name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                    </div>

                                    <div class="form-group col-md-4">
                                    @if($suppliers->count() < 1)
                                        <!-- Button trigger modal -->
                                            <a type="button" class="btn btn-outline-info mt-md-4" style="margin-top: 30px !important;" data-toggle="modal" data-target="#addSupplierModal">
                                                Add Supplier <i class="fa fa-plus" aria-hidden="true"></i>
                                            </a>
                                        @else
                                            <label for="cuntry">Select Supplier</label>
                                            <select class="form-control" id="supplier_id" name="supplier_id">
                                                <option>Select supplier</option>
                                                @foreach($suppliers as $data_row)

                                                    <option value="{{ $data_row->id}}" @if($data_row->id == $product->supplier_id): selected @else ' ' @endif>
                                                        {{ $data_row->name }}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-4">
                                    @if($brands->count() < 1)
                                        <!-- Button trigger modal -->
                                            <a type="button" class="btn btn-outline-info mt-md-4" style="margin-top: 30px !important;" data-toggle="modal" data-target="#addBrandModal">
                                                Add Brand <i class="fa fa-plus" aria-hidden="true"></i>
                                            </a>

                                        @else
                                            <label for="cuntry">Select Brand</label>
                                            <select class="form-control" id="brand_id" name="brand_id">
                                                <option>Select brand</option>
                                                @foreach($brands as $data_row)
                                                    <option value="{{ $data_row->id}}" @if($data_row->id == $product->brand_id): selected @else ' ' @endif>
                                                        {{ $data_row->name }}</option>

                                                @endforeach
                                            </select>
                                        @endif
                                    </div>


                                    <div class="form-group col-md-4">
                                        <label for="status">Name</label>
                                        <input type="text" class="form-control" name="name" id="name" value="{{ $product->name }}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="status">Quantity</label>
                                        <input type="text" class="form-control" name="quantity" id="quantity" value="{{ $product->quantity }}">
                                    </div>
                                    <div class="form-group col-md-4">
                                    @if($units->count() < 1)
                                        <!-- Button trigger modal -->
                                            <a type="button" class="btn btn-outline-info mt-md-4" style="margin-top: 30px !important;" data-toggle="modal" data-target="#addUnitModal">
                                                Add Unit <i class="fa fa-plus" aria-hidden="true"></i>
                                            </a>

                                        @else
                                            <label for="unit_id">Select Unit</label>
                                            <select class="form-control" id="unit_id" name="unit_id">
                                                <option>Select unit</option>
                                                @foreach($units as $data_row)
                                                    <option value="{{ $data_row->id}}" @if($data_row->id == $product->unit_id): selected @else ' ' @endif>
                                                    {{ $data_row->name }}</option>
                                                @endforeach


                                            </select>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="status">Purchase Price</label>
                                        <input type="text" class="form-control" name="price" id="price" value="{{ $product->price }}">
                                    </div>



                                </div>
                                <div class="form-group">
                                    <label>Description</label>

                                    <input type="text" class="form-control" name="description" id="description" value="{{ $product->description }}">
                                </div>


                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info">@lang('form.btn_save')</button>
                                <a href="{{ route('admin.products.view') }}" class="btn btn-danger"><i
                                        class="fas fa-undo"></i></a>
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
