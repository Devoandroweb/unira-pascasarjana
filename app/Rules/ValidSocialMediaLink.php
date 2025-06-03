<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidSocialMediaLink implements ValidationRule
{
    protected $platform;

    public function __construct($platform)
    {
        $this->platform = $platform;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $regex = $this->getRegexForPlatform($this->platform);

        if (!preg_match($regex, $value)) {
            $fail(__('validation.custom.attribute-name.link', ['platform' => $this->platform]));
        }
    }
    private function getRegexForPlatform($platform)
    {
        switch ($platform) {
            case 'facebook':
                return '/^https:\/\/www\.facebook\.com\/[A-Za-z0-9._-]+$/';
            case 'instagram':
                return '/^https:\/\/www\.instagram\.com\/[A-Za-z0-9._-]+$/';
            case 'youtube':
                return '/^https:\/\/(www\.)?youtube\.com\/@[\w.-]+$/';
            case 'google_scholar':
                return '/^https:\/\/scholar\.google\.co(m|\.id)\/citations\?(user=[A-Za-z0-9._-]+&hl=id|hl=id&user=[A-Za-z0-9._-]+)$/';
            case 'sinta':
                return '/^https:\/\/sinta\.kemdikbud\.go\.id\/authors\/profile\/[A-Za-z0-9._-]+$/';
            case 'journal':
                return '/^https:\/\/[A-Za-z0-9._-]+\/index.php\/[A-Za-z0-9._-]+\/article\/view\/[A-Za-z0-9._-]+(\/[A-Za-z0-9._-]+)?$/';
            default:
                return '//'; // Invalid regex to ensure it fails
        }
    }
}
