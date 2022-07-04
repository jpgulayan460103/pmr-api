<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class RequisitionIssue extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $fillable = [
        'title',
        'fund_cluster',
        'center_code',
        'purpose',
        'recommendation',
        'ris_date',
        'ris_number',
        'from_ppmp',
        'status',
        'remarks',
        'created_by_id',
        'end_user_id',
        'requested_by_id',
        'requested_by_name',
        'requested_by_designation',
        'requested_by_date',
        'approved_by_id',
        'approved_by_name',
        'approved_by_designation',
        'approved_by_date',
        'issued_by_name',
        'issued_by_designation',
        'issued_by_date',
        'received_by_name',
        'received_by_designation',
        'received_by_date',
    ];

    public $logAttributesToIgnore = [
        'ris_number',
        'requested_by_date',
        'approved_by_date',
        'received_by_date',
        'status',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logFillable()
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

    public function items()
    {
        return $this->hasMany(RequisitionIssueItem::class);
    }
    public function end_user()
    {
        return $this->belongsTo(Library::class);
    }

}
