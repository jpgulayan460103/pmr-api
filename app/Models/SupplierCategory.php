<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Supplier;
use App\Models\Library;

class SupplierCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'supplier_id',
        'category_id',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    
    public function category()
    {
        return $this->belongsTo(Library::class);
    }
}
