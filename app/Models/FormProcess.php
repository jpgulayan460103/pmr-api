<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormProcess extends Model
{
    use HasFactory;
    protected $fillable = [
        'process_description',
        'form_routes',
        'form_type',
        'office_id',
        'form_processable_id',
        'form_processable_type',
    ];

    protected $casts = [
        'form_routes' => 'array',
    ];

    public function form_processable()
    {
        return $this->morphTo();
    }

    public function getFormRoutesAttribute($value)
    {
        return json_decode(json_decode($value));
    }
}
