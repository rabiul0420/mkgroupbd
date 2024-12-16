<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use SoftDeletes;
    protected $table = "expenses";

    protected $appends = ['type'];

    public function getTypeAttribute() {
        return "Expense";
    }

    public function category() {
        return $this->belongsTo(ExpenseCategory::class,'category_id','id');
    }

    public function user() {
        return $this->belongsTo(User::class,'responsible_person','id');
    }

    public function work_order() {
        return $this->belongsTo(WorkOrder::class,'work_order_id','id');
    }
}
