<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Item;

class ItemSupplyHistory extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'item_supply_id',
        'movement_quantity',
        'remaining_quantity',
        'movement_type',
        'form_sourceable_id',
        'form_sourceable_type',
        'form_source',
        'remarks',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function form_sourceable()
    {
        return $this->morphTo();
    }
}
