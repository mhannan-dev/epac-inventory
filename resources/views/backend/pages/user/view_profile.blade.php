@extends('backend.layouts.master')
@section('content')
    <div class="content-wrapper" style="min-height: 1416.81px;">

    <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="offset-md-3 col-md-6 off-md-3">
                        <!-- Profile Image -->
                        <div class="card card-primary card-outline mt-2">
                                <div class="card-body box-profile">
                                    
                                    <h3 class="profile-username text-center">{{$user->name}}</h3>
                                    <p class="text-muted text-center">{{$user->user_role}}</p>
                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b>Email</b> <a class="float-right">{{$user->email}}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Address</b> <a class="float-right">{{$user->address}}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Gender</b> <a class="float-right">{{$user->gender}}</a>
                                        </li>

                                        <li class="list-group-item">
                                            <b>Mobile</b> <a class="float-right">{{$user->mobile}}</a>
                                        </li>
                                    </ul>
                                    <a href="{{ route('logged_in.user.profile.edit',$user->id )}}" class="btn btn-info btn-block">@lang('form.btn_edit')</a>
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
