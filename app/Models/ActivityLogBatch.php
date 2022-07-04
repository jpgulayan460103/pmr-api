<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ActivityLogBatch extends Model
{
    use HasFactory;
    
    protected $connection = 'mysql_log';

    protected $fillable = [
        'batch_uuid',
        'form_type',
        'subject_type',
        'subject_id',
        'user_id',
    ];

    public static function boot()
    {
        $user = Auth::user();
        parent::boot();
        self::creating(function ($model) use ($user) {
            $model->causer_id = $user->id;
            $model->causer_type = get_class($user);
        });
        self::updating(function($model) {

        });
    }

    public function subject()
    {
        return $this->setConnection('mysql')->morphTo();
    }
    
    public function causer()
    {
        return $this->setConnection('mysql')->morphTo();
    }

    public function logs()
    {
        return $this->setConnection($this->connection)->hasMany(ActivityLog::class, 'batch_uuid', 'batch_uuid');
    }
}
