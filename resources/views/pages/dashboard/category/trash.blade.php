@extends('layouts.app', ['dt' => true])
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title mb-3">{{ $title }}</h3>

                    <div class="row mb-3">
                        <div class="col-12 text-end">
                            <a href="{{ route('dashboard.categories.index') }}"
                                class="btn btn-secondary btn-sm me-1">{{ __('Back') }}</a>
                            <form action="{{ route("dashboard.categories.restore") }}" method='POST' style='display:inline-block;' class="restore-form">
                                <input type="hidden" class="form-control" name="id" value="">
                                <button type="submit" id="btn-restore"
                                    class="btn btn-sm btn-primary me-1 restore" disabled>{{ __('Restore') }}</button>
                            </form>
                            <form action="{{ route("dashboard.categories.delete") }}" method='POST' style='display:inline-block;' class="delete-form">
                                <input type="hidden" class="form-control" name="id" value="">
                                <button type="submit" id="btn-delete"
                                    class="btn btn-sm btn-danger me-1 delete" disabled>{{ __('Delete') }}</button>
                            </form>
                        </div>

                    </div>
                    <table id="datatable" class="table table-striped dt-responsive nowrap w-100"></table>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    @widget('trash', ['dt' => true])
@endsection
@push('js')
    <script>
        var _URL = "{{ route('trash.categories') }}"
        var _COLUMNS = [{
                title: "<input type='checkbox' class='form-check-input' id='check-all' style='--bs-form-check-bg:#b3b3b3 !important' />",
                data: 'checkbox',
                orderable: false,
                searchable: false
            },
            {
                title: '{{ __('Name') }}',
                data: 'name',
                className: "text-capitalize"
            },
            {
                title: '{{ __('Action') }}',
                data: 'action',
            },
        ];
        var _DATATABLE = setDataTable(_URL, _COLUMNS);

        $("#check-all").change(function(e) {
            $(".checkbox").prop("checked", this.checked);
            $("#btn-restore,#btn-delete").prop("disabled", !this.checked);
            updateHiddenInput();
        })
        $(document).on('change', '.checkbox', function() {
            $("#check-all").prop("checked", $(".checkbox:checked").length === $(".checkbox").length);
            $("#btn-restore,#btn-delete").prop("disabled", !this.checked);
            updateHiddenInput();
        });

        function updateHiddenInput() {
            var selectedIds = [];
            $('.checkbox:checked').each(function() {
                selectedIds.push($(this).val());
            });
            $('input[name="id"]').val(selectedIds.join(','));
        }
    </script>
@endpush
