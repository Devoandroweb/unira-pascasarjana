<style>
    .custom-hr {
        display: flex;
        align-items: center;
        text-align: center;
    }

    .custom-hr::before,
    .custom-hr::after {
        content: '';
        flex: 1;
        border-bottom: 1px solid #000;
    }

    .custom-hr:not(:empty)::before {
        margin-right: 0.25em;
    }

    .custom-hr:not(:empty)::after {
        margin-left: 0.25em;
    }

    /* Light theme */
    @media (prefers-color-scheme: light) {

        .custom-hr::before,
        .custom-hr::after {
            border-color: #000;

        }
    }

    /* Dark theme */
    @media (prefers-color-scheme: dark) {

        .custom-hr::before,
        .custom-hr::after {
            border-color: #000000;

        }

    }
</style>
<form action="{{ route('dashboard.settings.store') }}" method="post" id="display-settings-form"
    enctype="multipart/form-data">
    @csrf
    <div class="custom-hr mb-3">
        <h4>{{ Str::upper(__('Statistic')) }}</h4>
    </div>
    <div class="row mb-3">
        <label for="number_of_students" class="col-sm-2 col-form-label">{{ __('Number Of Students') }}</label>
        <div class="col-sm-8">
            <input class="form-control number" name="number_of_students" type="number"
                value="{{ settings()->get('number_of_students') }}" id="number_of_students" autocomplete="off">
        </div>
    </div>
    <div class="row mb-3">
        <label for="number_of_lecturers" class="col-sm-2 col-form-label">{{ __('Number Of Lecturers') }}</label>
        <div class="col-sm-8">
            <input class="form-control number" name="number_of_lecturers" type="number"
                value="{{ settings()->get('number_of_lecturers') }}" id="number_of_lecturers" autocomplete="off">
        </div>
    </div>
    <div class="row mb-3">
        <label for="number_of_alumni" class="col-sm-2 col-form-label">{{ __('Number Of Alumni') }}</label>
        <div class="col-sm-8">
            <input class="form-control number" name="number_of_alumni" type="number"
                value="{{ settings()->get('number_of_alumni') }}" id="number_of_alumni" autocomplete="off">
        </div>
    </div>
    <div class="row mb-3">
        <label for="number_of_study_program" class="col-sm-2 col-form-label">{{ __('Number Of Study Program') }}</label>
        <div class="col-sm-8">
            <input class="form-control number" name="number_of_study_program" type="number"
                value="{{ settings()->get('number_of_study_program') }}" id="number_of_study_program"
                autocomplete="off">
        </div>
    </div>
    <div class="custom-hr mb-3">
        <h4>{{ Str::upper(__('Other')) }}</h4>
    </div>
    <div class="row mb-3">
        <label for="number_of_study_program" class="col-sm-2 col-form-label">{{ __('Slider Type') }}</label>
        <div class="col-sm-8">
            <div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="slider_type" id="image" value="image"
                        {{ old('slider_type', settings()->get('slider_type')) == 'image' ? 'checked' : '' }}>
                    <label class="form-check-label" for="image">{{ __('Image') }}</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="slider_type" id="video" value="video"
                        {{ old('slider_type', settings()->get('slider_type')) == 'video' ? 'checked' : '' }}>
                    <label class="form-check-label" for="video">{{ __('Video') }}</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="slider_type" id="both" value="both"
                        {{ old('slider_type', settings()->get('slider_type')) == 'both' ? 'checked' : '' }}>
                    <label class="form-check-label" for="both">{{ __('Both') }}</label>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-sm-12">
            <button class="btn btn-sm btn-primary float-end" id="btn-submit-display">{{ __('Save') }}</button>
        </div>
    </div>
</form>
@push('js')
    <script>
        var formDisplay = $("#display-settings-form");
        $("#btn-submit-display").click(function(e) {
            e.preventDefault();
            saveFormNotForModal(formDisplay, formDisplay.attr('action'), $(this), "POST", false);
        })
    </script>
@endpush
