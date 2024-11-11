@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Assign Task</h1>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="{{ route('tasks.store') }}" method="POST">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="employee_id" class="form-label">Employee</label>
                        <select id="employee_id" name="employee_id" class="form-control" required>
                            <option value="" disabled selected>Select Employee</option>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}" {{ old('employee_id') == $employee->id ? 'selected' : '' }}>
                                    {{ $employee->first_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="task_description" class="form-label">Task Description</label>
                        <textarea id="task_description" name="task_description" class="form-control" required>{{ old('task_description') }}</textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label for="due_date" class="form-label">Due Date</label>
                        <input type="date" id="due_date" name="due_date" class="form-control" value="{{ old('due_date') }}" required>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary px-4">Assign Task</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
