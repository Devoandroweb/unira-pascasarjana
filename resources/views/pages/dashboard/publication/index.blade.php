@extends('layouts.app', ['dt'=> true])
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title mb-3">{{ $title }}</h3>

                <div class="row mb-3">
                    <div class="col-12 text-end">
                        <a href="" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#modalForm">{{ __('Add') }}</a>
                        <a href="{{ route('dashboard.publications.trash') }}" class="btn btn-danger btn-sm">{{ __('Trash') }}</a>
                    </div>

                </div>
                <table id="datatable" class="table table-striped dt-responsive nowrap w-100"></table>
               
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
@widget('modal', ['title' => __($title), 'form' => 'pages.dashboard.publication.form', 'data' => [], 'type' => 'modal-xl'])
@widget('delete',['dt'=> true])
@endsection
@push('js')
    <script>
        var _URL = "{{ route('datatable.publications') }}"
        var _COLUMNS = [{
                title: '#',
                data: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            {
                title: '{{ __('Title') }}',
                data: 'title',
                className: "text-capitalize"
            },
            {
                title: '{{ __('Author') }}',
                data: 'author',
                className: "text-capitalize"
            },
            {
                title: '{{ __('Category') }}',
                data: 'category',
                className: "text-capitalize"
            },
            {
                title: '{{ __('Published At') }}',
                data: 'published',
                className: "text-capitalize"
            },
            {
                title: '{{ __('Action') }}',
                data: 'action',
            },
        ];

        var _DATATABLE = setDataTable(_URL, _COLUMNS);

        $("#btn-submit").click(function(e) {
            e.preventDefault();
            var form = $("#publication-form");
            saveForm(form, form.attr('action'), $('#modalForm'), 'POST',true);
        })
        $("[name=category]").change(function (e) { 
            e.preventDefault();
            var value = $(this).val()
            if(value=="ejournal"){
                $("#author_col").hide();
                $("#published_at_col").hide();
                $("#coverdesc").show();
            }else{
                $("#author_col").show();
                $("#published_at_col").show();
                $("#coverdesc").hide();
            }
        });
        $("#modalForm").on("reset", function() {
            setTimeout(function() {
                // Trigger the change event after reset to ensure category change logic is applied
                $("[name=category]").trigger('change');
            }, 0);  // Use timeout to ensure reset is fully applied before running the change event
        });
        function attactEdit(modal, response) {
            modal.find("input[name=id]").val(response.data.id);
            modal.find("input[name=title]").val(response.data?.title);          
            modal.find("input[name=published_at]").val(response.data?.published_at);          
            modal.find("input[name=author]").val(response.data?.author);          
            modal.find("input[name=link]").val(response.data?.link);          
            modal.find("select[name=category]").val(response.data?.category);    
            var value = modal.find("select[name=category]").val();
            if(value=="ejournal"){
                modal.find("input[name=no_issn]").val(response.data?.no_issn);
                modal.find("textarea[name=description]").val(response.data?.description);
                $("#author_col").hide();
                $("#published_at_col").hide();
                $("#coverdesc").show();
            }else{
                $("#author_col").show();
                $("#published_at_col").show();
                $("#coverdesc").hide();
            }      
        }
    </script>
@endpush
