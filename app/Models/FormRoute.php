<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Library;
use App\Models\User;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormRoute extends Model
{
    use HasFactory, LogsActivity, SoftDeletes;

    protected $fillable = [
        'route_type',
        'status',
        'remarks',
        'forwarded_remarks',
        'forwarded_by_id',
        'owner_id',
        'processed_by_id',
        'origin_office_id',
        'from_office_id',
        'to_office_id',
        'form_routable_id',
        'form_routable_type',
        'form_process_id',
        'action_taken',
        'route_code',
    ];

    protected static $logAttributes = [
        '*',
    ];

    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;

    
    public function form_routable()
    {
        return $this->morphTo();
    }

    public function end_user()
    {
        return $this->belongsTo(Library::class, 'origin_office_id');
    }

    public function to_office()
    {
        return $this->belongsTo(Library::class, 'to_office_id');
    }

    public function from_office()
    {
        return $this->belongsTo(Library::class, 'from_office_id');
    }

    public function form_process()
    {
        return $this->belongsTo(FormProcess::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'processed_by_id');
    }
    public function forwarded_by()
    {
        return $this->belongsTo(User::class, 'forwarded_by_id');
    }
    public function processed_by()
    {
        return $this->belongsTo(User::class, 'processed_by_id');
    }
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
