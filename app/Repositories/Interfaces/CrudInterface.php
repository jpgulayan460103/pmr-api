<?php

namespace App\Repositories\Interfaces;

interface CrudInterface {
    
    public function getAll($request);

    public function getAllPaginated($request);
 
    public function getById($id);

    public function getByUuid($uuid);
 
    public function create(array $data);

    public function createOrUpdate($id = null);
    
    public function update(array $data, $id = null);
    
    public function delete($id = null);

    public function showDeleted($id = null);

}