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
                            {!! Form::open([ 'route' => ['admin.products.store' ],'name'=>'supplierForm' ,'id' => 'supplierForm', 'method' => 'post']) !!}
                            @csrf
                            <div class="card-body">
                                <div class="form-row">

                                    <div class="form-group col-md-3">

                                        <div class="form-group">
                                            <label>Supplier</label>
                                            <select class="form-control select2 form-control-sm" style="width: 100%;" id="supplier_id" name="supplier_id">

                                                <option selected="selected">Select supplier</option>
                                                @foreach($suppliers as $data_row)

                                                    <option value="{{ $data_row->id}}">{{ $data_row->name }}</option>
                                                @endforeach

                                            </select>
                                        </div>

                                    </div>
                                    <div class="form-group col-md-3">

                                        <div class="form-group">
                                            <label>Category</label>
                                            <select class="form-control select2 form-control-sm" style="width: 100%;" id="category_id" name="category_id">
                                                <option selected="selected">Select Category</option>
                                                @foreach($categories as $data_row)

                                                    <option value="{{ $data_row->id}}">{{ $data_row->name }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group col-md-3">

                                        <div class="form-group">
                                            <label>Unit</label>
                                            <select  class="form-control select2 form-control-sm" style="width: 100%;" id="unit_id" name="unit_id">
                                                <option selected="selected">Select Unit</option>
                                                @foreach($units as $data_row)

                                                    <option value="{{ $data_row->id}}">{{ $data_row->name }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="status">Name</label>
                                        <input type="text" class="form-control form-control-sm" name="name" id="name" placeholder="Enter product name">
                                    </div>


                                </div>

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info btn-sm">@lang('form.btn_save')</button>
                                <a href="{{ route('admin.products.view') }}" class="btn btn-danger btn-sm"><i
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

    <!-- Category Modal-->
    <div class="modal fade" id="addCatgModal" tabindex="-1" role="dialog" aria-labelledby="addCatgModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Product Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open([ 'route' => ['admin.category.store'], 'id' => 'prdForm','method' => 'post']) !!}
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">@lang('form.name')<span class="text-danger">*</span></label>
                            {!! Form::text('name', null, [ 'class' => 'form-control form-control-sm', 'data-validation-required-message' => 'This field is required', 'placeholder' => 'Enter category name']) !!}
                            {!! $errors->first('name', '<label class="help-block text-danger">:message</label>') !!}
                        </div>

                        <div class="form-group">
                            <label for="code">@lang('form.code')<span class="text-danger">*</span></label>
                            {!! Form::text('code', null, [ 'class' => 'form-control form-control-sm', 'data-validation-required-message' => 'This field is required', 'placeholder' => 'Enter category code']) !!}
                            {!! $errors->first('code', '<label class="help-block text-danger">:message</label>') !!}
                        </div>
                        <div class="form-group">
                            <label for="status">@lang('form.status')</label>
                            <select class="form-control form-control-sm" id="status" name="status">
                                <option value="active">Select status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>

                            </select>
                        </div>

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Submit</button>
                        <a href="{{ route('admin.category.view') }}" class="btn btn-danger"><i class="fas fa-undo"></i></a>
                    </div>
                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </div>

    <<!-- Supplier Modal-->
    <div class="modal fade" id="addSupplierModal" tabindex="-1" role="dialog" aria-labelledby="addSupplierModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Product Supplier</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open([ 'route' => ['admin.supplier.store'], 'id' => 'prdForm','method' => 'post']) !!}
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">@lang('form.name')<span class="text-danger">*</span></label>
                            <input class="form-control form-control-sm" name="name" placeholder="Enter supplier name"/>
                            {!! $errors->first('name', '<label class="help-block text-danger">:message</label>') !!}
                        </div>

                        <div class="form-group">
                            <label for="email">@lang('form.email')<span class="text-danger">*</span></label>
                            <input class="form-control form-control-sm" name="email" placeholder="Enter supplier email"/>
                            {!! $errors->first('email', '<label class="help-block text-danger">:message</label>') !!}
                        </div>
                        <div class="form-group">
                            <label for="mobile_no">@lang('form.mobile_no')<span
                                    class="text-danger">*</span></label>

                            <input class="form-control form-control-sm" name="mobile_no"
                                   placeholder="Enter supplier mobile no"/>
                            {!! $errors->first('mobile_no', '<label class="help-block text-danger">:message</label>') !!}
                        </div>
                        <div class="form-group">
                            <label for="address">@lang('form.address')<span class="text-danger">*</span></label>
                            <input class="form-control form-control-sm" name="address" placeholder="Enter supplier address"/>
                            {!! $errors->first('address', '<label class="help-block text-danger">:message</label>') !!}
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control form-control-sm" id="status" name="status">
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

            </div>
        </div>
    </div>
    <<!-- Brand Modal-->
    <div class="modal fade" id="addBrandModal" tabindex="-1" role="dialog" aria-labelledby="addBrandModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Product Brand</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open([ 'route' => ['admin.brand.store'], 'name'=>'brandForm' , 'id' => 'brandForm', 'method' => 'post']) !!}

                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">@lang('form.name')<span class="text-danger">*</span></label>

                            <input type="text" class="form-control form-control-sm {{ $errors->has('name') ? 'error' : '' }}" name="name" id="name" placeholder="Enter brand name"/>

                            @if ($errors->has('name'))
                                <div class="error">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="code">@lang('form.code')<span class="text-danger">*</span></label>

                            <input class="form-control form-control-sm" name="code" placeholder="Enter brand code"/>

                            {!! $errors->first('code', '<label class="help-block text-danger">:message</label>') !!}
                        </div>
                        <div class="form-group">
                            <label>@lang('form.body')</label>
                            <textarea name="description" class="form-control form-control-sm" rows="3" placeholder="Enter short desc...."></textarea>
                        </div>

                        <div class="form-group">
                            <label for="is_active">Status</label>
                            <select class="form-control form-control-sm" name="status">
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

            </div>
        </div>
    </div>
    <div class="modal fade" id="addUnitModal" tabindex="-1" role="dialog" aria-labelledby="addUnitModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Product Unit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open([ 'route' => ['admin.units.store'], 'id' => 'customerForm','method' => 'post']) !!}
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">@lang('form.name')<span class="text-danger">*</span></label>
                            {!! Form::text('name', null, [ 'class' => 'form-control form-control-sm', 'data-validation-required-message' => 'This field is required', 'placeholder' => 'Enter category name']) !!}
                            {!! $errors->first('name', '<label class="help-block text-danger">:message</label>') !!}
                        </div>


                        <div class="form-group">
                            <label for="status">@lang('form.status')</label>
                            <select class="form-control form-control-sm" id="status" name="status">
                                <option value="active">Select status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>

                            </select>
                        </div>

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Submit</button>
                        <a href="{{ route('admin.units.view') }}" class="btn btn-danger"><i class="fas fa-undo"></i></a>
                    </div>
                    {!! Form::close() !!}
                </div>

            </div>
        </div>
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
                    supplier_id: {
                        required: true,

                    },
                    category_id: {
                        required: true,

                    },
                    name: {
                        required: true,

                    },
                    email: {
                        required: true,

                    },
                    mobile_no: {
                        required: true,

                    },
                    address: {
                        required: true,

                    },

                },
                messages: {
                    supplier_id: {
                        required: "Please select supplier",
                        name: "Please select supplier"
                    },

                    category_id: {
                        required: "Please select category",
                        name: "Please select category"
                    },
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
