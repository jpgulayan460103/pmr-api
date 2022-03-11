<?php

namespace App\Repositories;

use App\Models\Library;
use App\Repositories\Interfaces\LibraryRepositoryInterface;
use App\Repositories\HasCrud;
use App\Transformers\LibraryTransformer;
use Illuminate\Support\Facades\Redis;

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

    public function cacheRedis()
    {
        $library = $this->getLibraries();
        $library = fractal($library, new LibraryTransformer)->parseIncludes('children');
        Redis::set('libraries.all', $library->toJson());
        return $library;
    }
    
}