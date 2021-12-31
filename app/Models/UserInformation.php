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
        'signatory_id',
        'cellphone_number',
        'email_address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function signatory()
    {
        return $this->belongsTo(Library::class);
    }
}
