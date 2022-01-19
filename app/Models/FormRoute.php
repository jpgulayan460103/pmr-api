<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Library;
use App\Models\User;

class FormRoute extends Model
{
    use HasFactory;

    protected $fillable = [
        'route_type',
        'status',
        'remarks',
        'remarks_by_id',
        'origin_office_id',
        'from_office_id',
        'to_office_id',
        'form_routable_id',
        'form_routable_type',
        'form_process_id',
    ];

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
        return $this->belongsTo(User::class, 'remarks_by_id');
    }
}
