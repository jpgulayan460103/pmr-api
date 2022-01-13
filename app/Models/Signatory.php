<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Library;
use App\Models\User;

class Signatory extends Model
{
    use HasFactory;

    protected $fillable = [
        'office_id',
        'user_id',
        'designation',
        'title',
        'signatory_type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function office()
    {
        return $this->belongsTo(Library::class);
    }

    public function setSignatoryTypeAttribute($value)
    {
        $this->attributes['signatory_type'] = ( isset($value) && trim($value) != "") ? $value: "Personnel";
    }
}
