<form action="{{ route('dashboard.master-data.lecturers.store') }}" method="post" id="lecturer-form">
    @csrf
    <input type="hidden" name="id" value="">
    <div class="row" id="data-section">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="name" class="form-label">{{ __("Lecturer's Name") }}</label>
                <input type="text" class="form-control" id="name" name="name"
                    placeholder="{{ __('Example') }} : Adi Santoso S.Pd" autocomplete="off">
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="position" class="form-label">{{ __('Position') }}</label>
                <select name="position" id="position" class="form-control">
                    <option value="">{{ __('Please Select') }}</option>
                    @foreach (config('enum.position') as $position)
                        <option value="{{ $position }}">{{ __(Str::ucfirst($position)) }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="gender" class="form-label">{{ __('Gender') }}</label>
                <select name="gender" id="gender" class="form-control">
                    <option value="">{{ __('Please Select') }}</option>
                    @foreach (config('enum.gender') as $gender)
                        <option value="{{ $gender }}">{{ __(Str::ucfirst($gender)) }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="phone" class="form-label">{{ __('Phone Number') }}</label>
                <input type="text" class="form-control" id="phone" name="phone"
                    placeholder="{{ __('Example') }} : 08xxxxxxx" autocomplete="off">
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="facebook" class="form-label">{{ __('Facebook Account Link') }}</label>
                <input type="text" class="form-control" id="facebook" name="facebook"
                    placeholder="{{ __('Example') }} : https://www.facebook.com/erasitesgroup" autocomplete="off">
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="instagram" class="form-label">{{ __('Instagram Account Link') }}</label>
                <input type="text" class="form-control" id="instagram" name="instagram"
                    placeholder="{{ __('Example') }} : https://www.instagram.com/erasitesgroup" autocomplete="off">
            </div>
        </div>
    </div>
    <div class="row d-none" id="journal-section">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="google_scholar" class="form-label">{{ __('Google Scholar Account Link') }}</label>
                <input type="text" class="form-control" id="google_schoolar" name="google_scholar"
                    placeholder="{{ __('Example') }} : https://scholar.google.co.id/citations?user=6WN5llIAAAAJ&hl=id"
                    autocomplete="off">
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="journal" class="form-label">{{ __('Journal Link') }}</label>
                <input type="text" class="form-control" id="journal" name="journal"
                    placeholder="{{ __('Example') }} : https://ejournal.uniramalang.ac.id/index.php/i-com/article/view/3620/2369"
                    autocomplete="off">
            </div>
        </div>
        <div class="col-md-12">
            <div class="mb-3">
                <label for="sinta" class="form-label">{{ __('Sinta Link') }}</label>
                <input type="text" class="form-control" id="sinta" name="sinta"
                    placeholder="{{ __('Example') }} : https://sinta.kemdikbud.go.id/authors/profile/6655031"
                    autocomplete="off">
            </div>
        </div>
    </div>
    <div class="row d-none" id="user-section">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="email" class="form-label">{{ __('Email') }}</label>
                <input type="email" class="form-control" id="email" name="email"
                    placeholder="{{ __('Example') }} : jhondoe@unira.ac.id" autocomplete="off">
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="username" class="form-label">{{ __('Username') }}</label>
                <input type="text" class="form-control" id="username" name="username"
                    placeholder="{{ __('Example') }} : jhondoe" autocomplete="off">
            </div>
        </div>
        <div class="col-md-12">
            <div class="mb-3">
                <label for="role" class="form-label">{{ __('Role') }}</label>
                <select type="role" class="form-control" id="role" name="role">
                    <option value="">{{ __('Please Select') }}</option>
                    @foreach (config('enum.role') as $role)
                        <option value="{{ $role }}">{{ __(Str::ucfirst($role)) }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="mb-3">
                <label for="photo" class="form-label">{{ __('Photo') }}</label>
                <input type="file" class="form-control" id="photo" name="photo">
            </div>
        </div>
        <div class="col-md-12">
            <div class="mb-3">
                <input type="checkbox" class="form-check-input" id="register_user"
                    style="--bs-form-check-bg:#b3b3b3 !important" name="register">
                <label for="register_user" class="form-check-label">{{ __('Register As a User?') }}</label>
            </div>
        </div>
    </div>
</form>
@push('js')
    <script>
        var registerCheck = $("input[name=register]");
        var position = $("select[name=position]");
        registerCheck.change(function(e) {
            var userForm = $("#user-section");
            userForm.toggleClass("d-none", !$(this).is(":checked")).find("input, textarea, select").val("");
            userForm.find("input[type='checkbox'], input[type='radio']").prop("checked", false);
        })
        position.change(function(e) {
            var journalForm = $("#journal-section");
            journalForm.toggleClass("d-none", $(this).val() !== 'lecturer');
        })
    </script>
@endpush
