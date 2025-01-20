<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{asset('admin/dist/img/logo.jpg')}}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Parizlab</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('admin/dist/img/man-user-svgrepo-com.png')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Test</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Invoice</p>
                            </a>
                        </li>
                    </ul>
                </li>-->
                <li class="nav-item ">
                    <a href="{{url('/')}}" class="nav-link {{ Request::routeIs('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <!--<span class="right badge badge-danger">New</span>-->
                        </p>
                    </a>
                </li>
                <!-- Sidebar for Invoice -->
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link {{ Request::routeIs('invoice.list','invoice.open') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Invoice
                            <!--<span class="right badge badge-danger">New</span>-->
                        </p>
                        <i class="right fas fa-angle-left"></i>
                    </a>
                    <ul class="nav nav-treeview ">
                        <li class="nav-item">
                            <a href="{{route('invoice.open')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Invoice Create</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview ">
                        <li class="nav-item">
                            <a href="{{route('invoice.list')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Invoice List</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Close Sidebar for Invoice -->

                <!-- Sidebar for Customers -->
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link sidebar-item {{ Request::routeIs('createCustomer','customers') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Customers
                            <!--<span class="right badge badge-danger">New</span>-->
                        </p>
                        <i class="right fas fa-angle-left"></i>
                    </a>
                    <ul class="nav nav-treeview ">
                        <li class="nav-item">
                            <a href="{{route('createCustomer')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Customers Create</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview ">
                        <li class="nav-item">
                            <a href="{{route('customers')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Customers List</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Close Sidebar for Customers -->

                <!-- Sidebar for Products -->
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link sidebar-item {{ Request::routeIs('product.view') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Products
                        </p>
                        <i class="right fas fa-angle-left"></i>
                    </a>
                    <ul class="nav nav-treeview ">
                        <li class="nav-item">
                            <a href="{{route('product.view')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Product Create</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview ">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Products List</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Close Sidebar for Products -->
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
