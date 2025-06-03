<?php

namespace App\Models;

use App\Traits\CreatedBy;
use Astrotomic\Translatable\Translatable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class News extends Model
{
    use HasFactory, HasSlug, CreatedBy, SoftDeletes;
    protected $guarded = ['id'];
    protected $with = ['category', 'author'];
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function scopeFilterByRole($query, $role)
    {
        return $query->when($role === 'admin', function ($query) {
            return $query->orderBy('id', 'asc');
        })
            ->when($role !== 'admin', function ($query) {
                return $query->where('created_by', Auth::user()->id)->orderBy('id', 'asc');
            }, function ($query) {
                return $query->orderBy('id', 'asc');
            });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function author()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    function getImage()
    {
        if ($this->image && File::exists(storage_path("app/public/" . $this->image))) {
            return url("storage/" . $this->image);
        }
        return asset('/landing/image/gedung-depan-unira.png');
    }
    public function scopeFilterByQuery($query, $search = null)
    {
        if ($search) {
            return $query->whereHas('category', function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%");
                })->orWhere('title', 'like', "%{$search}%")
                ->orWhere('content', 'like', "%{$search}%");;
        }
        return $query;
    }
}
