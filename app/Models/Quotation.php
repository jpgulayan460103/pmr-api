<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Supplier;
use App\Models\SupplierContact;
use App\Models\Users;
use App\Models\PurchaseRequest;
use App\Models\QuotationItem;
use Illuminate\Support\Str;

class Quotation extends Model
{
    use HasFactory;
    protected $fillable = [
        'rfq_number',
        'rfq_date',
        'rfq_uuid',
        'purchase_request_id',
        'supplier_id',
        'supplier_contact_id',
        'prepared_by_id',
        'total_amount',
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->rfq_uuid = (string) Str::uuid();
        });
        self::updating(function($model) {

        });
    }

    public function items()
    {
        return $this->hasMany(QuotationItem::class);
    }

    public function purchase_request()
    {
        return $this->belongsTo(PurchaseRequest::class);
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function supplier_contact()
    {
        return $this->belongsTo(SupplierContact::class);
    }

    public function prepared_by()
    {
        return $this->belongsTo(Users::class);
    }
}
