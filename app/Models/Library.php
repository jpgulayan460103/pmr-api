<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserOffice;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

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


    protected static $logAttributes = [
        '*',
        'parent.name',
    ];

    protected static $logAttributesToIgnore = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;


    protected $casts = [
        // 'is_active' => 'boolean',
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->is_active = 1;
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
