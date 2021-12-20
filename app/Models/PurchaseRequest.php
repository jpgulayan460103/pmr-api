<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\PurchaseOrder;

class PurchaseRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'purchase_request_uuid',
        'code_uacs',
        'purchase_request_number',
        'particulars',
        'pr_dir',
        'end_user',
        'types',
        'mode_of_procurement',
    ];
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->purchase_request_uuid = (string) Str::uuid();
        });
    }

    public function purchase_orders()
    {
        return $this->hasMany(PurchaseOrder::class);
    }

    public function bac_task()
    {
        return $this->hasOne(BacTask::class);
    }
}
