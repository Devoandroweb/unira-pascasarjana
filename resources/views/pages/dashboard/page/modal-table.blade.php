<!-- Modal Body -->
<!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
<style>
    table th {
        text-transform: uppercase;
    }

    table td,
    table th,
    table tr {
        border: 1px solid rgba(155, 155, 155, 0.548);
    }
</style>
<div class="modal fade" id="modalTable" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
    aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">
                    {{ __("Table") }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-6">
                        <div class="input-group">
                            <div class="input-group-text bg-primary text-white">{{ __("Rows") }}</div>
                            <input type="number" class="form-control" name="rows" id="rows" value="2"
                                min="2">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="input-group">
                            <div class="input-group-text bg-primary text-white">{{ __("Columns") }}</div>
                            <input type="number" class="form-control" name="columns" id="columns" value="2"
                                min="2">
                        </div>
                    </div>
                </div>
                <div class="card card-body border border-secondary-subtle">
                    <h6>{{ __("Table Contents") }}</h6>
                    <div class="row">
                        <div class="col">
                            <div class="table-responsive">
                                @if($page?->table)
                                <table class="table table-editable table-bordered table-sm table-hover table-nowrap align-middle table-edits">
                                    {!! $page->table !!}
                                </table>
                                @else
                                <table class="table table-editable table-bordered table-sm table-hover table-nowrap align-middle table-edits">
                                    <thead>
                                        <tr data-id="0">
                                            <td class="fw-bold" data-field="id" style="width: 80px">{{ "#" }}</th>
                                            <td class="fw-bold" data-field="name">{{ __("Name") }}</tf>
                                            <td class="fw-bold" style="width: 100px">
                                                <a class="btn btn-outline-secondary btn-sm edit" title="Edit">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr data-id="1">
                                            <td data-field="id" style="width: 80px">1</td>
                                            <td data-field="columns"></td>
                                            <td style="width: 100px">
                                                <a class="btn btn-outline-secondary btn-sm edit" title="Edit">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    {{ __("Close") }}
                </button>
                <button type="button" class="btn btn-primary btn-save-table">{{ __("Save") }}</button>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script src="{{ URL::asset('dashboard/libs/table-edits/build/table-edits.min.js') }}"></script>

    <script>
        // const modalTable = document.getElementById('modalTable')
        let modalTable = new bootstrap.Modal('#modalTable')

        $("#open-modal-table").click(function (e) {
            e.preventDefault();

        });
        $(".btn-save-table").click(function (e) {
            e.preventDefault();
            $table = $("#modalTable").find("table").html();
            $("#tableCustom").html(`<table class="table table-border w-100 mt-3">${$table}</table>`)
            $("#tableCustom").append(`<textarea name="table" class="d-none">${$table}</textarea>`)
            $("#tableCustom").find('table tr').each(function() {
                $(this).find('td').eq(-1).hide();
            });
            modalTable.hide()
            $("#delete-table").remove()
            $("#open-modal-table").html(`<i class="fas fa-pencil-alt"></i> Edit`)
            $("#open-modal-table").after(`<button id="delete-table" type="button" class="btn btn-danger btn-sm ms-2"><i class="fas fa-table"></i> Hapus</button>`)
        });
        $(document).on("click","#delete-table",function (e) {
            e.preventDefault();
            $("#tableCustom").empty();
            $(this).remove()
            $("#open-modal-table").html(`<i class="fas fa-table"></i> Buka`)
        });
        var no = 1;
        $(function() {
            var pickers = {};
            initEditable()
            checkRowSave()
            let previousRowsValue = parseInt($('[name=rows]').val());
            let previousColumnsValue = parseInt($('[name=columns]').val());
            $('[name=rows]').on('change', function() {
                let currentRowsValue = parseInt($(this).val());

                if (currentRowsValue === previousRowsValue + 1) {
                    // console.log("Nilai bertambah dari " + previousRowsValue + " ke " + currentRowsValue);
                    no++;
                    appendRow(no);
                } else if (currentRowsValue === previousRowsValue - 1) {
                    // console.log("Nilai berkurang dari " + previousRowsValue + " ke " + currentRowsValue);
                    no--;
                    removeRow();
                } else {
                    no = 1;
                    $('.table-edits tr').not(':eq(0), :eq(1)').remove();
                    for (let index = 1; index < currentRowsValue; index++) {
                        no++;
                        appendRow(no);
                    }
                    console.log("Nilai berubah dari " + previousRowsValue + " ke " + currentRowsValue);
                }
                // Update previousRowsValue untuk digunakan pada perubahan berikutnya
                previousRowsValue = currentRowsValue;
            });
            $('[name=columns]').on('change', function() {
                let currentColumnsValue = parseInt($(this).val());

                if (currentColumnsValue === previousColumnsValue + 1) {

                    appendColumns()
                } else if (currentColumnsValue === previousColumnsValue - 1) {
                    removeColumns()
                } else {
                    $('.table-edits tr').each(function() {
                        let $tds = $(this).find('td');
                        let totalTd = $tds.length;

                        $tds.each(function(index) {
                            if (index !== 0 && index !== 1 && index !== totalTd - 1) {
                                $(this).remove();
                            }
                        });
                    });
                    for (let index = 1; index < currentColumnsValue - 1; index++) {
                        appendColumns()
                    }
                }
                // Update previousColumnsValue untuk digunakan pada perubahan berikutnya
                previousColumnsValue = currentColumnsValue;
            });

            function appendRow(no) {
                let clonedRow = $('.table-edits tr').eq(1).clone();
                $(clonedRow).attr("data-id", no);
                $(clonedRow).find('td').eq(0).text(no);
                $(clonedRow).find('input').remove();
                $(".edit i", clonedRow)
                            .removeClass('fa-save')
                            .addClass('fa-pencil-alt')
                            .attr('title', 'Edit');
                $('.table-edits tbody').append(clonedRow)
                initEditable()
            }

            function appendColumns() {
                $('.table-edits tr').each(function() {
                    $(this).find('td').eq(-1).before(`<td data-field="columns"></td>`);
                });
                initEditable()
            }

            function removeColumns() {
                $('.table-edits tr').each(function() {
                    $(this).find('td').eq(-2).remove();
                });
            }

            function removeRow() {
                $('.table-edits tr:last').remove();
            }

            function initEditable() {
                $('.table-edits tr:first').addClass('fw-bold');
                $('.table-edits tr').editable({
                    edit: function(values) {
                        $(".edit i", this)
                            .removeClass('fa-pencil-alt')
                            .addClass('fa-save')
                            .attr('title', 'Save');
                        checkRowSave()
                    },
                    save: function(values) {
                        $(".edit i", this)
                            .removeClass('fa-save')
                            .addClass('fa-pencil-alt')
                            .attr('title', 'Edit');
                        checkRowSave()

                        if (this in pickers) {
                            pickers[this].destroy();
                            delete pickers[this];
                        }
                    },
                    cancel: function(values) {
                        $(".edit i", this)
                            .removeClass('fa-save')
                            .addClass('fa-pencil-alt')
                            .attr('title', 'Edit');
                        checkRowSave()

                        if (this in pickers) {
                            pickers[this].destroy();
                            delete pickers[this];
                        }
                    }
                });
            }
        });
        function checkRowSave(){
            var save = $(".table-edits").find(`[title="Save"]`);
            console.log(save.length);

            if(save.length==0){
                $(".btn-save-table").prop("disabled",false)
            }else{
                $(".btn-save-table").prop("disabled",true)
            }
        }
    </script>
@endpush
<!-- Optional: Place to the bottom of scripts -->
