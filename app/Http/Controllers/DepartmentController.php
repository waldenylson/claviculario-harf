<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Http\Requests\StoreDepartmentRequest;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    $departments = Department::all();
    return view('departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    return view('departments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDepartmentRequest $request)
    {
    $request->validate([
      'name' => 'required|string|max:255',
      'comments' => 'nullable|string',
    ]);

    Department::create($request->all());

    return redirect()->route('departments.index')->with('success', 'Department created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
    return view('departments.show', compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
    return view('departments.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
  public function update(StoreDepartmentRequest $request, Department $department)
    {
    $request->validate([
      'name' => 'required|string|max:255',
      'comments' => 'nullable|string',
    ]);

    $department->update($request->all());

    return redirect()->route('departments.index')->with('success', 'Department updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
    $department->delete();

    return redirect()->route('departments.index')->with('success', 'Department deleted successfully.');
    }
}
