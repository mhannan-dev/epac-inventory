@php
    $prefix = Request::route()->getPrefix();
    $route = Route::current()->getName();
@endphp

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
        <img src="{{ URL::asset('backend')}}/epac_logo.jpg" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3"
             style="opacity:.8">

        <span class="brand-text font-weight-light">Epac Inventory</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ URL::asset('backend')}}/dist/img/avatar5.png" class="img-circle elevation-2"
                     alt="User Image">
            </div>
            <div class="info">
                <a href="{{route('dashboard')}}"
                   class="d-block">{{{ isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email }}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @if(Auth::user()->role_id == 1)
                    <li class="nav-item has-treeview {{($prefix=='/user')?'menu-open':''}}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Manage Users <i class="right fas fa-angle-left"></i>

                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('logged_in.user.view')}}"
                                   class="nav-link {{($route=='logged_in.user.view')?'active':''}}">
                                    <i class="far fa-list-alt"></i>
                                    <p>Users</p>
                                </a>
                            </li>

                        </ul>
                    </li>

                    @endif

                    <li class="nav-item has-treeview {{($prefix=='/suppliers')?'menu-open':''}}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-tools"></i>
                            <p>
                                Manage Supplier <i class="right fas fa-angle-left"></i>

                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('admin.suppliers.view')}}"
                                   class="nav-link {{($route=='admin.suppliers.view')?'active':''}}">
                                    <i class="far fa-list-alt"></i>
                                    <p>Suppliers</p>
                                </a>
                            </li>

                        </ul>
                    </li>





                    <li class="nav-item has-treeview {{($prefix=='/units')?'menu-open':''}}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-toolbox"></i>
                            <p>
                                Manage Units <i class="right fas fa-angle-left"></i>

                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('admin.units.view')}}"
                                   class="nav-link {{($route=='admin.units.view')?'active':''}}">
                                    <i class="far fa-list-alt"></i>
                                    <p>Units</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <li class="nav-item has-treeview {{($prefix=='/products')?'menu-open':''}}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-toolbox"></i>
                            <p>
                                General  Product <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('admin.products.view')}}"
                                   class="nav-link {{($route=='admin.products.view')?'active':''}}">
                                    <i class="far fa-list-alt"></i>
                                    <p>Lists</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <li class="nav-item has-treeview {{($prefix=='/purchase')?'menu-open':''}}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-toolbox"></i>
                            <p>
                               Inventory<i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('admin.purchase.view')}}"
                                   class="nav-link {{($route=='admin.purchase.view')?'active':''}}">
                                    <i class="far fa-list-alt"></i>
                                    <p>Inventory  Product</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{route('purchase.pending.list')}}"
                                   class="nav-link {{($route=='purchase.pending.list')?'active':''}}">
                                    <i class="far fa-list-alt"></i>
                                    <p>Approve Product</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('invoice.daily.search')}}"
                                   class="nav-link {{($route=='invoice.daily.search')?'active':''}}">
                                    <i class="far fa-list-alt"></i>
                                    <p>Create Bill</p>
                                </a>

                    </li>

                    {{-- <li class="nav-item has-treeview {{($prefix=='/invoice')?'menu-open':''}}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-toolbox"></i>
                            <p>
                                Bill <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('invoice.daily.search')}}"
                                   class="nav-link {{($route=='invoice.daily.search')?'active':''}}">
                                    <i class="far fa-list-alt"></i>
                                    <p>Create Bill</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('invoice.view')}}"
                                   class="nav-link {{($route=='invoice.view')?'active':''}}">
                                    <i class="far fa-list-alt"></i>
                                    <p>All </p>
                                </a>
                            </li>
                        </ul>
                    </li> --}}

                    <li class="nav-item has-treeview {{($prefix=='/stock')?'menu-open':''}}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-toolbox"></i>
                            <p>
                                Manage Stock <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('stock.report')}}"
                                   class="nav-link {{($route=='stock.report')?'active':''}}">
                                    <i class="far fa-list-alt"></i>
                                    <p>Stock Report</p>
                                </a>

                            </li>
                        </ul>
                    </li>




                <li class="nav-item has-treeview {{($prefix=='/profile')?'menu-open':''}}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tools"></i>
                        <p>
                            Manage Profile <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('logged_in.user.profile.view')}}"
                               class="nav-link {{($route=='logged_in.user.profile.view')?'active':''}}">
                                <i class="far fa-list-alt"></i>
                                <p>Profile</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('logged_in.user.profile.password_view')}}"
                               class="nav-link {{($route=='logged_in.user.profile.password_view')?'active':''}}">
                                <i class="far fa-list-alt"></i>
                                <p>Change Password</p>

                            </a>
                        </li>


                    </ul>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                            <i class="nav-icon fa fa-power-off red"></i>
                            <p>
                                {{ __('Logout') }}
                            </p>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </li>


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
