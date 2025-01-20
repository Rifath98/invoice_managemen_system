@include('admin.layouts.main')
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Navbar -->
    @include('admin.layouts.navbar');

    <!-- Main Sidebar Container -->
    @include('admin.layouts.side-bar');

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('content')
    </div>
    <!-- Main Footer -->
    @include('admin.layouts.footer')
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
</div>

<!-- jQuery -->

<script src="{{asset('admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE -->
<script src="{{asset('admin/dist/js/adminlte.js')}}"></script>

<script src="{{asset('admin/plugins/select2/js/select2.full.min.js')}}"></script>
<!-- OPTIONAL SCRIPTS -->
<script src="{{asset('admin/plugins/chart.js/Chart.min.js')}}"></script>

<script src="{{asset('admin/dist/js/invoiceRow.js')}}"></script>
<script src="{{asset('admin/dist/js/invoiceSave.js')}}"></script>
<script src="{{asset('admin/dist/js/chart.js')}}"></script>
<script src="{{asset('admin/dist/js/customerName.js')}}"></script>
@if(Route::currentRouteName() === 'invoice.list')
    <script src="{{ asset('admin/dist/js/invoiceFilter.js') }}"></script>
@endif
<script>
    $(function () {
        $('.select2').select2()
    });
</script>
</body>
