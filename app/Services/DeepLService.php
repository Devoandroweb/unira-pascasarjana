<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;

class DeepLService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = Config::get('services.deepl.key');
    }
    public function translate($text, $lang)
    {

        $response =  Http::withHeaders([
            'Authorization' => 'DeepL-Auth-Key ' . $this->apiKey, 
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->post('https://api-free.deepl.com/v2/translate', [
            'text' => [$text],
            'target_lang' => strtoupper($lang),
            'tag_handling' => 'xml',
            // 'ignore_tags' => 'img,a',
        ]);

        $body = $response->json();
       
        return $body['translations'][0]['text'] ?? $text;
    }
}
