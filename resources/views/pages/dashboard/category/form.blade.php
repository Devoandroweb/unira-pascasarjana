<form action="{{ route('dashboard.categories.store') }}" method="post" id="category-form">
    @csrf
    <input type="hidden" name="id" value="">
    <div class="row">
        <div class="col-md-12">
            <div class="mb-3">
                <label for="name" class="form-label">{{ __('Name') }}</label>
                <input type="text" class="form-control" id="name" name="name"
                    placeholder="{{ __('Example') }} : {{ __('Achievement') }}" autocomplete="off">
            </div>
        </div>
       
    </div>

</form>
