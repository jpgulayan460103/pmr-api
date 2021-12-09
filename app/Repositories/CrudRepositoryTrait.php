<?php

namespace App\Repositories;

Trait CrudRepositoryTrait {
    
    protected $model;
    protected $per_page = 10;
    public function getAll($request){
        return $this->model->all();
    }

    public function getAllPaginated($request){
        return $this->model->paginate($this->per_page);
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
        return $this->model->find($id)->delete();
    }

    public function showDeleted($id = null){

    }

}