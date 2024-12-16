<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPermission extends Model
{
    protected $table = 'user_permissions';
    protected $guarded = [];
    protected $appends = ['menu_name','activity_name'];

    public function getMenuNameAttribute() {
        return Menu::where('id',$this->menu_id)->first()->name ?? 'Unknown';
    }

    public function getActivityNameAttribute() {
        return MenuActivity::where('id',$this->activity_id)->first()->activity_name ?? 'Unknown';
    }
}
