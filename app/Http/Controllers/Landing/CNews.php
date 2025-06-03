<?php

namespace App\Http\Controllers\Landing;

use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CNews extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('q');
        $news = News::filterByQuery($search)->orderByDesc("created_at")->get();
        return view('pages.landing.news.index', compact('news'));
    }
    public function detail(News $news)
    {
        $currentIp = request()->ip();
        $ip = json_decode($news->ip, true) ?? [];
        if (!in_array($currentIp, $ip)) {
            $ip[] = $currentIp;
            $news->ip = json_encode($ip);
            $news->viewer += 1;
            $news->save();
        }
        return view('pages.landing.news.detail', compact('news'));
    }
}
