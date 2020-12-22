@extends('backend.layouts.master')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard v1</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">

                                <h3 class="card-title">{{$title}} List</h3>

                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <a href="{{ route('admin.brand.create') }}" class="btn btn-info btn-sm">
                                            <i class="fa fa-plus"></i> Add {{$title}}

                                        </a>

                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0" style="height: 300px;">
                                <table class="table table-head-fixed text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Code</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @if(count($all_brands))
                                        @foreach ($all_brands as $key => $list)

                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $list->name }}</td>
                                                <td>{{ $list->code }}</td>
                                                @php
                                                    $count_brand = App\Models\Product::where('brand_id',$list->id)->count();
                                                @endphp
                                                  {{--  @dd($count_brand);--}}
                                                <td>

                                                    @if($list->status =="active")
                                                        <span class="badge badge-success">Active</span>
                                                    @else
                                                        <span class="badge badge-warning">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($list->created_at)->diffForHumans() }}</td>
                                                <td>

                                                    <a class="badge badge-warning" href="{{route('admin.brand.edit',$list->id)}}"><i
                                                            class="fas fa-edit"></i></a>
                                                    @if($count_brand < 1)
                                                    <a href="#deleteModal{{ $list->id }}" data-toggle="modal"
                                                       class="badge badge-danger">
                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                    </a>
                                                    @endif
                                                    <!-- Delete Modal -->
                                                    <div class="modal fade" id="deleteModal{{ $list->id }}"
                                                         tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                         aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Are
                                                                        sure to delete?</h5>
                                                                    <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form
                                                                        action="{!! route('admin.brand.delete', $list->id) !!}"
                                                                        method="post">
                                                                        {{ csrf_field() }}
                                                                        <button type="submit" class="btn btn-danger">
                                                                            Permanent Delete
                                                                        </button>
                                                                    </form>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Cancel
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Delete Modal -->

                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5"> Opps!!, {{$title}} Not found</td>
                                        </tr>
                                    @endif


                                    </tbody>
                                </table>

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>



@endsection
