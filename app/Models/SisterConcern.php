<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SisterConcern extends Model
{
    use SoftDeletes;
    protected $table = "sister_concerns";
}
