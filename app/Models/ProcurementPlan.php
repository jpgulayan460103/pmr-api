<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\FormProcess;
use App\Models\Library;
use App\Models\FormRoute;
use App\Models\ProcurementPlanItem;

class ProcurementPlan extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;
    
    protected $fillable = [
        'annex',
        'status',
        'remarks',
        'total',
        'is_supplemental',
        'created_by_id',
        'end_user_id',
        'prepared_by_name',
        'prepared_by_position',
        'certified_by_name',
        'certified_by_position',
        'approved_by_name',
        'approved_by_position',
    ];

    public function form_process()
    {
        return $this->morphOne(FormProcess::class, 'form_processable');
    }

    public function form_routes()
    {
        return $this->morphMany(FormRoute::class, 'form_routable');
    }

    public function end_user()
    {
        return $this->belongsTo(Library::class);
    }

    public function items()
    {
        return $this->hasMany(ProcurementPlanItem::class);
    }
    
}
