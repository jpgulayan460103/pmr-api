<?php

namespace App\Repositories;

use App\Models\Library;
use App\Repositories\Interfaces\LibraryRepositoryInterface;
use App\Repositories\HasCrud;

class LibraryRepository implements LibraryRepositoryInterface
{
    use HasCrud;
    public function __construct(Library $library = null)
    {
        if(!($library instanceof Library)){
            $library = new Library;
        }
        $this->model($library);
        $this->perPage(200);
    }

    public function getUserSectionBy($field, $value)
    {
        return $this->modelQuery()->where('library_type','user_section')->where($field, $value)->first();
    }

    public function getUserDivisionBy($field, $value)
    {
        return $this->modelQuery()->where('library_type','user_division')->where($field, $value)->first();
    }
    
}