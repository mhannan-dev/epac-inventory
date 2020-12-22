@extends('backend.layouts.master')

@section('content')
<div class="content-wrapper" style="min-height: 1416.81px;">
    @include('backend.partials.page_top')

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="offset-md-2 col-md-8 off-md-2">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">


                        <div class="card-body box-profile">

                            <h3 class="profile-username text-center">Create User</h3>


                            {!! Form::open([ 'route' => ['logged_in.user.store'], 'method' => 'post', 'files' => true ]) !!}
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Assign User Role</label>
                                    <select class="form-control" id="role_id" name="role_id" required>

                                        @foreach($user_roles as $user_data )
                                        <option value="{{ $user_data->role_id }}">{{ $user_data->name }}</option>
                                        @endforeach
                                    </select>

                                  </div>
                                  <div class="form-group">
                                    <label for="name">@lang('form.name')<span class="text-danger">*</span></label>
                                    {!! Form::text('name', null, [ 'class' => 'form-control', 'data-validation-required-message' => 'This field is required', 'placeholder' => 'Enter name']) !!}
                                    {!! $errors->first('name', '<label class="help-block text-danger">:message</label>') !!}
                                  </div>
                                  <div class="form-group">
                                    <label for="email">@lang('form.email')<span class="text-danger">*</span></label>
                                    {!! Form::text('email', null, [ 'class' => 'form-control', 'data-validation-required-message' => 'This field is required', 'placeholder' => 'Enter email']) !!}
                                    {!! $errors->first('email', '<label class="help-block text-danger">:message</label>') !!}
                                  </div>
                                  <div class="form-group">
                                    <label for="username">@lang('form.username')<span class="text-danger">*</span></label>
                                    {!! Form::text('username', null, [ 'class' => 'form-control', 'data-validation-required-message' => 'This field is required', 'placeholder' => 'Enter username']) !!}
                                    {!! $errors->first('username', '<label class="help-block text-danger">:message</label>') !!}
                                  </div>

                                    <div class="form-group">
                                    <label for="password">@lang('form.password')<span class="text-danger">*</span></label>

                                    {!! Form::password('password',[ 'class' => 'form-control', 'data-validation-required-message' => 'This field is required', 'placeholder' => 'Enter password' ]) !!}
                                    {!! $errors->first('password', '<label class="help-block text-danger">:message</label>') !!} <br>
                                  </div>
                                  <div class="form-group">
                                      <label for="image">Image</label> <br>

                                      {!! Form::file('image', null, ['class' => 'form-control', 'data-validation-required-message' => 'This field is required']); !!}


                                  </div>

                                </div>



                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-dark btn-block">Save</button>

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
<script type="text/javascript">
    $(document).ready(function() {
        $("#image").change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>

@endsection
