<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use App\Services\DeepLService;
use Illuminate\Support\Facades\Session;

class CLocalization extends Controller
{
    public function change($locale)

    {
        $lang = $locale;
        Session::put('locale', $lang);
       
        return redirect()->back();
    }
}
