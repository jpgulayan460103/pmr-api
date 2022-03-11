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
        $this->attach('parent,children');
    }

    public function getUserSectionBy($field, $value)
    {
        return $this->modelQuery()->where('library_type','user_section')->where($field, $value)->first();
    }

    public function getUserDivisionBy($field, $value)
    {
        return $this->modelQuery()->where('library_type','user_division')->where($field, $value)->first();
    }

    public function getLibraries()
    {
        return $this->modelQuery()->orderBy('library_type')->orderBy('name')->get();
    }


    public function getBy($field, $value)
    {
        return $this->modelQuery()->orderBy('name')->where($field, $value)->get();
    }
    
}