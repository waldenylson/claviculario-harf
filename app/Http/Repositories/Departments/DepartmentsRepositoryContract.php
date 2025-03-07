<?php

namespace App\Http\Repositories\Departments;

use App\Models\Department;
use App\Http\Requests\StoreDepartmentPostRequest;

interface DepartmentsRepositoryContract
{
  public function index();
  public function create();
  public function show(int $id);
  public function store(StoreDepartmentPostRequest $request);
  public function edit(int $id);
  public function persistUpdate(StoreDepartmentPostRequest $request, int $id);
  public function destroy(int $id);
  public function getAllDepartmentsForSelect();
}
