<?php

namespace App\Repositories\Interfaces;

interface CrudInterface {
    
    public function model($model);

    public function modelQuery();
    
    public function getAll();

    public function getAllPaginated();
 
    public function getById($id);

    public function getByUuid($uuid);
 
    public function getBy($field, $value, $type = 'item', $operation = "=");
    
    public function create(array $data);

    public function createOrUpdate($id = null);
    
    public function update($id, array $data);
    
    public function delete($id = null);

    public function showDeleted($id = null);

    public function defaultOrder($field, $order);
}