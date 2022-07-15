<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserOffice;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Str;

class Library extends Model
{
    use HasFactory, LogsActivity, SoftDeletes;

    protected $fillable = [
        'library_type',
        'name',
        'title',
        'is_active',
        'parent_id',
    ];



    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logFillable()
        ->logOnlyDirty()
        ->dontSubmitEmptyLogs();
    }

    protected $casts = [
        // 'is_active' => 'boolean',
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->is_active = 1;
            $model->uuid = (string) Str::uuid();
        });
        self::updating(function($model) {

        });
    }

    protected $with = array('parent');

    public function parent()
    {
        return $this->belongsTo(Library::class);
    }

    public function user_office()
    {
        return $this->hasOne(UserOffice::class, 'office_id');
    }

    public function children()
    {
        return $this->hasMany(Library::class, 'parent_id')->orderBy('name');
    }
}
