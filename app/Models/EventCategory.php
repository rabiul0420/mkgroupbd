<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventCategory extends Model
{
    use SoftDeletes;
    protected $table = "event_categories";

    public function events() {
        return $this->HasMany(Event::class,'category_id','id');
    }
}
