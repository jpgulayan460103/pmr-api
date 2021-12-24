<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Library;

class PurchaseRequestItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'item_name',
        'item_code',
        'item_id',
        'quantity',
        'unit_cost',
        'unit_of_measure_id',
        'total_unit_cost',
    ];

    public function unit_of_measure()
    {
        return $this->belongsTo(Library::class);
    }
}
