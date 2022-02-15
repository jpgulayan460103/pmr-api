<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Library;
use App\Models\User;

class UserOffice extends Model
{
    use HasFactory;

    protected $fillable = [
        'office_id',
        'user_id',
        'designation',
        'position_id',
        'title',
        'user_office_type',
        'user_office_name',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function office()
    {
        return $this->belongsTo(Library::class);
    }
    
    public function position()
    {
        return $this->belongsTo(Library::class);
    }

    public function setUserOfficeTypeAttribute($value)
    {
        $this->attributes['user_office_type'] = ( isset($value) && trim($value) != "") ? $value: "Personnel";
    }
}
