<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Department::query();

        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $departments = $query->withCount('employees')
            ->withSum('employees', 'salary')
            ->get();

        $totalSalary = Employee::sum('salary');

        return view('departments.index', compact('departments', 'totalSalary'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Department::create($validatedData);

        return redirect()->route('departments.index')->with('success', 'Department created successfully.');
    }

    public function create()
    {
        $departments = Department::all();
        return view('departments.create', compact('departments'));
    }
    public function edit(Department $department)
    {
        return view('departments.edit', compact('department'));
    }

    public function update(Request $request, Department $department)
    {
        $department->update($request->all());
        return redirect()->route('departments.index');
    }
    public function destroy(Department $department)
    {
        if ($department->employees()->exists()) {
            return back()->withErrors(['error' => 'Cannot delete department with assigned employees']);
        }

        $department->delete();
        return redirect()->route('departments.index');
    }
}
