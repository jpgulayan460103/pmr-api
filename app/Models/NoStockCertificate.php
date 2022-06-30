<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class NoStockCertificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'cnas_number',
        'cnas_date',
    ];

    public static function boot()
    {
        $user = Auth::user();
        parent::boot();
        self::creating(function ($model) use ($user) {
            $model->uuid = (string) Str::uuid();
            $model->user_id = $user->id;
        });
        self::updating(function($model) {

        });
    }

    public function items()
    {
        return $this->hasMany(NoStockCertificateItem::class);
    }
}
