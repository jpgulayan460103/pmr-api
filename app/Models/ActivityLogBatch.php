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
        'subject_type',
        'subject_id'
    ];

    public function subject()
    {
        return $this->setConnection($this->connection)->morphTo();
    }
}
