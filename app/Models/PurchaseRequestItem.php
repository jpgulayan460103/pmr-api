<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Library;
use Spatie\Activitylog\Traits\LogsActivity;

class PurchaseRequestItem extends Model
{
    use HasFactory, LogsActivity;
    protected $fillable = [
        'item_name',
        'item_code',
        'item_id',
        'quantity',
        'unit_cost',
        'unit_of_measure_id',
        'total_unit_cost',
        'purchase_request_id',
    ];

    protected static $logAttributes = [
        '*',
        'unit_of_measure.name',
    ];

    protected static $logAttributesToIgnore = [
        'created_at',
        'updated_at'
    ];

    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;

    public function unit_of_measure()
    {
        return $this->belongsTo(Library::class);
    }
}
