<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserOffice;
use Illuminate\Database\Eloquent\SoftDeletes;

class Library extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'library_type',
        'name',
        'title',
        'parent_id',
    ];

    protected $with = array('parent');

    public function parent()
    {
        return $this->belongsTo(Library::class);
    }

    public function user_office()
    {
        return $this->hasOne(UserOffice::class, 'office_id');
    }

    public function children()
    {
        return $this->hasMany(Library::class, 'parent_id')->orderBy('name');
    }
}
