<?php

namespace App\Http\Requests\Page;

use App\Traits\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;

class PageCategoryRequest extends FormRequest
{
    use FailedValidation;
    protected $fill = [
        'id' => 0,
        'name' => 1,
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
            if($key=="name"){
                $dataValidate[$key] .= "|unique:page_categories,name,".$this->id;
            }
        }
        return $dataValidate;
    }
}
