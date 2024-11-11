<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $employees = Employee::where('manager_id', Auth::id())->get();
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('employees.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'salary' => 'required|numeric|min:0',
            'manager_name' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
        ]);

        $validated['manager_id'] = Auth::id();

        Employee::create($validated);

        return redirect()->route('employees.index');
    }

    public function edit($id)
    {
        $employee = Employee::where('manager_id', Auth::id())->findOrFail($id);
        $departments = Department::all(); 
        return view('employees.edit', compact('employee', 'departments'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'salary' => 'required|numeric|min:0',
            'manager_name' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
        ]);

        $employee = Employee::where('manager_id', Auth::id())->findOrFail($id);

        $employee->update($validated);

        return redirect()->route('employees.index');
    }

    public function destroy($id)
    {
        $employee = Employee::where('manager_id', Auth::id())->findOrFail($id);

        $employee->delete();
        return redirect()->route('employees.index');
    }
}
