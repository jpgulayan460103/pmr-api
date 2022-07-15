<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\PurchaseOrder;
use App\Models\PurchaseRequestItem;
use App\Models\Library;
use App\Models\User;
use App\Models\Quotation;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class PurchaseRequest extends Model
{
    use HasFactory, LogsActivity, SoftDeletes;
    protected $fillable = [
        'pr_number', //BUDRP-PR-2022-02-00001
        'gen_number',
        'purpose',
        'title',
        'fund_cluster',
        'center_code',
        'total_cost',
        'pr_dir',
        'end_user_id',
        'account_id',
        'status',
        'remarks',
        'pr_date',
        'mode_of_procurement_id',
        'uacs_code_id',
        'charge_to',
        'alloted_amount',
        'sa_or',
        'bac_task_id',    
        'requested_by_id',
        'requested_by_name',
        'requested_by_designation',
        'approved_by_id',
        'approved_by_name',
        'approved_by_designation',
        'created_by_id',
        'requisition_issue_id',
        'from_ppmp',
    ];

    public $logAttributesToIgnore = [
        'status',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logFillable()
        ->logOnly(['account.name','mode_of_procurement.name', 'end_user.name', 'uacs_code.name'])
        ->logOnlyDirty()
        ->dontSubmitEmptyLogs()
        ->logExcept($this->logAttributesToIgnore);
    }

    public static function boot()
    {
        $user = Auth::user();
        parent::boot();
        self::creating(function ($model) use ($user) {
            $model->uuid = (string) Str::uuid();
            $model->created_by_id = $user->id;
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
    public function account()
    {
        return $this->belongsTo(Library::class)->withDefault(true);
    }
    public function mode_of_procurement()
    {
        return $this->belongsTo(Library::class);
    }
    
    public function uacs_code()
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

    public function created_by()
    {
        return $this->belongsTo(User::class);
    }

    public function form_process()
    {
        return $this->morphOne(FormProcess::class, 'form_processable');
    }
    public function form_routes()
    {
        return $this->morphMany(FormRoute::class, 'form_routable');
    }
    public function form_uploads()
    {
        return $this->morphMany(FormUpload::class, 'form_uploadable')->orderBy('id','desc');
    }

    public function quotations()
    {
        return $this->hasMany(Quotation::class);
    }
    public function requisition_issue()
    {
        return $this->belongsTo(RequisitionIssue::class);
    }
}
