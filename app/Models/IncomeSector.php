<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IncomeSector extends Model
{
    use SoftDeletes;
    protected $table = "income_sectors";
}
