<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Library;
use App\Models\PurchaseRequest;
use Illuminate\Support\Str;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;

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
    
    ];
    protected $fillable = [
        'item_name',
        'description',
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



    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logFillable()
        ->logOnlyDirty()
        ->dontSubmitEmptyLogs();
    }

    public function unit_of_measure()
    {
        return $this->belongsTo(Library::class);
    }
    public function purchase_request()
    {
        return $this->belongsTo(PurchaseRequest::class, 'purchase_request_id');
    }
}
