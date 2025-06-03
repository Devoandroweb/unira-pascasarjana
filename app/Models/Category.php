<?php

namespace App\Models;

use App\Traits\CreatedBy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, SoftDeletes, CreatedBy;

    protected $guarded = ['id'];

    public function scopeGetByUser($query, $role)
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
}
