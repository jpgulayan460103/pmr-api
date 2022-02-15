<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\PurchaseOrder;
use App\Models\PurchaseRequestItem;
use App\Models\Library;
use App\Models\UserOffice;
use App\Models\Quotation;
use Carbon\Carbon;
use Spatie\Activitylog\Traits\LogsActivity;

class PurchaseRequest extends Model
{
    use HasFactory, LogsActivity;
    protected $fillable = [
        'purchase_request_uuid',
        'purchase_request_number',
        'purpose',
        'fund_cluster',
        'center_code',
        'total_cost',
        'pr_dir',
        'end_user_id',
        'purchase_request_type_id',
        'status',
        'pr_date',
        'mode_of_procurement_id',
        'uacs_code',
        'charge_to',
        'alloted_amount',
        'sa_or',
        'bac_task_id',    
        'requested_by_id',
        'approved_by_id',
        'process_complete_status',
        'process_complete_date',
    ];

    protected static $logAttributes = [
        '*',
        'approved_by.name',
        'requested_by.name',
        'end_user.name',
        'mode_of_procurement.name',
        'purchase_request_type.name',
    ];

    protected static $logAttributesToIgnore = [
        'purchase_request_uuid',
        'purchase_request_type_id',
        'process_complete_date',
        'process_complete_status',
        'bac_task_id',
        'end_user_id',
        'requested_by_id',
        'approved_by_id',
        'mode_of_procurement_id',
        'id',
        'pending',
        'created_at',
        'updated_at',
    ];

    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->purchase_request_uuid = (string) Str::uuid();
            $model->status = 'Pending';
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
    public function purchase_request_type()
    {
        return $this->belongsTo(Library::class);
    }
    public function mode_of_procurement()
    {
        return $this->belongsTo(Library::class);
    }

    public function setPrDateAttribute($value)
    {
        $this->attributes['pr_date'] = Carbon::parse($value);
    }

    public function requested_by()
    {
        return $this->belongsTo(Library::class);
    }

    public function approved_by()
    {
        return $this->belongsTo(Library::class);
    }

    public function form_process()
    {
        return $this->morphOne(FormProcess::class, 'form_processable');
    }
    public function form_routes()
    {
        return $this->morphMany(FormRoute::class, 'form_routable');
    }

    public function quotations()
    {
        return $this->hasMany(Quotation::class);
    }
}
