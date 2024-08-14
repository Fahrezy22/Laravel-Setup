<?php

namespace App\Repositories;

use App\Contracts\EmployeeJobRepositoryContract;
use App\Models\Employee;
use App\Models\EmployeeJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EmployeeJobRepository implements EmployeeJobRepositoryContract
{
    public function getAll()
    {
      return EmployeeJob::get();
    }

    public function findByCondition(array $condition)
    {
      return EmployeeJob::where($condition)->first();
    }

    public function store(array $request)
    { 
        return EmployeeJob::create($request);
    }

    public function update(int $id,array $request)
    { 
        $employee = EmployeeJob::find($id);

        if ($employee) {
            $employee->update();
            return true;
        } else {
            return false;
        }
        $employee_job = EmployeeJob::findOrFail($id);
        return $employee_job->update($request);
    }

    public function delete(int $id)
    {
      $employee = EmployeeJob::find($id);

      if ($employee) {
          $employee->delete();
          return true;
      } else {
          return false;
      }
    }
}