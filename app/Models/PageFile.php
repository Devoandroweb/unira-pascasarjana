<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageFile extends Model
{
    use HasFactory;
    protected $guarded = ["id"];

    function sizeFile(){
        return formatSizeUnits($this->size);
    }
}
