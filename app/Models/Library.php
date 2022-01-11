<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Signatory;
class Library extends Model
{
    use HasFactory;

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

    public function signatory()
    {
        return $this->hasOne(Signatory::class, 'office_id');
    }

    public function children()
    {
        return $this->hasMany(Library::class, 'parent_id')->where('library_type', '=', 'user_section');
    }
}
