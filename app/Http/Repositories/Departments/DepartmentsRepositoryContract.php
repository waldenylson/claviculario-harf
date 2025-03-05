<?php

namespace App\Http\Repositories\Departments;

use App\Models\Department;
use App\Http\Requests\StoreDepartmentPostRequest;

interface DepartmentsRepositoryContract
{
  public function index();
  public function create();
  public function show(Department $department);
  public function store(StoreDepartmentPostRequest $request);
  public function edit(Department $department);
  public function persistUpdate(StoreDepartmentPostRequest $request, Department $department);
  public function destroy(Department $department);
  public function getAllDepartmentsForSelect();
}
