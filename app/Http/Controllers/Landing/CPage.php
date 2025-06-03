<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Lecturer;
use App\Models\News;
use App\Models\Page;
use App\Models\Publication;
use Illuminate\Http\Request;

class CPage extends Controller
{
    public function index($slug){
        $page = Page::with('files')->whereSlug($slug)->first();
        if($page){
            return view('pages.landing.pages.index', compact('page'));
        }
        return abort(404);
    }
   
    public function lecturers()
    {
        $title = __("Lecturers And Educators");
        $lecturers = Lecturer::wherePosition('lecturer')->get();
        $educators = Lecturer::wherePosition('educators')->get();

        return view('pages.landing.pages.lecturers', compact('title','lecturers','educators'));
    }
    public function publications()
    {
        $title = __("Publications");
        $publications = Publication::whereCategory(request()->category)->get();
        
        return view('pages.landing.pages.publications', compact('title','publications'));
    }
}
