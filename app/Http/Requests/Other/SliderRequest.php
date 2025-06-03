<?php

namespace App\Http\Requests\Other;

use App\Traits\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
{
    use FailedValidation;
    protected $fill = [
        'id' => 0,
        'title' => 1,
        'type' => 1,
        'file' => 0,
        'url' => 0,
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
            $this->fill['file'] = 0;
        }
        if ($this->type == 'video') {
            $this->fill['url'] = 1;
        } elseif ($this->type == 'image') {
            $this->fill['file'] = 1;
        }
        foreach (array_keys($this->fill) as $key) {
            // dd($key);
            $dataValidate[$key] = ($this->fill[$key] == 1) ? 'required' : 'nullable';
            switch ($key) {
                case 'file':
                    $dataValidate[$key] .= '|file|mimes:jpeg,jpg,png,gif,mp4,mov,avi,mkv|max:102400';
                    break;
            }
        }
        return $dataValidate;
    }
}
