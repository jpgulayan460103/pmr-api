<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\ProcurementPlan;
use App\Models\Item;
use App\Models\Library;
use Spatie\Activitylog\LogOptions;

class ProcurementPlanItem extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $fillable = [
        'procurement_plan_id',
        'item_id',
        'unit_of_measure_id',
        'item_type_id',
        'description',
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
    ];



    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logFillable()
        ->logOnly(['unit_of_measure.name', 'item_type.name'])
        ->logOnlyDirty()
        ->dontSubmitEmptyLogs();
    }

    public function procurement_plan()
    {
        return $this->belongsTo(ProcurementPlan::class);
    }
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
    public function unit_of_measure()
    {
        return $this->belongsTo(Library::class);
    }
    public function item_type()
    {
        return $this->belongsTo(Library::class);
    }
}
