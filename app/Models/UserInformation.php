<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Library;

class UserInformation extends Model
{
    use HasFactory;

    protected $table = "user_informations";

    protected $fillable = [
        'user_id',
        'fullname',
        'firstname',
        'middlename',
        'lastname',
        'user_dn',
        'cellphone_number',
        'email_address',
        'position_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function user_office()
    {
        return $this->belongsTo(Library::class);
    }

    public function section()
    {
        return $this->belongsTo(Library::class);
    }
    
    public function position()
    {
        return $this->belongsTo(Library::class);
    }

    public function getFullnameAttribute()
    {
        return trim("{$this->firstname} {$this->middlename} {$this->lastname}");
    }

    public function setFirstnameAttribute($value)
    {
        $this->attributes['firstname'] = strtoupper($value);
    }
    public function setMiddlenameAttribute($value)
    {
        $this->attributes['middlename'] =  (strlen($value) == 1 ? strtoupper($value.".") : strtoupper($value));
    }
    public function setLastnameAttribute($value)
    {
        $this->attributes['lastname'] = strtoupper($value);
    }
}
