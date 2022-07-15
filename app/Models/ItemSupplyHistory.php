<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Item;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class ItemSupplyHistory extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;
    protected $fillable = [
        'item_supply_id',
        'movement_quantity',
        'remaining_quantity',
        'movement_type',
        'form_sourceable_id',
        'form_sourceable_type',
        'form_source',
        'remarks',
    ];

    protected $with = ['item_supply'];

    public function item_supply()
    {
        return $this->belongsTo(ItemSupply::class);
    }

    public function form_sourceable()
    {
        return $this->morphTo();
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logFillable()
        ->logOnly(['item_supply.item_name'])
        ->logOnlyDirty()
        ->dontSubmitEmptyLogs();
    }
}
