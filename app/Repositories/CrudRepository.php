<?php

namespace App\Repositories;

class CrudRepository {
    
    protected $model;
    public function getAll($request){
        return $this->model->all();
    }
 
    public function getById($id){
        return $this->model->find($id);
    }

    public function getByUuid($uuid){
        return $this->model->whereUuid($uuid);
    }
 
    public function create($data){
        return $this->model->create($data);
    }

    public function createOrUpdate($id = null){

    }
    
    public function update(array $data, $id = null){
        $model = $this->getById($id);
        return $model->update($data);
    }
    
    public function delete($id = null){
        return $this->model->delete($id);
    }

    public function showDeleted($id = null){

    }

}