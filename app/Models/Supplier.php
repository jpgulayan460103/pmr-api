<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SupplierContact;
use App\Models\SupplierCategory;
use App\Models\Quotation;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Supplier extends Model
{
    use HasFactory, LogsActivity, SoftDeletes;
    protected $fillable = [
        'name',
        'address',
    ];

    protected static $logAttributes = [
        '*',
    ];

    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;

    public function contacts()
    {
        return $this->hasMany(SupplierContact::class);
    }

    public function quotations()
    {
        return $this->hasMany(Quotation::class);
    }
    
    public function categories()
    {
        return $this->hasMany(SupplierCategory::class);
    }
}
