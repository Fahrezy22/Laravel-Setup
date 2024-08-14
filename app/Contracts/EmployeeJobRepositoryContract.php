<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface EmployeeJobRepositoryContract
{
    public function getAll();
    public function findByCondition(array $condition);
    public function store(array $request);
    public function update(int $id, array $request);
    public function delete(int $id);
}
