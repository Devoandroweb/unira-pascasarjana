<?php

namespace App\Http\Requests\Other;

use App\Traits\FailedValidation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    use FailedValidation;
    protected $fill = [
        'name' => 1,
        'username' => 1,
        'email' => 1,
        'password' => 0,
        'photo' => 0,
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
        $id = Auth::user()->id;
        if (!$this->password) {
            unset($this->fill['password']);
        }
        $dataValidate = [];
        foreach (array_keys($this->fill) as $key) {
            $dataValidate[$key] = ($this->fill[$key] == 1) ? 'required' : 'nullable';
            switch ($key) {
                case 'email':
                    $dataValidate[$key] .= "|unique:users,email,$id,id|email:dns";
                    break;
                case 'username':
                    $dataValidate[$key] .= "|unique:users,username,$id,id";
                    break;
                case 'photo':
                    $dataValidate[$key] .= "|file|image|max:10240";
                    break;
            }
        }
        return $dataValidate;
    }
}
