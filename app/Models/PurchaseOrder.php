<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\PurchaseRequest;
use App\Models\PurchaseOrderDelivery;
use App\Models\Library;

class PurchaseOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'purchase_request_id',
        'purchase_order_uuid',
        'purchase_order_number',
        'purchase_order_dir',
        'name_of_supplier',
        'iar_dir',
        'receipt_dir',
        'receipt_number',
        'type_of_equipment',
        'attendance',
        'certificate_of_acceptance',
        'certificate_of_occupancy',
        'certificate_of_completion',
    ];
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->purchase_order_uuid = (string) Str::uuid();
        });
    }

    public function purchase_request()
    {
        return $this->belongsTo(PurchaseRequest::class);
    }

    public function purchase_order_delieveries()
    {
        return $this->hasMany(PurchaseOrderDelivery::class);
    }
}
