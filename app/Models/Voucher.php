<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\PurchaseOrder;
use App\Models\PurchaseRequest;
use App\Models\VoucherAudit;

class Voucher extends Model
{
    use HasFactory;
    protected $fillable = [
        'purchase_request_id',
        'purchase_order_id',
        'voucher_uuid',
        'voucher_number',
        'status',
        'obr_by_budget_dir',
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->voucher_uuid = (string) Str::uuid();
        });
    }

    public function purchase_request()
    {
        return $this->belongsTo(PurchaseRequest::class);
    }

    public function purchase_orders()
    {
        return $this->hasMany(PurchaseOrder::class);
    }

    public function voucher_audits()
    {
        return $this->hasMany(VoucherAudit::class);
    }
    
}
