<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Library;
use App\Models\ItemSupplyHistory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Support\Str;
use Spatie\Activitylog\LogOptions;

class Item extends Model
{
    use HasFactory, LogsActivity, SoftDeletes;
    protected $fillable = [
        'item_name',
        'item_code',
        'item_classification_id',
        'item_category_cse_id',
        'item_type_id',
        'price',
        'unit_of_measure_id',
        'is_active',
        'is_article',
        'uuid',
    ];



    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logFillable()
        ->logOnlyDirty()
        ->dontSubmitEmptyLogs();
    }

    protected $casts = [];

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

    public function item_category()
    {
        return $this->belongsTo(Library::class);
    }

    public function item_type()
    {
        return $this->belongsTo(Library::class);
    }

    public function unit_of_measure()
    {
        return $this->belongsTo(Library::class);
    }
    
    public function item_classification()
    {
        return $this->belongsTo(Library::class);
    }
    
    public function item_category_cse()
    {
        return $this->belongsTo(Library::class);
    }
}
