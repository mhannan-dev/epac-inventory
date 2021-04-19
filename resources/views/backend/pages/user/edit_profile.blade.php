@extends('backend.layouts.master')

@section('content')
    <div class="content-wrapper" style="min-height: 1416.81px;">


    <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="offset-md-2 col-md-8 off-md-2">

                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">


                            <div class="card-body box-profile">

                                <h3 class="profile-username text-center">Update Profile</h3>


                                {!! Form::open([ 'route' => ['logged_in.user.profile.update', $editData->id], 'method' => 'post', 'files' => true, 'name'=> 'uploaded_form' ]) !!}
                                @csrf
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" class="form-control" id="name" placeholder="Enter name" required value="{{$editData->name}}">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" class="form-control" id="email" placeholder="Email" required value="{{$editData->email}}" readonly>

                                            <label for="mobile">Mobile</label>
                                            <input type="text" name="mobile" class="form-control" id="mobile" required value="{{$editData->mobile}}">

                                            <label for="status">Gender</label>
                                            <select class="form-control" id="gender" name="gender" required>
                                                <option value="Male"{{($editData->gender=="Male")?"selected":""}}>Male</option>
                                                <option value="Female"{{($editData->gender=="Female")?"selected":""}}>Female</option>
                                            </select>

                                            <label>Address</label>

                                            <input type="text" class="form-control" id="address" name="address" value="{{$editData->address}}">

                                            <button type="submit" class="btn btn-info btn-block mt-2">@lang('form.btn_update')</button>

                                        </div>



                                    </div>

                                {!! Form::close() !!}


                            </div>


                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->


                    </div>

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function(){
            $("#image").change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showImage').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });


    </script>
@endpush
