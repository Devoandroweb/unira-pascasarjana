<?php

namespace App\Http\Controllers;

use App\Charts\VisitorChart;
use App\Models\News;
use App\Models\User;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CDashboard extends Controller
{
    public function index(VisitorChart $chart)
    {
        $title = __("Dashboard");
        $news = News::FilterByRole(Auth::user()->role);
        $user = User::all();
        $chart = $chart->build();
        $visitor = Visitor::all();
        return view('pages.dashboard.index', compact('title', 'news', 'user','visitor','chart'));
    }
}
