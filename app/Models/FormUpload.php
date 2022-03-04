<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\User;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormUpload extends Model
{
    use HasFactory, LogsActivity, SoftDeletes;

    protected $fillable = [
        'upload_uuid',
        'upload_type',
        'title',
        'filename',
        'filesize',
        'file_directory',
        'user_id',
        'form_uploadable_id',
        'form_uploadable_type',
    ];

    protected static $logAttributes = [
        '*',
        'form_uploadable.uuid'
    ];

    protected static $logAttributesToIgnore = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
        'user_id',
        'filename',
        'filesize',
        'upload_type',
        'form_uploadable_id',
        'form_uploadable_type',
    ];

    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->upload_uuid = (string) Str::uuid();
        });
        self::updating(function($model) {

        });
    }

    public function uploader()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function form_uploadable()
    {
        return $this->morphTo();
    }
}
