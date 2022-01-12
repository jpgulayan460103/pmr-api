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
        $this->attach = $attach;
        return $this;
    }

    public function getAll($request) : object
    {
        return $this->modelQuery()->get();
    }


    public function getAllPaginated($request) : object
    {
        return $this->modelQuery()->paginate($this->perPage);
    }
 
    public function getById($id) : object
    {
        return $this->modelQuery()->where('id',$id)->first();
    }

    public function getByUuid($uuid) : object
    {
        return $this->modelQuery()->where($this->uuid,$uuid)->first();
    }

    public function getBy($field, $value) : object
    {
        return $this->modelQuery()->where($field, $value)->first();
    }
 
    public function create($data) : object
    {
        return $this->model->create($data);
    }

    public function createOrUpdate($id = null)
    {

    }
    
    public function update(array $data, $id = null) : object
    {
        $model = $this->getById($id);
        return $model->update($data);
    }
    
    public function delete($id = null)
    {
        return $this->model->find($id)->delete();
    }

    public function showDeleted($id = null)
    {

    }
}