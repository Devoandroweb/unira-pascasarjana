<!-- JAVASCRIPT -->
<script src="{{ URL::asset('dashboard/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ URL::asset('dashboard/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ URL::asset('dashboard/libs/metismenu/metisMenu.min.js') }}"></script>
<script src="{{ URL::asset('dashboard/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ URL::asset('dashboard/libs/node-waves/waves.min.js') }}"></script>
<!-- Icon -->
<script src="https://unicons.iconscout.com/release/v2.0.1/script/monochrome/bundle.js"></script>
<!-- App js -->
<script src="{{ asset('dashboard/js/app.js') }}"></script>
<script src="{{ URL::asset('dashboard/libs/iziToast/iziToast.min.js') }}"></script>
<!-- Sweet Alerts js -->
<script src="{{ URL::asset('dashboard/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- apexcharts -->
<script src="{{ URL::asset('dashboard/libs/apexcharts/apexcharts.min.js') }}"></script>
<!-- Vector map-->
<script src="{{ URL::asset('dashboard/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
<script src="{{ URL::asset('dashboard/libs/jsvectormap/maps/world-merc.js') }}"></script>
{{-- <script src="{{ URL::asset('js/pages/dashboard.init.js') }}"></script> --}}
<!-- Custom js -->
@vite('resources/js/app.js')
<script>
   
    var translations = {
        "failed": "{{ __('Failed') }}",
        "success": "{{ __('Success') }}"
    }
</script>
<script src="{{ URL::asset('dashboard/js/support/loading.js') }}"></script>
<script src="{{ URL::asset('dashboard/js/support/save.js') }}"></script>
<script src="{{ URL::asset('dashboard/js/support/custom.js') }}"></script>
<script src="{{ URL::asset('dashboard/js/support/delete.js') }}"></script>
<script src="{{ URL::asset('dashboard/js/support/moment.min.js') }}"></script>
<script src="{{ URL::asset('dashboard/js/support/mask-input.min.js') }}"></script>



<!-- DATATABLE -->
@if (isset($dt))
    <!-- Required datatable js -->
    <script src="{{ URL::asset('dashboard/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('dashboard/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Buttons examples -->
    <script src="{{ URL::asset('dashboard/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('dashboard/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('dashboard/libs/jszip/jszip.min.js') }}"></script>

    <script src="{{ URL::asset('dashboard/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('dashboard/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('dashboard/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>

    <script src="{{ URL::asset('dashboard/libs/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ URL::asset('dashboard/libs/datatables.net-select/js/dataTables.select.min.js') }}"></script>

    <!-- Responsive examples -->
    <script src="{{ URL::asset('dashboard/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('dashboard/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
    @widget('datatable')
@endif
<!-- App js -->

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    });
    $("#logout").click(function(e) {
        e.preventDefault();
        var href = $(this).attr("href");
        Swal.fire({
            title: "{{ __('Are You Sure?') }}",
            text: "{{ __('You Will End This Session') }}",
            icon: "warning",
            showClass: {
                popup: `animate__animated
                        animate__zoomIn
                        animate__faster`
            },
            hideClass: {
                popup: `animate__animated
                        animate__zoomOut
                        animate__faster`
            },
            showCancelButton: true,
            confirmButtonColor: "#0F4142",
            cancelButtonColor: "#da5643",
            confirmButtonText: "{{ __('Yes') }}",
            cancelButtonText: "{{ __('No') }}"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = href;
            }
        });
    });

    $(document).on("keydown", "input", function(event) {
        if (event.key === "Enter") {
            event.preventDefault();
        }
    });
    $(".number").on("input", function(e) {
                var value = parseInt($(this).val());
                if (value < 0) {
                    $(this).val(0);
                }
            });
</script>

@stack('js')
