<form action="{{ route('dashboard.testimonials.store') }}" method="post" id="testimonials-form">
    @csrf
    <input type="hidden" name="id" value="">
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="name" class="form-label">{{ __('Name') }}</label>
                <input type="text" class="form-control" id="name" name="name"
                    placeholder="{{ __('Example') }} : {{ __('Erling Haaland') }}" autocomplete="off">
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="position" class="form-label">{{ __('Position') }}</label>
                <input type="text" class="form-control" id="position" name="position"
                    placeholder="{{ __('Example') }} : {{ __('Manchester City Player') }}" autocomplete="off">
            </div>
        </div>
        <div class="col-md-12">
            <div class="mb-3">
                <label for="photo" class="form-label">{{ __('Photo') }}</label>
                <input type="file" class="form-control" id="photo" name="photo" autocomplete="off">
            </div>
        </div>
        <div class="col-md-12">
            <div class="mb-3">
                <label for="content" class="form-label">{{ __('Testimonials') }}</label>
                <textarea name="content" id="content" cols="30" rows="10" class="form-control"></textarea>
            </div>
        </div>
    </div>
</form>
