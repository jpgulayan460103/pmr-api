<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $connection = 'mysql_notification';

    protected $fillable = [
        'user_id',
        'message',
        'status'
    ];

    protected $casts = [
        'message' => 'array',
        // 'created_at' => "datetime:F d, Y",
        
    ];

    public function user()
    {
        return $this->setConnection('mysql')->belongsTo(User::class, 'causer_id');
    }

}
