<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\RequisitionIssue;
use App\Models\Item;

class RequisitionIssueItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'requisition_issue_id',
        'procurement_plan_item_id',
        'unit_of_measure_id',
        'description',
        'item_id',
        'request_quantity',
        'issue_quantity',
        'has_stock',
    ];


    public static function boot()
    {
        parent::boot();
        self::creating(function ($model){
            $model->issue_quantity = 0;
            $model->has_stock = 0;
        });
        self::updating(function($model) {

        });
    }

    public function requisition_issue()
    {
        return $this->belongsTo(RequisitionIssue::class);
    }
    public function procurement_plan_item()
    {
        return $this->belongsTo(ProcurementPlanItem::class);
    }
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
    public function unit_of_measure()
    {
        return $this->belongsTo(Library::class);
    }

}
