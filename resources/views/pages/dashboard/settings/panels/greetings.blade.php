<form action="{{ route('dashboard.settings.store') }}" method="post" id="greeting-settings-form"
    enctype="multipart/form-data">
    @csrf
    <div class="row mb-3">
        <label for="greeting_photo" class="col-sm-2 col-form-label">{{ __("Greeting's Photo") }}</label>
        <div class="col-sm-6">
            <input class="form-control file-pond-single" name="greeting_photo" type="file" id="greeting_photo">
        </div>
        <div class="col-sm-4">
            <img src="{{ Storage::url(settings()->get('greeting_photo')) ?? '' }}" alt="" id="greeting-image"
                class="img-thumbnail" width="100px">
        </div>
    </div>
    <div class="row mb-3">
        <label for="greeting_photo" class="col-sm-2 col-form-label">{{ __('Greeting') }}</label>
        <div class="col-sm-10 form-group">
            <textarea class="form-control ckeditor" name="greeting" id="greeting">{{ settings()->get('greeting') ?? '' }}</textarea>
        </div>
    </div>
</form>
<div class="row mb-3">
    <div class="col-sm-12">
        <button class="btn btn-sm btn-primary float-end" id="btn-submit-greeting">{{ __('Save') }}</button>
    </div>
</div>
</form>
@push('js')
<script>
    var formGreeting = $("#greeting-settings-form");
    $("#btn-submit-greeting").click(function(e) {
        e.preventDefault();
        saveFormNotForModal(formGreeting, formGreeting.attr('action'), $(this), "POST", true).then(response => {
            console.log(response.data.settings);
            var storage = "{{ url('storage') }}/";
            var imageUrl = response.data.settings.greeting_photo
            $("#greeting-image").attr("src", storage + imageUrl);
            if (window.pond) {
                window.pond.removeFiles();
            }
        });
    })
</script>
@endpush
