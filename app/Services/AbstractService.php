<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractService {

    /**
     * Instance that 
     *
     * @var Model $model
     */
    protected $model;

    /**
     * get logged in user
     *
     * @var User $currentUser
     */
    protected $currentUser;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getAll() {
        return $this->model::all();
    }

    public function getAllPaginate() {
        return $this->model::query()->paginate();
    }

    public function getOne(int $id) {
        return $this->model::find($id);
    }
}