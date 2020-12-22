@extends('backend.layouts.master')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">


        <!-- Main content -->
        <section class="content mt-2">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row justify-content-center">
            <!-- left column -->
            <div class="col-md-10">

              <!-- Horizontal Form -->
              <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title">{{$title}}</h3>
                </div>
                <div class="card-body">

                                {!! Form::open([ 'route' => ['logged_in.user.profile.password_update', $user->id], 'id'=>'password_change_form', 'method' => 'post']) !!}
                                @csrf

                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="current_password">@lang('form.current_password_form_label')</label>
                                            <input type="password" name="current_password" class="form-control" id="current_password" placeholder="Enter current password">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="new_password">@lang('form.new_password_form_label')<span class="text-danger">*</span></label>
                                            <input type="password" name="new_password" class="form-control" id="new_password" placeholder="Enter new password">
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="again_new_password">@lang('form.again_new_password_form_label')<span class="text-danger">*</span></label>

                                            <input type="password" name="again_new_password" class="form-control" id="again_new_password" placeholder="Confirm new password">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-info btn-block">@lang('form.btn_update')</button>
                            {!! Form::close() !!}

                        </div>


              </div>
              <!-- /.card -->

            </div>
            <!--/.col (left) -->

          </div>

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>



@endsection
