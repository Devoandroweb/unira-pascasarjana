@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title mb-4">{{ $title }}</h3>
                    <form action="{{ $route }}" method="POST" id="page-form" enctype="multipart/form-data">
                        <div class="row mb-3">
                            <div class="col-sm-7 form-group">
                                <label for="title" class="col-sm-2 col-form-label">{{ __('Title') }}</label>
                                <input class="form-control" name="title" type="text"
                                    placeholder="{{ __('Page Title') }}" id="title"
                                    value="{{ $page ? __($page->title) : '' }}">
                                <input type="hidden" name="id" value="{{ $page->id ?? '' }}">
                            </div>

                            <div class="col-sm-5 form-group">
                                <label for="cover_image" class="col-sm-12 col-form-label">{{ __('Image') }}</label>
                                <input class="form-control" name="image" type="file" id="image">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-12 form-group">
                                <label for="vidio" class="col-sm-12 col-form-label">{{ __('URL Vidio') }}</label>
                                <input class="form-control" name="vidio" type="text" id="vidio">
                                <span class="text-muted">{{ __('YouTube Recommended') }}</span>
                                <span class="text-muted">{{ __('Example') }} :
                                    https://www.youtube.com/embed/LhweFdoJD3g</span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-12 form-group">
                                <label for="category_id" class="col-sm-12 col-form-label">{{ __('Category') }}</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    <option value="">{{ '--' . __('No Category') . '--' }}</option>
                                    @foreach ($pageCategory as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $page?->category_id == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-12 form-group">
                                <textarea class="form-control ckeditor" name="content" id="content">{{ $page->content ?? '' }}</textarea>
                            </div>
                        </div>
                        {{-- table --}}
                        <div class="card border border-secondary-subtle card-body">
                            <div class="row">
                                <div class="col-12 col-sm-6 d-flex align-items-center">
                                    <b>{{ __('Add Table') }}</b>
                                </div>
                                <div class="col-12 col-sm-6 text-end">
                                    @if ($page?->table)
                                        <button id="open-modal-table" type="button" class="btn btn-primary btn-sm"
                                            data-bs-toggle="modal" data-bs-target="#modalTable"><i
                                                class="fas fa-pencil-alt"></i> {{ __('Edit') }}</button>
                                        <button id="delete-table" type="button" class="btn btn-danger btn-sm ms-2"><i
                                                class="fas fa-table"></i>{{ __('Delete') }}</button>
                                    @else
                                        <button id="open-modal-table" type="button" class="btn btn-primary btn-sm"
                                            data-bs-toggle="modal" data-bs-target="#modalTable"><i
                                                class="fas fa-table me-1"></i>{{ __('Open') }}</button>
                                    @endif
                                </div>
                            </div>
                            {{-- target table --}}
                            <div id="tableCustom">
                                @if ($page?->table)
                                    <table
                                        class="table table-editable table-bordered table-sm table-hover table-nowrap align-middle table-edits mt-3">
                                        {!! $page->table !!}
                                    </table>
                                @endif
                            </div>
                        </div>
                        {{-- end table --}}
                        <input id="page_files" type="file" name="files[]" class="file-pond-multiple"
                            data-allow-reorder="true" multiple>
                        <div class="row">
                            <div class="col-sm-3">
                                <button class="btn btn-sm btn-primary" id="btn-submit"><i
                                        class="mdi mdi-content-save me-1"></i>{{ __('Save') }}</button>
                            </div>
                        </div>

                    </form>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    @include('pages.dashboard.page.modal-table')
@endsection
@push('js')
    <script>
        $("#tableCustom").find('table tr').each(function() {
            $(this).find('td').eq(-1).remove();
        });
        $("#btn-submit").click(function(e) {
            e.preventDefault();
            var form = $("#page-form");
            var method = "{{ isset($page) ? 'PUT' : 'POST' }}";

            saveFormNotForModal(form, form.attr("action"), $(this), method, true).then(response => {
                if (response.data.type != 'static') {
                    setTimeout(() => {
                        window.location.href = response.data.route;
                    }, 1000);
                }
            });
        });
        $(document).ready(function() {
            var filesArray = @json($files); // Pastikan $files adalah array berisi data file
            var iterationFiles = 0;

            // Set options untuk FilePond
            window[`pond_multiple_page_files`].setOptions({
                acceptedFileTypes: ['application/pdf'],
                fileValidateTypeLabelExpectedTypesMap: {
                    'application/pdf': 'pdf'
                },
                labelFileTypeNotAllowed: 'Hanya file PDF yang diizinkan.',
                fileValidateTypeDetectType: (source, type) => new Promise((resolve, reject) => {
                    resolve(type);
                })
            });

            // Event listener saat file ditambahkan
            window[`pond_multiple_page_files`].on('addfile', (error, file) => {
                if (error) {
                    console.error('Error adding file:', error);
                    return;
                }

                // Ambil nama file dari filesArray jika tersedia
                var filesName = "";
                if (typeof filesArray[iterationFiles] !== 'undefined') {
                    filesName = filesArray[iterationFiles].file_name;
                }

                // Tambahkan input field untuk memasukkan nama file
                $("#filepond--item-" + file.id + " .filepond--file").append(`
            <input type="text" class="form-control form-control-sm files-name py-0 w-50" 
            name="file_name[]" style="font-size:10pt" 
            value="${filesName}" placeholder="Masukkan Nama File ...">
        `);

                // Tingkatkan iterationFiles untuk file berikutnya
                iterationFiles++;
            });

            // Loop untuk menambahkan file dari filesArray ke FilePond
            for (let i = 0; i < filesArray.length; i++) {
                var fileUrl = `{{ url('storage') }}/` + filesArray[i].path_file;

                // Ambil file menggunakan fetch
                fetch(fileUrl)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.blob();
                    })
                    .then(blob => {
                        // Buat instance file baru
                        const file = new File([blob], filesArray[i].path_file, {
                            type: blob.type,
                            size: blob.size
                        });

                        // Tambahkan file ke FilePond
                        window[`pond_multiple_page_files`].addFile(file).then(fileItem => {
                            console.log('File added:', fileItem);
                        }).catch(error => {
                            console.error('Error adding file:', error);
                        });
                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                    });
            }
        });
    </script>
@endpush
