<form action="{{ route('dashboard.publications.store') }}" method="post" id="publication-form">
    @csrf
    <input type="hidden" name="id" value="">
    <div class="row">
        <div class="col-md-12">
            <div class="mb-3">
                <label for="title" class="form-label">{{ __('Title') }}</label>
                <input type="text" class="form-control" id="title" name="title"
                    placeholder="{{ __('Example') }} : {{ __('The Effect of Lose Streaks in Student Psychology') }}" autocomplete="off">
            </div>
        </div>
        <div class="col-md-12" id="author_col">
            <div class="mb-3">
                <label for="author" class="form-label">{{ __('Author') }}</label>
                <input type="text" class="form-control" id="author" name="author"
                    placeholder="{{ __('Example') }} : {{ __('Fathur Rosidin, S.Ag, M.Pd.') }}" autocomplete="off">
            </div>
        </div>
        <div class="col-md-12">
            <div class="mb-3">
                <label for="category" class="form-label">{{ __('Category') }}</label>
                <select name="category" id="category" class="form-control">
                    <option value="">{{ __("Please Select") }}</option>
                    <option value="lecturer">{{ __("Lecturer") }}</option>
                    <option value="student">{{ __("Student") }}</option>
                    <option value="ejournal">{{ __("Ejournal") }}</option>
                </select>
            </div>
        </div>
        <div class="col-md-12" id="published_at_col">
            <div class="mb-3">
                <label for="published_at" class="form-label">{{ __('Published At') }}</label>
                <input type="date" name="published_at" id="published_at" class="form-control"/>
            </div>
        </div>
        <div class="col-md-12">
            <div class="mb-3">
                <label for="link" class="form-label">{{ __('Link') }}</label>
                <input type="url" class="form-control" id="link" name="link"
                    placeholder="{{ __('Example') }} : {{ __('https://theconversation.com/platform-coop-bagaimana-koperasi-pekerja-ekonomi-gig-bisa-meredam-dominasi-perusahaan-teknologi-211678') }}" autocomplete="off">
            </div>
        </div>
        <div id="coverdesc" style="display: none">
            <div class="col-md-12">
                <div class="mb-3">
                    <label for="no_issn" class="form-label">{{ __('No ISSN') }}</label>
                    <input type="text" name="no_issn" id="no_issn" class="form-control" placeholder="{{ __('Input No ISSN') }}">
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label for="cover" class="form-label">{{ __('Cover') }}</label>
                    <input type="file" id="cover" name="cover" class="form-control">
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label for="description" class="form-label">{{ __('Description') }}</label>
                    <textarea class="form-control ckeditor-modal" name="description" id="description"></textarea>
                </div>
            </div>
        </div>
        
        
       
    </div>

</form>
