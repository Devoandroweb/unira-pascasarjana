<?php

namespace App\Models;

use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lecturer extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

    function getPhoto()
    {
        if ($this->photo && File::exists(storage_path("app/public/" . $this->photo))) {
            return url("storage/" . $this->photo);
        }
        return asset('/images/users/avatar-11.jpg');
    }

    function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

  
}
