<?php

namespace App\Repositories\Interfaces;

interface AbstractBaseRepositoryInterface
{
    public function getById($id);
    public function getByIds(array $ids);
    public function create(array $data);
    public function update($key, $value, array $data = []);
    public function delete($id);
    public function deleteByIds(array $ids);
    public function increment($id, $field);
    public function decrement($id, $field);
    public function all();
}
