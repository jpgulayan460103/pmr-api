<?php

namespace App\Repositories;

use Ramsey\Uuid\Type\Integer;

Trait HasCrud {
    
    protected $model;
    protected $perPage = 50;
    protected $attach = [];
    protected $uuid = "uuid";

    public function model($model) : object
    {
        return $this->model = $model;
    }
    
    public function modelQuery()
    {
        return $this->model = $this->model->with($this->attach);
    }

    /**
     * Set number of rows per pagination.
     *
     * @return \Illuminate\Http\Response
     */
    public function perPage($perPage)
    {
        $this->perPage = $perPage;
        return $this;
    }

    /**
     * Add relationship to models.
     *
     * @param array $attach
     * @return \Illuminate\Http\Response
     */
    public function attach($attach)
    {
        $this->attach = explode(',',preg_replace('/\s+/', '', $attach));
        return $this;
    }

    public function getAll() : object
    {
        return $this->modelQuery()->get();
    }


    public function getAllPaginated() : object
    {
        return $this->modelQuery()->paginate($this->perPage);
    }
 
    public function getById($id)
    {
        $model = $this->modelQuery()->where('id',$id)->first();
        if($model){
            return $model;
        }else{
            abort(404);
        }
    }

    public function getByUuid($uuid)
    {
        return $this->modelQuery()->where($this->uuid,$uuid)->first();
    }

    public function getBy($field, $value, $type = 'item', $operation = "=") : object
    {
        $query = "";
        if($operation == "like"){
            $query = $this->modelQuery()->where($field, $operation, "%".$value."%");
        }else{
            $query = $this->modelQuery()->where($field, $operation, $value);
        }
        if($type == "collection"){
            return $query->get();
        }else{
            return $query->first();
        }
    }

    public function create($data) : object
    {
        return $this->model->create($data);
    }

    public function createOrUpdate($id = null)
    {

    }
    
    public function update($id, array $data) : object
    {
        $model = $this->getById($id);
        $model->update($data);
        return $model;
    }
    
    public function delete($id = null)
    {
        return $this->model->find($id)->delete();
    }

    public function showDeleted($id = null)
    {

    }

    public function defaultOrder($field, $order)
    {
        if($field){
            $this->modelQuery()->orderBy($field, $order);
        }
        return $this->modelQuery();
    }
}