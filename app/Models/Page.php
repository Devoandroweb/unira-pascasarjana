<?php

namespace App\Models;

use App\Traits\CreatedBy;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Page extends Model
{
    use HasFactory, HasSlug, CreatedBy, SoftDeletes;
    protected $guarded = ['id'];
    protected $with = ['category','author'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
    function category(){
        return $this->belongsTo(PageCategory::class, 'category_id');
    }
    function files(){
        return $this->hasMany(PageFile::class,"page_id","id");
    }
   
    function coverImage()
    {
        if ($this->image && File::exists(storage_path("app/public/" . $this->image))) {
            return url("storage/" . $this->image);
        }   
        return asset('/landing/image/gedung-depan-unira.png');
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
    public function author()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
