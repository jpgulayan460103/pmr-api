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
        // $this->attach('Library_category,unit_of_measure');
    }
    
}