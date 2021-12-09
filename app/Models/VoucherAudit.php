<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Voucher;

class VoucherAudit extends Model
{
    use HasFactory;
    protected $fillable = [
        'voucher_id',
        'voucher_audit_uuid',
        'voucher_number',
        'status',
        'department',
        'user_id',
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->voucher_audit_uuid = (string) Str::uuid();
        });
    }

    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }
}
