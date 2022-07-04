<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class ActivityLog extends Model
{
    use HasFactory;

    protected $connection = env('ACTIVITY_LOGGER_DB_CONNECTION', 'mysql');

    public function user()
    {
        return $this->setConnection($this->connection)->belongsTo(User::class, 'causer_id');
    }
    
    public function subject()
    {
        return $this->setConnection($this->connection)->morphTo();
    }
}
