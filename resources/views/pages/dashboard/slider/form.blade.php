<form action="{{ route('dashboard.sliders.store') }}" method="post" id="slider-form">
    @csrf
    <input type="hidden" name="id" value="">
    <div class="row">
        <div class="col-md-12">
            <div class="mb-3">
                <label for="title" class="form-label">{{ __('Title') }}</label>
                <input type="text" class="form-control" id="title" name="title"
                    placeholder="{{ __('Example') }} : {{ __('Slider 1') }}" autocomplete="off">
            </div>
        </div>

        <div class="col-md-12">
            <div class="mb-3">
                <label for="type" class="form-label">{{ __('Slider Type') }}</label>
                <select name="type" id="type" class="form-control">
                    <option value="">{{ __('Please Select') }}</option>
                    @foreach (config('enum.slider_type') as $item)
                        <option value="{{ $item }}">{{ __(Str::ucfirst($item)) }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-12 d-none" id="input-file">
            <div class="mb-3">
                <label for="file" class="form-label">{{ __('Files') }}</label>
                <input type="file" class="form-control" id="file" name="file"
                    placeholder="{{ __('Example') }} : {{ __('Slider 1') }}" autocomplete="off">
            </div>
        </div>
        <div class="col-md-12 d-none" id="input-url">
            <div class="mb-3">
                <label for="url" class="form-label">{{ __('URL') }}</label>
                <input type="url" class="form-control" id="url" name="url"
                    placeholder="{{ __('Example') }} : {{ __('https://www.youtube.com/embed/tgbNymZ7vqY?autoplay=1&mute=1&controls=0&modestbranding=0&showinfo=0') }}"
                    autocomplete="off">
            </div>
        </div>
    </div>
    <div class="row d-none" id="video">
        <div class="col-md-12">
            <div class="mb-3">
                <iframe class="no-pointer-events" src="" frameborder="0" id="video-preview" width="450px"
                    height="380" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture">
                </iframe>
            </div>
        </div>
    </div>
    <div class="row d-none" id="image">
        <div class="col-md-12">
            <div class="mb-3">
                <img id="image-preview" src="" alt="Image Preview"
                    style="width: 100%; max-height: 400px; object-fit: cover;">
            </div>
        </div>
    </div>
</form>
@push('js')
    <script>
        $(document).ready(function() {
            $("select[name=type]").change(function() {
                var isImage = $(this).val() === 'image';
                $("#input-file").toggleClass("d-none", !isImage);
                $("#input-url").toggleClass("d-none", isImage);
            });
            
        });
    </script>
@endpush
