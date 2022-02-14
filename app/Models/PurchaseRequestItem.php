<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Library;
use Illuminate\Support\Str;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseRequestItem extends Model
{
    use HasFactory, LogsActivity, SoftDeletes;



    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->purchase_request_item_uuid = (string) Str::uuid();
        });
        self::updating(function($model) {

        });
    }

    protected $casts = [
        'is_ppmp' => 'boolean',
    ];
    protected $fillable = [
        'item_name',
        'item_code',
        'item_id',
        'quantity',
        'unit_cost',
        'unit_of_measure_id',
        'total_unit_cost',
        'purchase_request_id',
        'purchase_request_item_uuid',
        'is_ppmp',
    ];

    protected static $logAttributes = [
        '*',
        'unit_of_measure.name',
    ];

    protected static $logAttributesToIgnore = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
        'unit_of_measure_id',
        'purchase_request_id',
        'item_id',
        'purchase_request_item_uuid',
    ];

    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;

    public function unit_of_measure()
    {
        return $this->belongsTo(Library::class);
    }
}
