<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FormRoute;

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
        'is_complete',
        'completed_date',
    ];

    protected $casts = [
        'form_routes' => 'array',
    ];

    public function form_processable()
    {
        return $this->morphTo();
    }

    public function routes()
    {
        return $this->hasMany(FormRoute::class);
    }
    
}
