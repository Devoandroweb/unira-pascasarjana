<?php

namespace App\Http\Requests\Master;

use App\Traits\FailedValidation;
use App\Rules\ValidSocialMediaLink;
use Illuminate\Foundation\Http\FormRequest;

class LecturerRequest extends FormRequest
{

    use FailedValidation;
    protected $fill = [
        'id' => 0,
        'name' => 1,
        'position' => 1,
        'gender' => 1,
        'phone' => 1,
        'facebook' => 0,
        'instagram' => 0,
        'google_scholar' => 0,
        'sinta' => 0,
        'journal' => 0,

        // User
        'email' => 0,
        'username' => 0,
        'role' => 0,
        'photo' => 1
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
       
        if ($this->position == "lecturer") {
            $this->fill['sinta'] = 1;
            $this->fill['google_scholar'] = 1;
            $this->fill['journal'] = 1;
        }
        if ($this->position == "educators") {
            $this->fill['facebook'] = 1;
            $this->fill['instagram'] = 1;
        }
        if ($this->register) {
            $this->fill['email'] = 1;
            $this->fill['username'] = 1;
            $this->fill['role'] = 1;
        }
        if ($this->id) {
            $this->fill['photo'] = 0;
        }

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
                    $rules[]= 'unique:users,email,'.$this->email;
                    break;
                case 'username':
                    $rules[]= 'unique:users,username,'.$this->username;
                    break;
                case 'facebook':
                case 'instagram':
                case 'google_scholar':
                case 'sinta':
                case 'journal':
                    $rules[] = 'url';
                    $rules[] = new ValidSocialMediaLink($key);
                    break;
            }

            $dataValidate[$key] = $rules;
        }
        return $dataValidate;
    }
}
