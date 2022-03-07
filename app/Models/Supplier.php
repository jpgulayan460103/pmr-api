<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SupplierContact;
use App\Models\SupplierCategory;
use App\Models\Quotation;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'address',
    ];

    public function contacts()
    {
        return $this->hasMany(SupplierContact::class);
    }

    public function quotations()
    {
        return $this->hasMany(Quotation::class);
    }
    
    public function categories()
    {
        return $this->hasMany(SupplierCategory::class);
    }
}
