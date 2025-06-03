<?php

namespace App\Http\Requests\News;

use App\Traits\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;


class NewsRequest extends FormRequest
{
    use FailedValidation;
    protected $fill = [
        'id' => 0,
        'title' => 1,
        'image' => 1,
        'category_id' => 0,
        'content' => 0,
        'tags' => 0
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
            $this->fill['image'] = 0;
        }
        foreach (array_keys($this->fill) as $key) {
            // dd($key);
            $dataValidate[$key] = ($this->fill[$key] == 1) ? 'required' : 'nullable';
            switch ($key) {
                case 'iamge':
                    $dataValidate[$key] .= '|image|max:10256';
                    break;
            }
        }
        return $dataValidate;
    }
}
