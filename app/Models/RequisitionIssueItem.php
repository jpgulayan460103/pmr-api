<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\RequisitionIssue;
use App\Models\Item;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class RequisitionIssueItem extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $fillable = [
        'requisition_issue_id',
        'procurement_plan_item_id',
        'unit_of_measure_id',
        'description',
        'remarks',
        'item_id',
        'request_quantity',
        'issue_quantity',
        'has_stock',
        'has_issued_item',
        'is_pr_recommended',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logFillable()
        ->logOnlyDirty()
        ->dontSubmitEmptyLogs();
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model){
            $model->issue_quantity = 0;
            $model->has_stock = 0;
            $model->is_pr_recommended = 1;
            $model->has_issued_item = 0;
            $model->remarks = "";
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
