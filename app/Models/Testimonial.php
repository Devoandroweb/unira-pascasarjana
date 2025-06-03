<?php

namespace App\Models;

use App\Traits\CreatedBy;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Testimonial extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];
    function getPhoto()
    {
        if ($this->photo && File::exists(storage_path("app/public/" . $this->photo))) {
            return url("storage/" . $this->photo);
        }
        
        return asset('/dashboard/images/users/avatar-11.jpg');
    }
    
}
