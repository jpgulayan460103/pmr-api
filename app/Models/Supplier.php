<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SupplierContact;
use App\Models\Quotation;

class Supplier extends Model
{
    use HasFactory;
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
}
