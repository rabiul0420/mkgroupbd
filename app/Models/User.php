<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','mobile', 'password','online_status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = array('menu_ids','activity_ids');

    /**
     * Get activity ids
     */
    public function getMenuIdsAttribute() {
        return UserPermission::where('user_id',$this->id)->pluck('menu_id')->toArray();
    }

    /**
     * Get menu ids
     */
    public function getActivityIdsAttribute() {
        return UserPermission::where('user_id',$this->id)->pluck('activity_id')->toArray();
    }

    public function designation() {
        return $this->belongsTo(EmployeeDesignation::class,'designation_id','id');
    }

    public static function getEmployeeId()
    {
        $lastEmployeeId = User::latest('id')->whereNotNull('employee_id')->first();
        $newEmployeeId = str_pad(1, 4, "0", STR_PAD_LEFT);
        if ($lastEmployeeId) {
            $lastOrderNumber = $lastEmployeeId->employee_id;
            if ($lastOrderNumber != null) {
                $newSerialNumber = $lastOrderNumber + 1;
                $newEmployeeId = str_pad($newSerialNumber, 4, "0", STR_PAD_LEFT);;
            } else {
                $newEmployeeId = str_pad(1, 4, "0", STR_PAD_LEFT);
            }
        }
        if (User::where('employee_id', $newEmployeeId)->exists()) {
            User::getMemberId();
        }
        return $newEmployeeId;
    }
}
