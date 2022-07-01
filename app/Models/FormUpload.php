<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\User;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class FormUpload extends Model
{
    use HasFactory, LogsActivity, SoftDeletes;

    protected $fillable = [
        'uuid',
        'disk',
        'upload_type',
        'title',
        'filename',
        'filesize',
        'file_directory',
        'user_id',
        'form_type',
        'form_uploadable_id',
        'form_uploadable_type',
        'form_attached',
        'form_attachable_id',
        'form_attachable_type',
        'is_removable',
        'parent_id',
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
        'form_type',
        'form_uploadable_id',
        'form_uploadable_type',
    ];

    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;

    public static function boot()
    {
        $user = Auth::user();
        parent::boot();
        self::creating(function ($model) use ($user) {
            $model->uuid = (string) Str::uuid();
            $model->user_id = $user->id;
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

    public function form_attachable()
    {
        return $this->morphTo();
    }
}
