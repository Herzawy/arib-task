<?php
namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Employee;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $employees = Employee::where('manager_id', auth()->user()->id)->get();
        return view('tasks.index', compact('employees'));
    }
    public function create()
    {
        $employees = Employee::where('manager_id', auth()->user()->id)->get();
        return view('tasks.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'task_description' => 'required|string|max:255',
            'due_date' => 'required|date',
        ]);

        Task::create([
            'employee_id' => $request->employee_id,
            'task_description' => $request->task_description,
            'due_date' => $request->due_date,
            'status' => 'Pending', 
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task assigned successfully');
    }


    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully');
    }
}
