<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class WordMaxCount implements ValidationRule
{
    protected $maxWords;

    public function __construct($maxWords)
    {
        $this->maxWords = $maxWords;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $wordCount = str_word_count($value);
        if ($wordCount > $this->maxWords) {
            $fail(__('validation.max_words', ['max' => $this->maxWords]));
        }
    }
    public function message(): string
    {
        return __('validation.max_words', ['max' => $this->maxWords]);
    }
    
}
