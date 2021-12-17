<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

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
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
