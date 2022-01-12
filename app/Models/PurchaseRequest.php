<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\PurchaseOrder;
use App\Models\PurchaseRequestItem;
use App\Models\Library;
use App\Models\Signatory;
use Carbon\Carbon;

class PurchaseRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'purchase_request_uuid',
        'code_uacs',
        'purchase_request_number',
        'purpose',
        'fund_cluster',
        'center_code',
        'total_cost',
        'pr_dir',
        'end_user_id',
        'purchase_request_type',
        'status',
        'mode_of_procurement',
        'pr_date',
        'bac_task_id',    
        'requested_by_id',
        'approved_by_id',
    ];
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->purchase_request_uuid = (string) Str::uuid();
            $model->status = 'unapproved';
        });
        self::updating(function($model) {

        });
    }
    

    public function purchase_orders()
    {
        return $this->hasMany(PurchaseOrder::class);
    }

    public function items()
    {
        return $this->hasMany(PurchaseRequestItem::class);
    }

    public function bac_task()
    {
        return $this->hasOne(BacTask::class);
    }

    public function end_user()
    {
        return $this->belongsTo(Library::class);
    }

    public function setPrDateAttribute($value)
    {
        $this->attributes['pr_date'] = Carbon::parse($value);
    }

    public function requested_by()
    {
        return $this->belongsTo(Signatory::class);
    }

    public function approved_by()
    {
        return $this->belongsTo(Signatory::class);
    }

    public function form_proccess()
    {
        return $this->morphOne(FormProcess::class, 'form_processable');
    }
    public function form_routes()
    {
        return $this->morphOne(FormRoute::class, 'form_routable');
    }
}
