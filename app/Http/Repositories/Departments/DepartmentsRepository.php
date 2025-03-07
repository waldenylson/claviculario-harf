<?php

namespace App\Http\Repositories\Departments;

use App\Http\Requests\StoreDepartmentPostRequest;
use App\Models\Department;

class DepartmentsRepository implements DepartmentsRepositoryContract
{
  protected string $modelClass = Department::class;

  public function listDepartments($paginateResult = false)
  {
    if ($paginateResult) {
      return $this->modelClass::paginate(10);
    }

    return $this->modelClass::all();
  }

  public function findSingleDepartment($id)
  {
    return $this->modelClass::findOrFail($id);
  }

  public function store(StoreDepartmentPostRequest $request)
  {
    return $this->modelClass::create($request->all());
  }

  public function edit($id)
  {
    return $this->modelClass::findOrFail($id);
  }

  public function persistUpdate(StoreDepartmentPostRequest $request, $id)
  {
    $validatedData = $request->validated();

    return $this->modelClass::findOrFail($id)->update($validatedData);
  }

  public function destroy($id)
  {
    $department = $this->modelClass::findOrFail($id);

    return $department->delete();
  }

  public function index()
  {
    // Implement the index method
  }

  public function create()
  {
    // Implement the create method
  }

  public function show($id)
  {
    // Implement the show method
  }

  public function getAllDepartmentsForSelect()
  {
    // Implement the getAllDepartmentsForSelect method
  }
}
