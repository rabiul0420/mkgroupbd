<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;
    protected $tabale = "tasks";
    protected $appends = ['text_color','bg_color'];

    public function getTextColorAttribute() {
        if($this->status == "Pending") {
            return 'rgb(234, 84, 85)';
        } elseif($this->status == "In-Progress") {
            return 'yellow';
        } else {
            return 'white';
        }
    }

    public function getBgColorAttribute() {
        if($this->status == "Pending") {
            return '#FCEAEA';
        } elseif($this->status == "In-Progress") {
            return 'yellow';
        } else {
            return 'green';
        }
    }

    public function user() {
        return $this->belongsTo(User::class,'assigned_to','id');
    }
}
