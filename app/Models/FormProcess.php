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
        'office_type',
    ];

    protected $casts = [
        'form_routes' => 'array',
    ];
}
