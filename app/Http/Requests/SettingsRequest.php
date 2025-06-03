<?php

namespace App\Http\Requests;

use App\Traits\FailedValidation;
use App\Rules\ValidSocialMediaLink;
use App\Rules\WordMaxCount;
use Illuminate\Foundation\Http\FormRequest;

class SettingsRequest extends FormRequest
{
    use FailedValidation;
    protected $fill = [
        'website_name' => 0,
        'description' => 0,
        'address' => 0,
        'phone' => 0,
        'instagram' => 0,
        'youtube' => 0,
        'favicon' => 0,
        'whatsapp' => 0,
        'slider_type' => 0,
        'number_of_study_program' => 0,
        'number_of_students' => 0,
        'number_of_lecturers' => 0,
        'number_of_alumni' => 0,
        'email' => 0,
        'website_logo' => 0,
        'slider_type' => 0,
        'greeting_photo' => 0,
        'greeting' => 0
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
                case 'website_logo':
                    $rules[] = 'image';
                    $rules[] = 'max:10256';
                    break;
                case 'description':
                    $rules[] = new WordMaxCount(30);
                    break;
                case 'youtube':
                case 'instagram':
                    $rules[] = 'url';
                    $rules[] = new ValidSocialMediaLink($key);
                    break;
                case 'whatsapp' :
                    $rules[] = 'regex:/^\+([1-9]\d{0,2})-?(\d{1,4}-?){1,4}(\d{1,4})$/';
            }
            $dataValidate[$key] = $rules;
        }
        return $dataValidate;
    }

    public function messages()
    {
        return [
            'whatsapp.regex' => __("The WhatsApp number format is invalid. Ensure it starts with the country code with + sign."),
        ];
    }
}
