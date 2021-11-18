<?php

namespace App\Repositories;

use App\Repositories\Interfaces\AbstractBaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\InvalidDataProvidedException;
use Log;

/**
 * Class AbstractBaseRepository
 * @package App\Repositories
 */
abstract class AbstractBaseRepository implements AbstractBaseRepositoryInterface {

    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get model
     *
     * @return Model
     */
    protected function getModel()
    {
        return $this->model;
    }

    /**
     * Get collection by ID
     *
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->getModel()->findOrFail($id);
    }

    /**
     * Get collection by array of Ids
     *
     * @param array $ids
     * @return mixed
     */
    public function getByIds(array $ids)
    {
        return $this->getModel()->whereIn($this->model->getKeyName(), $ids)->get();
    }

    /**
     * Insert data into the table
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * updates data for a given ID
     *
     * @param $key
     * @param $value
     * @param array $data
     * @return bool
     * @throws InvalidDataProvidedException
     */
    public function update($key, $value, array $data = [])
    {
        if(/*is_array($data) || */empty($data))
            throw new InvalidDataProvidedException;

        Log::warning(__METHOD__." where column = ".$key. " with where value = ".$value);
        Log::warning($data);

        return $this->getModel()
            ->where($key, '=', $value)
            ->firstOrFail()
            ->update($data);
    }

    /**
     * Delete by id
     *
     * @param $id
     * @return boolean
     */
    public function delete($id)
    {
        return $this->getModel()->findOrFail($id)->delete();
    }

    /**
     * Delete by many ids
     *
     * @param array $ids
     * @return mixed
     */
    public function deleteByIds(array $ids)
    {
        return $this->makeQuery()->whereIn('id', $ids)->delete();
    }

    /**
     * Increment by column
     *
     * @param $id
     * @param $field
     * @return
     */
    public function increment($id, $field)
    {
        return $this->model->findOrFail($id)->increment($field);
    }

    /**
     * Decrement by column
     *
     * @param $id
     * @param $field
     * @return
     */
    public function decrement($id, $field)
    {
        return $this->model->find($id)->decrement($field);
    }

    /**
     * Get all model data
     *
     * @return Collection
     */
    public function all()
    {
        return $this->getModel()->get();
    }
}
