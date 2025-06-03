<?php

namespace App\Http\Requests;

use App\Traits\FailedValidation;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
    use FailedValidation;
    protected $fill = [
        'email' => 1,
        'password' => 1,
        'password_confirmation' => 1,
        'token' => 1,
    ];
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        $dataValidate = [];
        foreach (array_keys($this->fill) as $key) {
            $dataValidate[$key] = ($this->fill[$key] == 1) ? ['required'] : ['nullable'];
            switch ($key) {
                case 'password':
                    $dataValidate[$key][] = 'confirmed';
                    $dataValidate[$key][] = Password::defaults();
                    break;
            }
        }
        return $dataValidate;
    }
}
