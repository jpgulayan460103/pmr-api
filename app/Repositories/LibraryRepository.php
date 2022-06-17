<?php

namespace App\Repositories;

use App\Models\Library;
use App\Repositories\Interfaces\LibraryRepositoryInterface;
use App\Repositories\HasCrud;
use App\Transformers\ItemTransformer;
use App\Transformers\LibraryTransformer;
use App\Transformers\UserTransformer;
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

    public function showItems($refresh = false)
    {
        if (($itemsRedis = Redis::get('libraries.items')) && !$refresh) {
            return json_decode($itemsRedis);
        }
        $items = (new ItemRepository)->attach('unit_of_measure,item_category,item_type,item_category_cse')->getAll();
        $items = fractal($items, new ItemTransformer)->parseIncludes('unit_of_measure,item_category,item_type,item_category_cse');
        Redis::set('libraries.items', $items->toJson());
        return $items;
    }

    public function showUsers($refresh = false)
    {
        if (($usersRedis = Redis::get('libraries.users')) && !$refresh) {
            return json_decode($usersRedis);
        }
        $users = (new UserRepository())->attach('user_information')->getAll();
        $users = fractal($users, new UserTransformer)->parseIncludes('user_information');
        Redis::set('libraries.users', $users->toJson());
        return $users;
    }

    public function showLibrary($type, $refresh = false)
    {
        if (($library = Redis::get("libraries.$type")) && !$refresh) {
            return json_decode($library);
        }
        $library = $this->getBy('library_type', $type);
        $library = fractal($library, new LibraryTransformer)->parseIncludes('children');
        Redis::set("libraries.$type", $library->toJson());
        return $library;
    }

    public function getUserSectionBy($field, $value)
    {
        return $this->modelQuery()->where('is_active',1)->where('library_type','user_section')->where($field, $value)->first();
    }

    public function getUserDivisionBy($field, $value)
    {
        return $this->modelQuery()->where('is_active',1)->where('library_type','user_division')->where($field, $value)->first();
    }

    public function getLibraries()
    {
        return $this->modelQuery()->where('is_active',1)->orderBy('library_type')->orderBy('name')->get();
    }


    public function getBy($field, $value, $type = 'item', $operation = "="): object
    {        
        return $this->modelQuery()->orderBy('name')->where($field, $value)->get();
    }

    public function all()
    {
        $library = $this->getLibraries();
        $library = fractal($library, new LibraryTransformer)->parseIncludes('children');
        Redis::set('libraries.all', $library->toJson());
        return $library;
    }

    public function permissions($library_type)
    {

        // list cases from PermissionSeeder.php
        switch ($library_type) {
            case 'items':
                return "libraries.items.";
            case 'item_category':
                return "libraries.items.categories.";
            case 'user_division':
                return "libraries.office.divisions.";
            case 'user_section':
                return "libraries.office.sections.";
            case 'unit_of_measure':
                return "libraries.uom.";
            case 'uacs_code':
                return "libraries.uacs.";
            case 'items':
                return "libraries.items.";
                # code...
                break;
            
            default:
                # code...
                break;
        }
    }

    
}