<?php

namespace App\Http\Controllers;


use App\Models\News;
use App\Models\User;
use App\Models\Category;
use App\Models\Lecturer;
use App\Models\Page;
use App\Models\PageCategory;
use App\Models\Partner;
use App\Models\Publication;
use App\Models\Slider;
use App\Models\Testimonial;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class CDatatable extends Controller
{
    public function lecturers()
    {
        $data = Lecturer::orderBy('id', 'asc')->get();
        return DataTables::of($data)
            ->addColumn('action', function ($row) {
                return '
                <div class="btn-group" role="group">
                    <a href="' . route('dashboard.master-data.lecturers.edit', $row) . '" class="btn btn-sm btn-warning edit me-2"><i class="mdi mdi-pencil"></i></a>
                    <a href="' . route('dashboard.master-data.lecturers.destroy', $row) . '" class="btn btn-sm btn-danger trashed"><i class="mdi mdi-trash-can-outline"></i></a>
                </div>';
            })
            ->addColumn('gender', function ($row) {
                return __(Str::ucfirst($row->gender));
            })
            ->addColumn('is_user', function ($row) {
                return buildIsUserBadge($row->is_user);
            })
            ->addColumn('position', function ($row) {
                return __(Str::ucfirst($row->position));
            })
            ->addColumn('photo', function ($row) {
                return "<div class='rounded-circle m-auto bg-dark overflow-hidden' style='width: 3rem;height: 3rem;'><img id='user-image' src='{$row->getPhoto()}' alt='user-image'class='w-100'></div>";
            })
            ->rawColumns(['action', 'photo', 'is_user'])
            ->addIndexColumn()
            ->toJson();
    }
    public function pages()
    {
        $data = Page::FilterByRole(Auth::user()->role)->orderBy('id', 'asc')->get();

        return DataTables::of($data)
            ->addColumn('action', function ($row) {
                return '
                <div class="btn-group" role="group">
                    <a href="' . route('dashboard.pages.edit', $row) . '" class="btn btn-sm btn-warning edit"><i class="mdi mdi-pencil"></i></a>
                    <a href="' . route('dashboard.pages.destroy', $row) . '" class="btn btn-sm btn-danger trashed"><i class="mdi mdi-trash-can-outline"></i></a>
                    <a href="' . route('home.page.index', $row->slug) . '" class="btn btn-sm btn-info" target="_blank"><i class="fas fa-link"></i> ' . __("Show Page") . '</a>
                </div>';
            })
            ->addColumn('category', function ($row) {
                return $row?->category?->name ?? __("Uncategorized");
            })
            ->addColumn('created_at', function ($row) {
                return formatLocalizedDate($row?->created_at, "d F Y");
            })
            ->rawColumns(['action', 'tags'])
            ->addIndexColumn()
            ->toJson();
    }
    public function pageCategory()
    {
        $data = PageCategory::orderBy('name', 'asc')->get();
        return DataTables::of($data)
            ->addColumn('action', function ($row) {
                return '
                <div class="btn-group" role="group">
                    <a href="' . route('dashboard.page-category.edit', $row) . '" class="btn btn-sm btn-warning edit me-2"><i class="mdi mdi-pencil"></i></a>
                    <a href="' . route('dashboard.page-category.destroy', $row) . '" class="btn btn-sm btn-danger trashed"><i class="mdi mdi-trash-can-outline"></i></a>
                </div>';
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->toJson();
    }
    public function users()
    {
        $data = User::whereNot('id', Auth::user()->id)->orderBy('id', 'asc')->get();
        return DataTables::of($data)
            ->addColumn('action', function ($row) {
                return '
                <div class="btn-group" role="group">
                    <a href="' . route('dashboard.master-data.users.edit', $row) . '" class="btn btn-sm btn-warning edit me-2"><i class="mdi mdi-pencil"></i></a>
                    <a href="' . route('dashboard.master-data.users.destroy', $row) . '" class="btn btn-sm btn-danger trashed"><i class="mdi mdi-trash-can-outline"></i></a>
                </div>';
            })
            ->addColumn('photo', function ($row) {
                return "<div class='rounded-circle m-auto bg-dark overflow-hidden' style='width: 3rem;height: 3rem;'><img id='user-image' src='{$row->getPhoto()}' alt='user-image'class='w-100'></div>";
            })
            ->addColumn('role', function ($row) {
                return __($row->role);
            })

            ->rawColumns(['action', 'photo'])
            ->addIndexColumn()
            ->toJson();
    }
    public function categories()
    {
        $user = Auth::user();
        $data = Category::orderBy('id', 'asc')->get();
        return DataTables::of($data)
            ->addColumn('action', function ($row) use ($user) {

                if ($user->role === 'admin') {
                    return '
                <div class="btn-group" role="group">
                    <a href="' . route('dashboard.categories.edit', $row) . '" class="btn btn-sm btn-warning edit me-2"><i class="mdi mdi-pencil"></i></a>
                    <a href="' . route('dashboard.categories.destroy', $row) . '" class="btn btn-sm btn-danger trashed"><i class="mdi mdi-trash-can-outline"></i></a>
                </div>';
                } else {
                    if ($row->created_by === $user->id) {
                        return '
                    <div class="btn-group" role="group">
                        <a href="' . route('dashboard.categories.edit', $row) . '" class="btn btn-sm btn-warning edit me-2"><i class="mdi mdi-pencil"></i></a>
                        <a href="' . route('dashboard.categories.destroy', $row) . '" class="btn btn-sm btn-danger trashed"><i class="mdi mdi-trash-can-outline"></i></a>
                    </div>';
                    } else {
                        return '';
                    }
                }
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->toJson();
    }
    public function publicationLists()
    {

        $data = Publication::orderBy('id', 'asc')->get();
        return DataTables::of($data)
            ->addColumn('action', function ($row)  {
                return
                "<div class='btn-group' role='group'>
                    <a href='{$row->link}' class='btn btn-sm btn-primary me-2'>".__('More')."</a>
                </div>";
            })->addColumn('category', function($row){
                return __(Str::ucfirst($row->category));
            })
            ->addColumn('published', function($row){
                return toDateIndo($row->published_at,false,false);
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->toJson();
    }
    public function publications()
    {

        $data = Publication::orderBy('id', 'asc')->get();
        return DataTables::of($data)
            ->addColumn('action', function ($row)  {
                return
                '<div class="btn-group" role="group">
                    <a href="' . route('dashboard.publications.edit', $row) . '" class="btn btn-sm btn-warning edit me-2"><i class="mdi mdi-pencil"></i></a>
                    <a href="' . route('dashboard.publications.destroy', $row) . '" class="btn btn-sm btn-danger trashed"><i class="mdi mdi-trash-can-outline"></i></a>
                </div>';
            })->addColumn('category', function($row){
                return __(Str::ucfirst($row->category));
            })
            ->addColumn('published', function($row){
                return toDateIndo($row->published_at,false,false);
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->toJson();
    }
    public function news()
    {
        $data = News::FilterByRole(Auth::user()->role)->orderBy('id', 'asc')->get();
        return DataTables::of($data)
            ->addColumn('action', function ($row) {
                return '
                <div class="btn-group" role="group">
                    <a href="' . route('dashboard.news.edit', $row) . '" class="btn btn-sm btn-warning edit me-2"><i class="mdi mdi-pencil"></i></a>
                    <a href="' . route('dashboard.news.destroy', $row) . '" class="btn btn-sm btn-danger trashed"><i class="mdi mdi-trash-can-outline"></i></a>
                </div>';
            })->addColumn('tags', function ($row) {
                $tags = json_decode($row?->tags, true);
                if (!empty($tags)) {
                    $badgeTag = '';
                    foreach ($tags as $tag) {
                        $badgeTag .= buildBadge(random_int(1, 5), $tag['value']);
                    }
                    return $badgeTag;
                } else {
                    return '';
                }
            })
            ->addColumn('category', function ($row) {
                return $row?->category?->name ?? __("Uncategorised");
            })
            ->addColumn('created_at', function ($row) {
                return formatLocalizedDate($row?->created_at, "d F Y");
            })
            ->rawColumns(['action', 'tags'])
            ->addIndexColumn()
            ->toJson();
    }

    public function sliders()
    {
        $data = Slider::orderBy('id', 'asc')->get();
        return DataTables::of($data)
            ->addColumn('action', function ($row) {
                return '
                <div class="btn-group" role="group">
                    <a href="' . route('dashboard.sliders.edit', $row) . '" class="btn btn-sm btn-warning edit me-2"><i class="mdi mdi-pencil"></i></a>
                    <a href="' . route('dashboard.sliders.destroy', $row) . '" class="btn btn-sm btn-danger trashed"><i class="mdi mdi-trash-can-outline"></i></a>
                </div>';
            })
            ->addColumn('type', function ($row) {
                return __(Str::ucfirst($row->type));
            })

            ->rawColumns(['action'])
            ->addIndexColumn()
            ->toJson();
    }

    public function partners()
    {
        $data = Partner::orderBy('id', 'asc')->get();
        return DataTables::of($data)
            ->addColumn('logo', function ($row) {
                return '<img src="'.$row->getLogo().'" width="100px" alt="">';

            })
            ->addColumn('action', function ($row) {
                return '
                <div class="btn-group" role="group">
                    <a href="' . route('dashboard.partners.edit', $row) . '" class="btn btn-sm btn-warning edit me-2"><i class="mdi mdi-pencil"></i></a>
                    <a href="' . route('dashboard.partners.destroy', $row) . '" class="btn btn-sm btn-danger trashed"><i class="mdi mdi-trash-can-outline"></i></a>
                </div>';
            })
            ->rawColumns(['action','logo'])
            ->addIndexColumn()
            ->toJson();
    }
    public function testimonials()
    {
        $data = Testimonial::orderBy('id', 'asc')->get();
        return DataTables::of($data)
            ->addColumn('action', function ($row) {
                return '
                <div class="btn-group" role="group">
                    <a href="' . route('dashboard.testimonials.edit', $row) . '" class="btn btn-sm btn-warning edit me-2"><i class="mdi mdi-pencil"></i></a>
                    <a href="' . route('dashboard.testimonials.destroy', $row) . '" class="btn btn-sm btn-danger trashed"><i class="mdi mdi-trash-can-outline"></i></a>
                </div>';
            })
            ->addColumn('photo', function ($row) {
                return "<div class='rounded-circle m-auto bg-dark overflow-hidden' style='width: 3rem;height: 3rem;'><img id='user-image' src='{$row->getPhoto()}' alt='user-image'class='w-100'></div>";
            })
            ->rawColumns(['action', 'photo'])
            ->addIndexColumn()
            ->toJson();
    }
}
