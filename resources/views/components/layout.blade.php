<!DOCTYPE html>
<html lang="en">
<head>
    <x-header />
</head>
<body id="page-top">

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
