<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asset extends Model
{
    use SoftDeletes;
    protected $table = "assets";
    protected $fillable = ['bank_account_holder_name','bank_name','bank_account_number','bank_branch_name','current_balance'];

    public function inventories() {
        return $this->hasMany(AssetInventory::class,'asset_id','id');
    }

    public function notes() {
        return $this->hasMany(AssetNote::class,'asset_id','id');
    }
}
