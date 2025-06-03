<form action="{{ route('dashboard.settings.store') }}" method="post" id="general-settings-form"
    enctype="multipart/form-data">
    @csrf
    <div class="row mb-3">
        <label for="website_name" class="col-sm-2 col-form-label">{{ __('Website Title') }}</label>
        <div class="col-sm-8">
            <input class="form-control" name="website_name" type="text" value="{{ settings()->get('website_name') }}"
                id="website_name" autocomplete="off">
        </div>
    </div>
    <div class="row mb-3">
        <label for="description" class="col-sm-2 col-form-label">{{ __('Description') }}</label>
        <div class="col-sm-8">
            <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ settings()->get('description') }}</textarea>
        </div>
    </div>
    <div class="row mb-3">
        <label for="address" class="col-sm-2 col-form-label">{{ __('Address') }}</label>
        <div class="col-sm-8">
            <input class="form-control" name="address" type="text" value="{{ settings()->get('address') }}"
                id="address" autocomplete="off">
        </div>
    </div>
    <div class="row mb-3">
        <label for="email" class="col-sm-2 col-form-label">{{ __('Email') }}</label>
        <div class="col-sm-8">
            <input class="form-control" name="email" type="text" value="{{ settings()->get('email') }}"
                id="email" autocomplete="off">
        </div>
    </div>
    <div class="row mb-3">
        <label for="phone" class="col-sm-2 col-form-label">{{ __('Phone') }}</label>
        <div class="col-sm-8">
            <input class="form-control" name="phone" type="text" value="{{ settings()->get('phone') }}"
                id="phone" autocomplete="off">
        </div>
    </div>
    <div class="row mb-3">
        <label for="whatsapp" class="col-sm-2 col-form-label">{{ __('Whatsapp') }} </label>
        <div class="col-sm-8">
            <input class="form-control" name="whatsapp" type="text" value="{{ settings()->get('whatsapp') }}"
                id="whatsapp" autocomplete="off">
        </div>
    </div>
    <div class="row mb-3">
        <label for="instagram" class="col-sm-2 col-form-label">{{ __('Instagram') }}</label>
        <div class="col-sm-8">
            <input class="form-control" name="instagram" type="text" value="{{ settings()->get('instagram') }}"
                id="instagram" autocomplete="off">
        </div>
    </div>
    <div class="row mb-3">
        <label for="youtube" class="col-sm-2 col-form-label">{{ __('Youtube') }}</label>
        <div class="col-sm-8">
            <input class="form-control" name="youtube" type="text" value="{{ settings()->get('youtube') }}"
                id="youtube" autocomplete="off">
        </div>
    </div>

    <div class="row mb-3">
        <label for="website_logo" class="col-sm-2 col-form-label">{{ __('Website Logo') }}</label>
        <div class="col-sm-6">
            <input class="form-control file-pond-single" name="website_logo" type="file" id="website_logo">
        </div>
        <div class="col-sm-4">
            <img src="{{ Storage::url(settings()->get('website_logo')) ?? '' }}" alt="" id="logo-image"
                class="img-thumbnail" width="100px">
        </div>
    </div>
    <div class="row mb-3">
        <label for="website_logo" class="col-sm-2 col-form-label">{{ __('Favicon') }}</label>
        <div class="col-sm-6">
            <input class="form-control file-pond-single" name="favicon" type="file" id="favicon">
        </div>
        <div class="col-sm-4">
            <img src="{{ Storage::url(settings()->get('favicon')) ?? '' }}" alt="" id="favicon-image"
                class="img-thumbnail" width="100px">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-sm-12">
            <button class="btn btn-sm btn-primary float-end" id="btn-submit-general">{{ __('Save') }}</button>
        </div>
    </div>
</form>
@push('js')
    <script>
        var formGeneral = $("#general-settings-form");
        $("#btn-submit-general").click(function(e) {
            e.preventDefault();
            saveFormNotForModal(formGeneral, formGeneral.attr('action'), $(this), "POST", true).then(response => {
                console.log(response.data.settings);
                var storage = "{{ url('storage') }}/";
                var imageUrl = response.data.settings.website_logo
                var faviconUrl = response.data.settings.favicon
                $("#logo-image").attr("src", storage + imageUrl);
                $("#favicon-image").attr("src", storage + faviconUrl);
                if (window.pond) {
                    window.pond.removeFiles();
                }
            });
        })
    </script>
@endpush
