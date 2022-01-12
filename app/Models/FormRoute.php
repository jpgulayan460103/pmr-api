<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormRoute extends Model
{
    use HasFactory;

    protected $fillable = [
        'route_type',
        'status',
        'remarks',
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
}
