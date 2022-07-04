<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\PurchaseRequest;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class BacTask extends Model
{
    use HasFactory, LogsActivity, SoftDeletes;
    protected $fillable = [
        'purchase_request_id',
        'bac_task_uuid',
        'preproc_conference',
        'post_of_ib',
        'prebid_conf',
        'eligibility_check',
        'open_of_bids',
        'bid_evaluation',
        'post_qual',
        'notice_of_award',
        'contract_signing',
        'notice_to_proceed',
        'estimated_ldd',
        'abstract_of_qoutations',
    ];



    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logFillable()
        ->logOnlyDirty()
        ->dontSubmitEmptyLogs();
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->bac_task_uuid = (string) Str::uuid();
        });
    }

    public function purchase_request()
    {
        return $this->belongsTo(PurchaseRequest::class);
    }
}
