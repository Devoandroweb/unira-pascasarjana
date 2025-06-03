<form action="{{ route('dashboard.page-category.store') }}" method="post" id="categories-page-form">
    @csrf
    <input type="hidden" name="id" value="">
    <div class="row">
        <div class="col-md-12">
            <div class="mb-3">
                <label for="name" class="form-label">{{ __('Categoies Name') }}</label>
                <input type="text" class="form-control" id="name" name="name"
                    placeholder="{{ __('Example') }} : {{ __('Profil') }}" autocomplete="off">
            </div>
        </div>

    </div>

</form>
