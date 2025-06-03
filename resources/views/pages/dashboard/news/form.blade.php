@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title mb-4">{{ $title }}</h3>
                    <form action="{{ $route }}" method="POST" id="news-form" enctype="multipart/form-data">
                        <div class="row mb-3">
                            <div class="col-sm-7 form-group">
                                <label for="title" class="col-sm-2 col-form-label">{{ __('Title') }}</label>
                                <input class="form-control" name="title" type="text"
                                    placeholder="{{ __('News Title') }}" id="title" value="{{ $news->title ?? '' }}">
                                <input type="hidden" name="id" value="{{ $news->id ?? '' }}">
                            </div>

                            <div class="col-sm-5 form-group">
                                <label for="image" class="col-sm-12 col-form-label">{{ __('Cover Image') }}</label>
                                <input class="form-control" name="image" type="file" id="image">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-12 form-group">
                                <label for="category_id" class="col-sm-12 col-form-label">{{ __('Category') }}</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    <option value="">{{ __('Select Category') }}</option>
                                    @foreach ($category as $item)
                                        <option value="{{ $item->id }}"
                                            {{ isset($news) && $news?->category_id == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-12 form-group">
                                <label for="tags" class="col-sm-12 col-form-label">{{ __('Tags') }} <small
                                        style="font-size: 10px"
                                        class="text-secondary">{{ __('Press Enter To Input Tags') }}</small></label>
                                <input class="form-control" name="tags" type="text" value="{{ $news->tags ?? '' }}"
                                    id="tags">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-12 form-group">
                                <textarea class="form-control ckeditor" name="content" id="content">{{ $news->content ?? '' }}</textarea>
                            </div>
                        </div>
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
@endsection
@push('js')
    <script>
        $("#btn-submit").click(function(e) {
            e.preventDefault();
            var form = $("#news-form");
            var method = "{{ isset($news) ? 'PUT' : 'POST' }}";
            console.log(method);

            saveFormNotForModal(form, form.attr("action"), $(this), method, true).then(response => {
                console.log(response);
                
                if (response.data.route) {
                    setTimeout(() => {
                        window.location.href = response.data.route;
                    }, 1000);
                }
            });
        });
    </script>
@endpush
