<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkOrder extends Model
{
    use SoftDeletes;
    protected $table = "work_orders";

    public function service() {
        return $this->belongsTo(OurService::class,'service_id','id');
    }

    public function client() {
        return $this->belongsTo(Client::class,'client_id','id');
    }

    public static function getOrderId()
    {
        $lastOrderId = WorkOrder::latest('id')->whereNotNull('order_id')->first();
        $newOrderId = str_pad(1, 4, "0", STR_PAD_LEFT);
        if ($lastOrderId) {
            $lastOrderNumber = $lastOrderId->order_id;
            if ($lastOrderNumber != null) {
                $newSerialNumber = $lastOrderNumber + 1;
                $newOrderId = str_pad($newSerialNumber, 4, "0", STR_PAD_LEFT);;
            } else {
                $newOrderId = str_pad(1, 4, "0", STR_PAD_LEFT);
            }
        }
        if (WorkOrder::where('order_id', $newOrderId)->exists()) {
            WorkOrder::getOrderId();
        }
        return $newOrderId;
    }
}
