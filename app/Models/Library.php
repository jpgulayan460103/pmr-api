<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Library extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'name',
        'title',
        'parent_id',
    ];

    protected $with = array('parent');

    public function parent()
    {
        return $this->belongsTo(Library::class);
    }
}
