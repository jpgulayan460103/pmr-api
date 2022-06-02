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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProcurementPlan extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;
    
    protected $fillable = [
        'annex',
        'status',
        'remarks',
        'total_price',
        'inflation',
        'contingency',
        'total_estimated_budget',
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

    public static function boot()
    {
        $user = Auth::user();
        parent::boot();
        self::creating(function ($model) use ($user) {
            $model->uuid = (string) Str::uuid();
            $model->created_by_id = $user->id;
            $model->status = 'Pending';
        });
        self::updating(function($model) {

        });
    }

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
