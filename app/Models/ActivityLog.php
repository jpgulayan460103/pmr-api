<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class ActivityLog extends Model
{
    use HasFactory;

    protected $connection = 'mysql_log';

    public function user()
    {
        return $this->setConnection('mysql')->belongsTo(User::class, 'causer_id');
    }
    
    public function subject()
    {
        return $this->setConnection('mysql')->morphTo();
    }
}
