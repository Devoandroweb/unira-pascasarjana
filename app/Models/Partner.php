<?php

namespace App\Models;

use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Partner extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = ['id'];

    function getLogo()
    {
       
        if ($this->logo && File::exists(storage_path("app/public/" . $this->photo))) {
                return url("storage/" . $this->logo);
        }
        return asset('/landing/image/no-image.png');
    }
}
