<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Support\Str;
use Spatie\Activitylog\LogOptions;

class ItemSupply extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $fillable = [
        'item_name',
        'item_category_id',
        'unit_of_measure_id',
        'is_active',
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->is_active = 1;
            $model->uuid = (string) Str::uuid();
        });
        self::updating(function($model) {

        });
    }



    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logFillable()
        ->logOnly(['unit_of_measure.name', 'item_category.name'])
        ->logOnlyDirty()
        ->dontSubmitEmptyLogs();
    }

    public function item_supply_histories()
    {
        return $this->hasMany(ItemSupplyHistory::class);
    }

    public function remaining_quantity()
    {
        return $this->hasOne(ItemSupplyHistory::class)->select(
            DB::raw("SUM(movement_quantity) as quantity"),
            'item_supply_id'
        )->groupBy('item_supply_id');
    }

    public function item_category()
    {
        return $this->belongsTo(Library::class);
    }

    public function unit_of_measure()
    {
        return $this->belongsTo(Library::class);
    }
}
