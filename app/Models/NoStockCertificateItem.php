<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoStockCertificateItem extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'no_stock_certificate_id',
        'description',
        'unit_of_measure',
        'quantity',
    ];

    public function no_stock_certificate()
    {
        return $this->belongsTo(NoStockCertificate::class);
    }
}
