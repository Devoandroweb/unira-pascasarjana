<!-- Layout config Js -->
<script src="{{ URL::asset('dashboard/js/layout.js') }}"></script>
<!-- Bootstrap Css -->
<link href="{{ URL::asset('dashboard/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="{{ URL::asset('dashboard/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="{{ URL::asset('dashboard/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

<!-- IziToast-->
<link href="{{ URL::asset('dashboard/libs/iziToast/iziToast.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<!-- Sweet Alert-->
<link href="{{ URL::asset('dashboard/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@if (isset($dt))
<!-- DataTables -->
<link href="{{ URL::asset('dashboard/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
    type="text/css" />
<link href="{{ URL::asset('dashboard/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}"
    rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('dashboard/libs/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}"
    rel="stylesheet" type="text/css" />

<!-- Responsive datatable examples -->
<link href="{{ URL::asset('dashboard/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"rel="stylesheet" type="text/css" />
@endif
<style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type=number] {
        -moz-appearance: textfield;
    }
    .ck-editor__editable {
        min-height: 300px;
    }
</style>
