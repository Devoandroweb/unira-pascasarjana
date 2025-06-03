<?php

namespace App\Http\Requests\News;

use App\Traits\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    use FailedValidation;
    protected $fill = [
        'id' => 0,
        'name' => 1
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
            // dd($key);
            $dataValidate[$key] = ($this->fill[$key] == 1) ? 'required' : 'nullable';
            switch ($key) {
                case 'name':
                    $dataValidate[$key] .= "|unique:categories,name,".$this->id;
                    break;
            }
        }
        return $dataValidate;
    }
}
