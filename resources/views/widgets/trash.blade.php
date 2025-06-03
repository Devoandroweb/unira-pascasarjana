@push('js')
    <script>
        // Restore
        $(document).on('submit', '.restore-form', function(e) {
            e.preventDefault();
            var htmlThis = $(this).find('.restore');
            var htmlDef = htmlThis.html();
            var form = $(this);

            htmlThis.addClass('disabled');
            htmlThis.toggleClass('d-flex align-items-center')
            htmlThis.html(buildLoading("15px", "15px"))
            $.ajax({
                type: "POST",
                url: form.attr("action"),
                data: form.serialize(),
                dataType: "JSON",
                success: function(response) {
                    if (@json(isset($dt) ? $dt : false)) {
                        _DATATABLE.ajax.reload()
                    }
                    if (response.status) {
                        iziToast.success({
                            title: '{{ __("Success") }}',
                            message: response.data.message,
                            position: 'bottomCenter'
                        });
                        $("#btn-submit").removeAttr("disabled")
                        $(".invalid").remove();
                        $("input,select").removeClass("is-invalid")
                        $("input,select").siblings("small.text-danger").remove();
                        $("input,select").siblings("small.text-danger").remove();
                        $("#check-all").prop("checked", false);
                        htmlThis.removeClass("disabled");
                        htmlThis.toggleClass('d-flex align-items-center')
                        htmlThis.html(htmlDef)
                    }
                }
            });
        });

        // Delete
        $(document).on('submit', '.delete-form', function(e) {
            e.preventDefault();
            Swal.fire({
                title: "{{ __('Are You Sure?') }}",
                text: "{{ __('Your Data Will Be Lost Forever') }}",
                icon: "warning",
                showClass: {
                    popup: 'animate__animated animate__zoomIn animate__faster'
                },
                hideClass: {
                    popup: 'animate__animated animate__zoomOut animate__faster'
                },
                showCancelButton: true,
                confirmButtonColor: "#0F4142",
                cancelButtonColor: "#da5643",
                confirmButtonText: "{{ __('Yes') }}",
                cancelButtonText: "{{ __('No') }}"
            }).then((result) => {
                if (result.isConfirmed) {
                    var callback = null;
                    var form = $(".delete-form")
                    deleteData(form);
                    return;
                }
            });
        });

        function deleteData(form) {
            var htmlThis = form.find('.delete');
            var htmlDef = htmlThis.html();

            htmlThis.addClass('disabled');
            htmlThis.toggleClass('d-flex align-items-center')
            htmlThis.html(buildLoading("15px", "15px"))
            $.ajax({
                type: "DELETE",
                url: form.attr("action"),
                data: form.serialize(),
                dataType: "JSON",
                success: function(response) {

                    if (@json(isset($dt) ? $dt : false)) {
                        _DATATABLE.ajax.reload()
                    }
                    if (response.status) {
                        iziToast.success({
                            title: '{{ __("Success") }}',
                            message: response.data.message,
                            position: 'bottomCenter'
                        });
                        $("#btn-submit").removeAttr("disabled")
                        $(".invalid").remove();
                        $("input,select").removeClass("is-invalid")
                        $("input,select").siblings("small.text-danger").remove();
                        $("input,select").siblings("small.text-danger").remove();
                        $("#check-all").prop("checked", false);
                        htmlThis.removeClass("disabled");
                        htmlThis.toggleClass('d-flex align-items-center')
                        htmlThis.html(htmlDef)
                    }
                }
            });
        }
    </script>
@endpush
