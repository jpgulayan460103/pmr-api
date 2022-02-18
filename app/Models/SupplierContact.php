<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Supplier;

class SupplierContact extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'address',
        'email_address',
        'contact_number',
        'supplier_id',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
