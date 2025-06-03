<?php

namespace App\Http\Requests\Other;

use App\Traits\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;

class TestimonialRequest extends FormRequest
{
    use FailedValidation;
    protected $fill = [
        'id' => 0,
        'name' => 1,
        'position' => 1,
        'photo' => 1,
        'content' => 1
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
        if ($this->id) {
            $this->fill['photo'] = 0;
        }
        foreach (array_keys($this->fill) as $key) {
            // dd($key);
            $dataValidate[$key] = ($this->fill[$key] == 1) ? 'required' : 'nullable';
            switch ($key) {
                case 'photo':
                    $dataValidate[$key] .= '|file|image|max:10240';
                    break;
            }
        }
        return $dataValidate;
    }
}
