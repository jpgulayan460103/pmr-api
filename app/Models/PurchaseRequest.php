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

class PurchaseRequest extends Model
{
    use HasFactory, LogsActivity, SoftDeletes;
    protected $fillable = [
        'uuid',
        'purchase_request_number', //BUDRP-PR-2022-02-00001
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
        'approved_by_id',
        'created_by_id',
    ];

    protected static $logAttributes = [
        '*',
        'approved_by.name',
        'requested_by.name',
        'end_user.name',
        'account.parent.name',
        'account.name',
        'mode_of_procurement.name',
        'uacs_code.name',
    ];

    protected static $logAttributesToIgnore = [
        'uuid',
        'account_id',
        'bac_task_id',
        'end_user_id',
        'requested_by_id',
        'approved_by_id',
        'mode_of_procurement_id',
        'uacs_code_id',
        'created_by_id',
        'id',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;

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
}
