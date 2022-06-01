<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Library;
use App\Models\ItemCategory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Item extends Model
{
    use HasFactory, LogsActivity, SoftDeletes;
    protected $fillable = [
        'item_name',
        'item_code',
        'item_category_id',
        'item_type_id',
        'price',
        'unit_of_measure_id',
        'is_active',
    ];

    protected $casts = [];

    protected static $logAttributes = [
        '*',
        'unit_of_measure.name',
        'item_category.name',
        'item_type.name',
    ];

    protected static $logAttributesToIgnore = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->is_active = 1;
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
}
