<?php

namespace App\Http\Requests\Master;

use App\Traits\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    use FailedValidation;

    protected $fill = [
        'id' => 0,
        'name' => 1,
        'email' => 1,
        'username' => 1,
        'role' => 1,
        'photo' => 0
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
            $rules = ($this->fill[$key] == 1) ? ['required'] : ['nullable'];

            switch ($key) {
                case 'photo':
                    $rules[] = 'image';
                    $rules[] = 'max:10256';
                    break;
                case 'email':
                    $rules[] = 'email:dns';
                    $rules[]= 'unique:users,email,'.$this->id;
                    break;
            }

            $dataValidate[$key] = $rules;
        }
        return $dataValidate;
    }
}
