<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Quotation;
use App\Models\PurchaseRequestItem;

class QuotationItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'quotation_id',
        'purchase_request_item_id',
        'suppliers_specifications',
        'quantity',
        'unit_cost',
        'total_unit_cost',
    ];
    public function quotation()
    {
        return $this->belongsTo(Quotation::class);
    }
    public function purchase_request_item()
    {
        return $this->belongsTo(PurchaseRequestItem::class);
    }
}
