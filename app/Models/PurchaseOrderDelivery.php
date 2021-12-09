<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\PurchaseOrder;

class PurchaseOrderDelivery extends Model
{
    use HasFactory;
    protected $fillable = [
        'purchase_request_id',
        'purchase_order_id',
        'purchase_order_delivery_uuid',
        'delivery_date',
        'delivery_completion',
        'delivery_receipt_dir',
    ];
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->purchase_order_delivery_uuid = (string) Str::uuid();
        });
    }

    public function purchase_order()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }
}
