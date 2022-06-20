<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use App\Models\Library;
use App\Models\ProcurementManagementItem;
use Illuminate\Support\Facades\DB;

class ProcurementManagement extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'end_user_id',
        'calendar_year',
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
        self::updating(function($model) {

        });
    }

    public function end_user()
    {
        return $this->belongsTo(Library::class);
    }

    public function items()
    {
        return $this->hasMany(ProcurementManagementItem::class)
        ->select(
            'procurement_management_items.procurement_management_id',
            'procurement_management_items.procurement_plan_item_id',
            DB::raw('round(sum(total_price), 2) as total_price'),
            DB::raw('sum(total_quantity) as total_quantity'),
            DB::raw('sum(mon1) as mon1'),
            DB::raw('sum(mon2) as mon2'),
            DB::raw('sum(mon3) as mon3'),
            DB::raw('sum(mon4) as mon4'),
            DB::raw('sum(mon5) as mon5'),
            DB::raw('sum(mon6) as mon6'),
            DB::raw('sum(mon7) as mon7'),
            DB::raw('sum(mon8) as mon8'),
            DB::raw('sum(mon9) as mon9'),
            DB::raw('sum(mon10) as mon10'),
            DB::raw('sum(mon11) as mon11'),
            DB::raw('sum(mon12) as mon12'),
        )
        ->groupBy('procurement_plan_item_id');
        
    }

}
