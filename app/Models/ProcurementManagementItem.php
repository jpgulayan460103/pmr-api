<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Item;

class ProcurementManagementItem extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'procurement_management_id',
        'procurement_plan_item_id',
        'item_id',
        'mon1',
        'mon2',
        'mon3',
        'mon4',
        'mon5',
        'mon6',
        'mon7',
        'mon8',
        'mon9',
        'mon10',
        'mon11',
        'mon12',
        'price',
        'total_quantity',
        'total_price',
        'form_type',
        'form_sourceable_id',
        'form_sourceable_type',
    ];

    public function procurement_management()
    {
        return $this->belongsTo(ProcurementManagement::class);
    }
    public function procurement_plan_item()
    {
        return $this->belongsTo(ProcurementPlanItem::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function form_sourceable()
    {
        return $this->morphTo();
    }
}
