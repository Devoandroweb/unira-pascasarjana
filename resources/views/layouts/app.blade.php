    
    @include('partials.dashboard.head')
    <body data-sidebar="colored">
    <!-- Begin page -->
    <div id="layout-wrapper">
            <!-- navbar -->
            @include('partials.dashboard.navbar')

            <!-- sidebar components -->
            @include('partials.dashboard.sidebar')
            <div class="main-content">
                <div class="page-content">
                    <!-- container-fluid -->
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                </div>
                <!-- End Page-content -->
                <!-- footer -->
                @include('partials.dashboard.footer')
            </div>
            <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->
    <!-- JS -->
</body>


</html>
