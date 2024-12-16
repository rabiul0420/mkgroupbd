<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;
    protected $table = "events";
    protected $appends = ['thumbnail_image'];

    public function getThumbnailImageAttribute() {
        return EventPhoto::where('event_id',$this->id)->latest()->first()->photo_path;
    }

    public function category() {
        return $this->belongsTo(EventCategory::class,'category_id','id');
    }

    public function photos() {
        return $this->hasMany(EventPhoto::class,'event_id','id');
    }
}
