<form action="{{ route('dashboard.master-data.users.store') }}" method="post" id="user-form">
    @csrf
    <input type="hidden" name="id" value="">
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="name" class="form-label">{{ __('Name') }}</label>
                <input type="text" class="form-control" id="name" name="name"
                    placeholder="{{ __('Example') }} : Adi Santoso S.Pd" autocomplete="off">
            </div>
        </div>
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
        <div class="col-md-6">
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
    </div>
</form>
