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
<!-- Custom js -->
<script>
   
    var translations = {
        "failed": "{{ __('Failed') }}",
        "success": "{{ __('Success') }}"
    }
</script>
<script src="{{ URL::asset('dashboard/js/support/loading.js') }}"></script>
<script src="{{ URL::asset('dashboard/js/support/save.js') }}"></script>
<script src="{{ URL::asset('dashboard/js/support/custom.js') }}"></script>
<script src="{{ URL::asset('dashboard/js/support/moment.min.js') }}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    });
    moment.locale('id');
</script>
@stack('js')
