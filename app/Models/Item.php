<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Library;
use App\Models\ItemCategory;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'item_name',
        'item_code',
        'item_category_id',
        'unit_of_measure_id',
        'is_ppmp',
    ];

    protected $casts = [
        'is_ppmp' => 'boolean',
    ];

    public function item_category()
    {
        return $this->belongsTo(Library::class);
    }

    public function unit_of_measure()
    {
        return $this->belongsTo(Library::class);
    }
}
