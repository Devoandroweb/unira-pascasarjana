<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Page;
use App\Models\User;
use App\Models\Slider;
use App\Models\Partner;
use App\Models\Category;
use App\Models\Lecturer;
use App\Models\Achievement;
use App\Models\Testimonial;
use Illuminate\Support\Str;
use App\Models\PageCategory;
use App\Models\Publication;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class CTrash extends Controller
{
    public function lecturers()
    {

        $data = Lecturer::with('user')->onlyTrashed()->get();
        return DataTables::of($data)
            ->addColumn('checkbox', function ($row) {
                return buildCheckbox($row);
            })
            ->addColumn('action', function ($row) {
                $restore = route('dasboard.master-data.lecturers.restore');
                $delete = route('dasboard.master-data.lecturers.delete');
                return buildActionTrash($restore, $delete,   $row);
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
            ->rawColumns(['action', 'photo', 'is_user', 'checkbox'])
            ->addIndexColumn()
            ->toJson();
    }
    public function users()
    {
        $data = User::whereNot('id', Auth::user()->id)->onlyTrashed()->orderBy('id', 'asc')->get();
        return DataTables::of($data)
            ->addColumn('checkbox', function ($row) {
                return buildCheckbox($row);
            })
            ->addColumn('action', function ($row) {
                $restore = route('dasboard.master-data.users.restore');
                $delete = route('dasboard.master-data.users.delete');
                return buildActionTrash($restore, $delete, $row);
            })
            ->addColumn('photo', function ($row) {
                return "<div class='rounded-circle m-auto bg-dark overflow-hidden' style='width: 3rem;height: 3rem;'><img id='user-image' src='{$row->getPhoto()}' alt='user-image'class='w-100'></div>";
            })
            ->addColumn('role', function ($row) {
                return __($row->role);
            })
            ->rawColumns(['action', 'photo', 'checkbox'])
            ->addIndexColumn()
            ->toJson();
    }
    public function categories()
    {
        $data = Category::onlyTrashed()->orderBy('id', 'asc')->get();
        return DataTables::of($data)
            ->addColumn('checkbox', function ($row) {
                return buildCheckbox($row);
            })
            ->addColumn('action', function ($row) {
                $restore = route('dashboard.categories.restore');
                $delete = route('dashboard.categories.delete');
                return buildActionTrash($restore, $delete, $row);
            })
            ->rawColumns(['action', 'checkbox'])
            ->addIndexColumn()
            ->toJson();
    }
    public function news()
    {
        $data = News::FilterByRole(Auth::user()->role)->onlyTrashed()->orderBy('id', 'asc')->get();
        return DataTables::of($data)
            ->addColumn('checkbox', function ($row) {
                return buildCheckbox($row);
            })
            ->addColumn('tags', function ($row) {
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
                return $row?->category?->name ?? __("Uncategorized");
            })
            ->addColumn('created_at', function ($row) {
                return formatLocalizedDate($row?->created_at, "d F Y");
            })
            ->addColumn('action', function ($row) {
                $restore = route('dashboard.news.restore');
                $delete = route('dashboard.news.delete');
                return buildActionTrash($restore, $delete, $row);
            })
            ->rawColumns(['action', 'checkbox', 'tags'])
            ->addIndexColumn()
            ->toJson();
    }
    public function publications()
    {
        $data = Publication::onlyTrashed()->orderBy('id', 'asc')->get();
        return DataTables::of($data)
            ->addColumn('checkbox', function ($row) {
                return buildCheckbox($row);
            })->addColumn('category', function ($row) {
                return __(Str::ucfirst($row->category));
            })
            ->addColumn('published', function ($row) {
                return toDateIndo($row->published_at, false, false);
            })
            ->addColumn('action', function ($row) {
                $restore = route('dashboard.publications.restore');
                $delete = route('dashboard.publications.delete');
                return buildActionTrash($restore, $delete, $row);
            })
            ->rawColumns(['action', 'checkbox'])
            ->addIndexColumn()
            ->toJson();
    }
    public function sliders()
    {
        $data = Slider::onlyTrashed()->orderBy('id', 'asc')->get();
        return DataTables::of($data)
            ->addColumn('checkbox', function ($row) {
                return buildCheckbox($row);
            })->addColumn('type', function ($row) {
                return __(Str::ucfirst($row->type));
            })
            ->addColumn('action', function ($row) {
                $restore = route('dashboard.sliders.restore');
                $delete = route('dashboard.sliders.delete');
                return buildActionTrash($restore, $delete, $row);
            })
            ->rawColumns(['action', 'checkbox'])
            ->addIndexColumn()
            ->toJson();
    }

    public function partners()
    {
        $data = Partner::onlyTrashed()->orderBy('id', 'asc')->get();
        return DataTables::of($data)
            ->addColumn('checkbox', function ($row) {
                return buildCheckbox($row);
            })
            ->addColumn('action', function ($row) {
                $restore = route('dashboard.partners.restore');
                $delete = route('dashboard.partners.delete');
                return buildActionTrash($restore, $delete, $row);
            })
            ->rawColumns(['action', 'checkbox'])
            ->addIndexColumn()
            ->toJson();
    }
    public function testimonials()
    {
        $data = Testimonial::onlyTrashed()->orderBy('id', 'asc')->get();
        return DataTables::of($data)
            ->addColumn('checkbox', function ($row) {
                return buildCheckbox($row);
            })
            ->addColumn('action', function ($row) {
                $restore = route('dashboard.testimonials.restore');
                $delete = route('dashboard.testimonials.delete');
                return buildActionTrash($restore, $delete, $row);
            })
            ->addColumn('photo', function ($row) {
                return "<div class='rounded-circle m-auto bg-dark overflow-hidden' style='width: 3rem;height: 3rem;'><img id='user-image' src='{$row->getPhoto()}' alt='user-image'class='w-100'></div>";
            })
            ->rawColumns(['action', 'checkbox', 'photo'])
            ->addIndexColumn()
            ->toJson();
    }

    public function pages()
    {
        $data = Page::FilterByRole(Auth::user()->role)->onlyTrashed()->orderBy('id', 'asc')->get();

        return DataTables::of($data)
            ->addColumn('checkbox', function ($row) {
                return buildCheckbox($row);
            })
            ->addColumn('action', function ($row) {
                $restore = route('dashboard.pages.restore');
                $delete = route('dashboard.pages.delete');
                return buildActionTrash($restore, $delete, $row);
            })
            ->addColumn('category', function ($row) {
                return $row?->category?->name ?? __("Uncategorized");
            })
            ->addColumn('created_at', function ($row) {
                return formatLocalizedDate($row?->created_at, "d F Y");
            })
            ->rawColumns(['action', 'checkbox'])
            ->toJson();
    }

    public function pageCategory()
    {
        $data = PageCategory::orderBy('name', 'asc')->onlyTrashed();
        return DataTables::of($data)
            ->addColumn('checkbox', function ($row) {
                return buildCheckbox($row);
            })
            ->addColumn('action', function ($row) {
                $restore = route('dashboard.testimonials.restore');
                $delete = route('dashboard.testimonials.delete');
                return buildActionTrash($restore, $delete, $row);
            })
            ->rawColumns(['action', 'checkbox'])
            ->addIndexColumn()
            ->toJson();
    }
}
