<?php

namespace App\Http\Requests\Page;

use App\Traits\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
{

    use FailedValidation;
    protected $fill = [
        'title' => 1,
        'category_id' => 0,
        'image' => 0,
        'table' => 0,
        'type' => 0,
        'content' => 0,
        'video' => 0,
        'files.*'=>0,
        'file_name.*'=>0
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
        if ($this->type == 'static') {
            unset($this->fill['title']);
        }
        $dataValidate = [];
        foreach (array_keys($this->fill) as $key) {
            // dd($key);
            $dataValidate[$key] = ($this->fill[$key] == 1) ? 'required' : 'nullable';
            switch ($key) {
                case 'image':
                    $dataValidate[$key] .= '|image|max:10256';
                    break;
            }
        }
        return $dataValidate;
    }
}
