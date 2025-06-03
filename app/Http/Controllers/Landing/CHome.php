<?php

namespace App\Http\Controllers\Landing;

use App\Models\News;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\Slider;

class CHome extends Controller
{
    public function index()
    {
        
        $testimonials = Testimonial::latest()->get();
        $news = News::orderBy('created_at', 'desc')->limit(5)->get();
        $partners = Partner::all();
        $videoSlides = Slider::whereType('video')->get();
        $imageSlides = Slider::whereType('image')->get();
        return view('pages.landing.index', compact('testimonials', 'news', 'partners','imageSlides','videoSlides'));
    }
}
