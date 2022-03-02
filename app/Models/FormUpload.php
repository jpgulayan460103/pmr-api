<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class FormUpload extends Model
{
    use HasFactory;

    protected $fillable = [
        'upload_uuid',
        'upload_type',
        'title',
        'filename',
        'file_directory',
        'user_id',
        'form_uploadable_id',
        'form_uploadable_type',
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->upload_uuid = (string) Str::uuid();
        });
        self::updating(function($model) {

        });
    }
}
