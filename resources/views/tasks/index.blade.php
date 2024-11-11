@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">My Employees' Tasks</h1>

        @foreach($employees as $employee)
            <h4>{{ $employee->first_name }}'s Tasks</h4>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Task Description</th>
                        <th>Due Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($employee->tasks as $task)
                        <tr>
                            <td>{{ $task->task_description }}</td>
                            <td>{{ $task->due_date }}</td>
                            <td>{{ $task->status }}</td>
                            <td>
                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endforeach

        <a href="{{ route('tasks.create') }}" class="btn btn-success mt-4">Assign New Task</a>
    </div>
@endsection
