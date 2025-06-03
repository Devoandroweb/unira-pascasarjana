<?php

namespace App\Http\Requests\Other;

use App\Rules\WordMaxCount;
use App\Traits\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;

class PublicationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    use FailedValidation;
    protected $fill = [
        'id' => 0,
        'title' => 1,
        'author' => 1,
        'published_at' => 1,
        'category' => 1,
        'link' => 1,
        'cover' => 0,
        'description' => 0,
        'no_issn' => 0
    ];
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
        if($this->category=='ejournal'){
            $this->fill['cover'] = 1;
            $this->fill['description'] = 1;
            $this->fill['no_issn'] = 1;
            $this->fill['author'] = 0;
            $this->fill['published_at'] = 0;
        }
        foreach (array_keys($this->fill) as $key) {
            // dd($key);
            $rules = ($this->fill[$key] == 1) ? ['required'] : ['nullable'];
            switch ($key) {
                case 'title':
                    $rules[] = new WordMaxCount(30);
                    break;
                case 'published_at':
                    $rules[] = 'date';
                    break;
                case 'link':
                    $rules[] = 'url';
                    break;
            }
            $dataValidate[$key] = $rules;
        }
        return $dataValidate;
    }
}
