<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class SupplierContact extends Model
{
    use HasFactory, LogsActivity, SoftDeletes;
    protected $fillable = [
        'name',
        'email_address',
        'contact_number',
        'supplier_id',
    ];

    protected static $logAttributes = [
        '*',
    ];

    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;

    protected static $logAttributesToIgnore = [
        'id',
        'created_at',
        'supplier_id',
        'updated_at',
        'deleted_at',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
