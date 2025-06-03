<form action="{{ route('dashboard.partners.store') }}" method="post" id="partner-form">
    @csrf
    <input type="hidden" name="id" value="">
    <div class="row">
        <div class="col-md-12">
            <div class="mb-3">
                <label for="partner_name" class="form-label">{{ __('Partner Name') }}</label>
                <input type="text" class="form-control" id="partner_name" name="partner_name"
                    placeholder="{{ __('Example') }} : {{ __('Era Infinity') }}" autocomplete="off">
            </div>
        </div>

        <div class="col-md-12">
            <div class="mb-3">
                <label for="city_or_country" class="form-label">{{ __('City Or Country') }}</label>
                <input type="text" class="form-control" id="city_or_country" name="city_or_country"
                    placeholder="{{ __('Example') }} : {{ __('Indonesia') }}" autocomplete="off">
            </div>
        </div>

        <div class="col-md-12">
            <div class="mb-3">
                <label for="logo" class="form-label">{{ __('Logo') }}</label>
                <input type="file" class="form-control" id="logo" name="logo" autocomplete="off">
            </div>
        </div>
    </div>
</form>
