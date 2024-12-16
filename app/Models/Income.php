<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Income extends Model
{
    use SoftDeletes;
    protected $table = "incomes";
    protected $appends = ['type'];

    public function getTypeAttribute() {
        return "Income";
    }

    public function user() {
        return $this->belongsTo(User::class,'received_by','id');
    }
    public function added_by() {
        return $this->belongsTo(User::class,'added_by','id');
    }

    public function income_sector() {
        return $this->belongsTo(IncomeSector::class,'income_sector_id','id');
    }

}
