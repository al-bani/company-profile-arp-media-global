<!DOCTYPE html>
<html lang="en">
<head>
    <x-header />
</head>
<body id="page-top">
    @yield('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/dashboardHome.js') }}"></script>
    <script src="{{ asset('css/login.css') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <x-sidebar />

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column" style="min-height: 100vh;">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <x-topbar />

                <!-- Page Content -->
                <div class="container-fluid">
                    {{ $slot }}
                </div>

            </div>

            <!-- Footer -->
            <x-footer />

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    @stack('script')

</body>
</html>
