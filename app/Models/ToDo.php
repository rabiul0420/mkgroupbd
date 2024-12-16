<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ToDo extends Model
{
    use SoftDeletes;
    protected $table = "to_dos";
    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
