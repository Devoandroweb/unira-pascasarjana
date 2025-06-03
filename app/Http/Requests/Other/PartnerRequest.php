<?php

namespace App\Http\Requests\Other;

use App\Traits\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;

class PartnerRequest extends FormRequest
{
    use FailedValidation;
    protected $fill = [
        'id' => 0,
        'partner_name' => 1,
        'city_or_country' => 1,
        'logo' => 1,
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
            $this->fill['logo'] = 0;
        }
        foreach (array_keys($this->fill) as $key) {
            $dataValidate[$key] = ($this->fill[$key] == 1) ? 'required' : 'nullable';
            switch ($key) {
                case 'logo':
                    $dataValidate[$key] .= '|image|max:10240';
                    break;
            }
        }
        return $dataValidate;
    }
}
