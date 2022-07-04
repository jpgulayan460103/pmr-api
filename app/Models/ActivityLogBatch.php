<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLogBatch extends Model
{
    use HasFactory;
    
    protected $connection = 'mysql_log';

    protected $fillable = [
        'batch_uuid',
        'form_type',
        'subject_type',
        'subject_id'
    ];

    public function subject()
    {
        return $this->setConnection('mysql')->morphTo();
    }

    public function logs()
    {
        return $this->setConnection($this->connection)->hasMany(ActivityLog::class, 'batch_uuid', 'batch_uuid');
    }
}
